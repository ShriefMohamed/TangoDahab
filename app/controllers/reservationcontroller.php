<?php

namespace Framework\Controllers;
use Framework\Lib\AbstractController;

use Framework\Models\RoomsModel;
use Framework\Models\ReservationsModel;
use Framework\Models\InvoicesModel;
use Framework\Models\Manage_websiteModel;

// PayPay Namesapaces
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

class ReservationController extends AbstractController
{
    public function ReservationAction()
    {
        if (isset($_POST['submit'])) {
            $room_id = htmlentities(strip_tags($_POST['room_id']), ENT_QUOTES, 'UTF-8');
            $room = RoomsModel::getOne(" room_id = '$room_id' ");
            if ($room) {
                $check_in = htmlentities(strip_tags($_POST['check_in']), ENT_QUOTES, 'UTF-8');
                $check_in = str_replace('/', '-', $check_in);
                $check_in_date = new \DateTime($check_in);

                $check_out = htmlentities(strip_tags($_POST['check_out']), ENT_QUOTES, 'UTF-8');
                $check_out = str_replace('/', '-', $check_out);
                $check_out_date = new \DateTime($check_out);

                if ($check_in != '' && $check_out != '') {
                    $period = $this->DateDiff($check_in, $check_out);

                    if (!$period->y == 0 || !$period->m == 0) {
                        echo "<script>alert('Your reservation wasn\'t saved. You can\'t book more than 29 days.')</script>";
                        exit();
                    }

                    if ($period->d > 0) {
                        $total = intval($period->d) * intval($room->price);
                    } else {
                        echo "<script>alert('Your reservation wasn\'t saved. Try again later.')</script>";
                        exit();
                    }

                    if ($total) {
                        $reservation = new ReservationsModel;
                        $reservation->check_in = $check_in_date->format('Y-m-d');
                        $reservation->check_out = $check_out_date->format('Y-m-d');
                        $reservation->period = $period->d;
                        $reservation->total = $total;

                        $reservation->room_id = $room->room_id;
                        $reservation->room_price = $room->price;

                        $reservation->guests = htmlentities(strip_tags($_POST['guests']), ENT_QUOTES, 'UTF-8');
                        $reservation->email = htmlentities(strip_tags($_POST['email']), ENT_QUOTES, 'UTF-8');
                        $reservation->note = htmlentities(strip_tags($_POST['note']), ENT_QUOTES, 'UTF-8');
                        $reservation->payment_status = 'unpaid';

                        if ($reservation->Create()) {
                        	$invoice = new InvoicesModel;
							$invoice->reservation_id = $reservation->id;
							$invoice->total_amount = $reservation->total;
							$invoice->amount_paid = 0;
							$invoice->amount_due = $reservation->total;

							if ($invoice->Create()) {
								header("location: " . HOST_NAME . 'reservation/payment/' . $reservation->id);
							} else {
								$d_reservation = new ReservationsModel;
								$d_reservation->Delete(" id = " . $reservation->id);
								echo "<script>alert('Your reservation wasn\'t saved. Try again later.')</script>";
							}
                        } else {
                            echo "<script>alert('Your reservation wasn\'t saved. Try again later.')</script>";
                        }
                    } else {
                        echo "<script>alert('Your reservation wasn\'t saved. Try again later.')</script>";
                    }
                }
            }
        }

        $rooms = RoomsModel::getAll(" WHERE status = 'active' ");
        $this->_data = ['rooms' => $rooms];
        $this->SetView();
        $this->Render([
            'breadcumb-area' => 'breadcumb-area',
            'view' => $this->_view
        ]);
    }

    private function GetPayingOption()
    {
		$option = Manage_websiteModel::getAll(" WHERE setting = 'paying-option' LIMIT 1");
        if (empty($option)) {
            $new_option = new Manage_websiteModel;
            $new_option->setting = "paying-option";
            $new_option->content = '1';
            $new_option->Create();
            $option = Manage_websiteModel::getAll(" WHERE setting = 'paying-option' LIMIT 1");
        }

		return array_shift($option);
    }

    public function PaymentAction()
    {
        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {

        	$invoice = InvoicesModel::getCheckOut($id);

        	$option = $this->GetPayingOption();

        	$this->_data = ['invoice' => $invoice, 'option' => $option];
	        $this->SetView();
	        $this->Render([
	            'breadcumb-area' => 'breadcumb-area',
	            'view' => $this->_view
	        ]);
        }
    }

    public function ReservationdetailsAction()
    {
        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {

            $invoice = InvoicesModel::getCheckOut($id);

            $this->_data = ['invoice' => $invoice];
            $this->SetView();
            $this->Render([
                'breadcumb-area' => 'breadcumb-area',
                'view' => $this->_view
            ]);
        }
    }

    private function PayPal()
    {
        require PAYPAL_SDK_PATH . 'autoload.php';

        $paypal = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AUn8fION-sHAHfEn6rfgYLJn73HNg4cC26fAwhpQ1Nmyi9si-NB6gI9Wq4MiPbGakTV8w3i77keDi95f',
                'EB03TFPHKJ4IIgqpiC8Zi3KmuhZSWLzq66q4dkR4jC5V-Huv7pUYn6S83z1pVBO7m6qCYdu8azpRySAm'
                )
        );

        $paypal->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => 'PayPal.log',
                'log.LogLevel' => 'DEBUG',
                'cache.enabled' => true,
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
            )
        );
        
        return $paypal;
    }

    private function ConfirmInvoice($payment_method, $amount_paid, $egpAmount, $reservation_id)
    {
        $invoice = InvoicesModel::getCheckOut($reservation_id);
        if ($invoice) {
            $new_reservation = new ReservationsModel;
            $new_reservation->reservation_status = 'confirmed';

            if ($payment_method == 'cash') {
                $new_reservation->payment_status = 'unpaid';
            } else {
                if ($amount_paid >= 1) {
                    $new_reservation->payment_status = 'paid';

                    $new_invoice = new InvoicesModel;
                    $new_invoice->payment_method = $payment_method;
                    $new_invoice->last_updated = date('Y-m-d h:i:s');
                    if (intval($invoice->amount_due) - intval($egpAmount) == 0) {
                        $new_invoice->amount_due = '-0';
                    } else {
                        $new_invoice->amount_due = intval($invoice->amount_due) - intval($egpAmount);
                    }
                    $new_invoice->amount_paid = $invoice->amount_paid + $amount_paid;
                    $new_invoice->amount_paid_egp = $invoice->amount_paid_egp + $egpAmount;
                    $new_invoice->Update(" invoice_id = " . $invoice->invoice_id);
                }
            }
            return $new_reservation->Update(" id = " . $invoice->reservation_id) ? true : false;
        }
    }

    public function PaynowAction()
    {
    	$id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
        	$invoice = InvoicesModel::getCheckOut($id);
            if ($invoice) {
                if (!empty($invoice->amount_due) && !empty($invoice->total_amount)) {
                    if (isset($_POST['submit'])) {
                        $option = (isset($_POST['paying-option'])) ? $_POST['paying-option'] : 1;

                        if ($invoice->total_amount == $invoice->amount_due) {
                            $amountToPay = $option != 1 ? intval($invoice->amount_due) / 2 : intval($invoice->amount_due);
                            $usdAmount = $this->convertCurrency($amountToPay, 'EGP', 'USD');
                            if (floatval($usdAmount)) {
                                $this->Paynow($usdAmount, $amountToPay, $invoice->reservation_id);
                            } else {
                                header("location: " . HOST_NAME . 'reservation/successcheckout/false');
                            }
                        } else {
                            header("location: " . HOST_NAME . 'reservation/successcheckout/false');
                        }
                    } else {
                        header("location: " . HOST_NAME . 'reservation/successcheckout/false');
                    }
                } else {
                    header("location: " . HOST_NAME . 'reservation/successcheckout/false');
                }
        	}
        }
    }

    public function PaylaterAction()
    {
    	$id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            $invoice = InvoicesModel::getCheckOut($id);
        	if ($invoice) {
        	    if ($this->ConfirmInvoice('cash', 0, 0, $invoice->reservation_id)) {
                    echo "<script>alert('Your reservation was confirmed successfully.')</script>";
                    echo "<script>window.open('".HOST_NAME."reservation/reservationdetails/".$invoice->reservation_id."','_self')</script>";
                } else {
                    echo "<script>alert('Your reservation couldn\'t be confirmed. please contact support and include this: reservationId=".$invoice->reservation_id."')</script>";
                    echo "<script>window.open('".HOST_NAME."reservation/reservationdetails/".$invoice->reservation_id."','_self')</script>";
                }
        	}
        }
    }

    private function Paynow($amountToPay, $egpAmount, $reservationId)
    {
        if ((is_integer($amountToPay) || is_float($amountToPay)) && !is_null($amountToPay) && $amountToPay >= 1 && !empty($reservationId)) {
            $total = $amountToPay;

            $this->PayPal();

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item = new Item();
            $item->setName('Tango Booking')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($total);

            $itemList = new ItemList();
            $itemList->setItems([$item]);

            $details = new Details();
            $details->setShipping(0)
                ->setSubtotal($total);

            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal($total)
                ->setDetails($details);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription('Tango Camp Booking')
                ->setInvoiceNumber(uniqid());

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl(HOST_NAME . 'reservation/successcheckout/true?amount='.$total.'&egpAmount='.$egpAmount.'&reservationId='.$reservationId)
                ->setCancelUrl(HOST_NAME . 'reservation/successcheckout/false');

            $payment = new Payment();
            $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

            try {
                $payment->create($this->paypal());
            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                echo $ex->getCode(); // Prints the Error Code
                echo $ex->getData(); // Prints the detailed error message
                die($ex);
            } catch (Exception $ex) {
                die($ex);
            }

            $approvalUrl = $payment->getApprovalLink();
            header("location: {$approvalUrl}");
        }
    }

    public function SuccesscheckoutAction()
    {
        if (
            $this->_params[0] == null ||
            $this->_params[0] == 'false' ||
            (!isset($this->_params[0], $_GET['paymentId'], $_GET['PayerID'], $_GET['amount'], $_GET['egpAmount'], $_GET['reservationId']))
        ) {
            echo "<script>window.open('" .HOST_NAME. "reservation/cancelcheckout/".$_GET['reservationId']."','_self')</script>";
        }

        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];
        $amount = $_GET['amount'];
        $egpAmount = $_GET['egpAmount'];
        $reservationId = $_GET['reservationId'];
        
        $this->PayPal();

        $payment = Payment::get($paymentId, $this->PayPal());

        $execute = new PaymentExecution();
        $execute->setPayerId($payerId);

        try {
            $result = $payment->execute($execute, $this->PayPal());
        } catch (Exeption $e) {
            $data = json_decode($e->getData());
            echo $data->message;
        }

        if ($this->ConfirmInvoice('PayPal', $amount, $egpAmount, $reservationId)) {
            echo "<script>alert('Your reservation was confirmed successfully.')</script>";
            echo "<script>window.open('".HOST_NAME."reservation/reservationdetails/".$reservationId."','_self')</script>";
        } else {
            echo "<script>alert('Your reservation couldn\'t be confirmed. please contact support and include this: reservationId=".$reservationId."')</script>";
            echo "<script>window.open('".HOST_NAME."reservation/reservationdetails/".$reservationId."','_self')</script>";
        }
    }

    public function CancelcheckoutAction()
    {
        $id = ($this->_params) != null ? $this->_params[0] : false;

        echo "<script>alert('Error, Payment was canceled. Please try again.')</script>";
        header("location: " . HOST_NAME . 'reservation/reservationdetails/' . $id);
    }

}
