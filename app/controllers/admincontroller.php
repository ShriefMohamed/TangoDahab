<?php

namespace Framework\Controllers;
use Framework\Lib\AbstractController;

use Framework\Models\InvoicesModel;
use Framework\models\Message_repliesModel;
use Framework\Models\NewsModel;
use Framework\models\PrivilegesModel;
use Framework\Models\RoomsModel;
use Framework\models\Sent_messagesModel;
use Framework\Models\TestimonialsModel;
use Framework\Models\SubscribtionModel;
use Framework\Models\UsersModel;
use Framework\Models\MessagesModel;
use Framework\Models\ReservationsModel;
use Framework\Models\Manage_websiteModel;
use Framework\Models\Contact_infoModel;

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

class AdminController extends AbstractController
{
	public function DefaultAction()
	{
        $rooms = RoomsModel::Count();
		$active_rooms = RoomsModel::Count(" WHERE status = 'active' ");
		$inactive_rooms = RoomsModel::Count(" WHERE status = 'inactive' ");
        $eRooms = RoomsModel::getRooms(" WHERE reservations.check_out <= CURRENT_DATE() GROUP BY rooms.room_id");
        $rRooms = RoomsModel::getRooms(" WHERE reservations.check_out >= CURRENT_DATE() GROUP BY rooms.room_id");
		$empty_rooms = sizeof($eRooms);
		$reserved_rooms = sizeof($rRooms);

		$reservations = ReservationsModel::Count();
		$active_reservations = ReservationsModel::Count(" WHERE check_out > CURRENT_DATE() ");
		$finished_reservations = ReservationsModel::Count(" WHERE check_out < CURRENT_DATE() ");
		$news = NewsModel::Count();
		$testimonials = TestimonialsModel::Count();
		$subscribtions = SubscribtionModel::Count();
		$customers = UsersModel::Count(" WHERE role = 'user'");
		$admins = UsersModel::Count(" WHERE role = 'admin'");
		$messages = MessagesModel::Count();
		$replies = Message_repliesModel::Count(" WHERE sender = 'customer' ");
		$recevivedMessages = intval($messages) + intval($replies);
		$sentMessages = Message_repliesModel::Count(" WHERE sender = 'admin' ");
		
		$this->_data = [
			'rooms' => $rooms,
			'active_rooms' => $active_rooms,
			'empty_rooms' => $empty_rooms,
			'inactive_rooms' => $inactive_rooms,
			'reserved_rooms' => $reserved_rooms,
			'reservations' => $reservations,
			'active_reservations' => $active_reservations,
			'finished_reservations' => $finished_reservations,
            'news' => $news,
			'testimonials' => $testimonials,
			'subscriptions' => $subscribtions,
			'customers' => $customers,
			'admins' => $admins,
			'recevivedMessages' => $recevivedMessages,
			'sentMessages' => $sentMessages
		];

		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

    public function FinancialsummaryAction()
    {
        $allOrders = OrdersModel::getAll();
        $allOrdersR = $this->calculateAmount($allOrders, 'total');
        $allOrdersD = $this->calculateAmount($allOrders, 'shipping_cost');

        $newOrders = OrdersModel::getAll(" WHERE orders.order_status = 'Order was placed successfully' ");
        $newOrdersR = $this->calculateAmount($newOrders, 'total');

        $activeOrders = OrdersModel::getAll(" WHERE (orders.order_status != 'Order was placed successfully' AND orders.order_status != 'Delivered') ");
        $activeOrdersR = $this->calculateAmount($activeOrders, 'total');

        $deliveredOrders = OrdersModel::getAll(" WHERE orders.order_status = 'Delivered' ");
        $deliveredOrdersR = $this->calculateAmount($deliveredOrders, 'total');

        $this->_data = [
            'allOrdersR' => $allOrdersR,
            'allOrdersD' => $allOrdersD,
            'newOrdersR' => $newOrdersR,
            'activeOrdersR' => $activeOrdersR,
            'deliveredOrdersR' => $deliveredOrdersR
        ];
        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    private function calculateAmount($orders, $key)
    {
        $total = 0;
        $counter = 0;

        foreach ($orders as $order) {
            $total = $order->$key + $total;
            $counter++;
        }

        return $results = array($total, $counter);
    }

	/* Rooms Section */
	public function RoomsAction()
	{
        if ($_SESSION['privileges']->rooms_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = RoomsModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $rooms = RoomsModel::getAll(" LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'rooms' => $rooms,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function ActiveroomsAction()
	{
        if ($_SESSION['privileges']->rooms_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = RoomsModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $rooms = RoomsModel::getAll(" WHERE rooms.status = 'active' LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'rooms' => $rooms,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function InactiveroomsAction()
	{
        if ($_SESSION['privileges']->rooms_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = RoomsModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $rooms = RoomsModel::getAll(" WHERE rooms.status = 'inactive' LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'rooms' => $rooms,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function ReservedroomsAction()
	{
        if ($_SESSION['privileges']->rooms_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = RoomsModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $rooms = RoomsModel::getRooms(" WHERE reservations.check_out >= CURRENT_DATE() GROUP BY rooms.room_id LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'rooms' => $rooms,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function EmptyroomsAction()
	{
        if ($_SESSION['privileges']->rooms_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = RoomsModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);
        $rooms = RoomsModel::getRooms(" WHERE reservations.check_out <= CURRENT_DATE() GROUP BY rooms.room_id LIMIT " . $start_from . ', ' . $per_page);

        $this->_data = [
            'rooms' => $rooms,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function NewroomAction()
	{
        if ($_SESSION['privileges']->rooms_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        if (isset($_POST['submit'])) {
			$room = new RoomsModel;
			$room->room_number = htmlentities(strip_tags($_POST['room-number']), ENT_QUOTES, 'UTF-8');
			$room->room_type = htmlentities(strip_tags($_POST['room-type']), ENT_QUOTES, 'UTF-8');
			$room->beds = htmlentities(strip_tags($_POST['beds']), ENT_QUOTES, 'UTF-8');
			$room->price = htmlentities(strip_tags($_POST['price']), ENT_QUOTES, 'UTF-8');
			$room->description = htmlentities(strip_tags($_POST['description']), ENT_QUOTES, 'UTF-8');
			$room->status = htmlentities(strip_tags($_POST['status']), ENT_QUOTES, 'UTF-8');

			$room->image = rand(99999999, 9) . '-' . $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
			
			if ($room->Create()) {
                $this->logger->info("Added New Room", array('room_id' => $room->room_id ,'Admin: ' => $_SESSION['loggedin']->username));
				move_uploaded_file($image_tmp, IMAGES_PATH . 'rooms-img/' . "$room->image");
				$_SESSION['adminMessages'] = array('success', 'You successfully created a new room.');
        		header("location: " . HOST_NAME . 'admin/rooms');
			} else {
				$_SESSION['adminMessages'] = array('error', 'Sorry, Something wrong happened!');
				header("location: " . HOST_NAME . 'admin/newroom');
			}
		}

		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function EditroomAction()
	{
        if ($_SESSION['privileges']->rooms_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {

			if (isset($_POST['submit'])) {
				$room = new RoomsModel;
				$room->room_number = htmlentities(strip_tags($_POST['room-number']), ENT_QUOTES, 'UTF-8');
				$room->room_type = htmlentities(strip_tags($_POST['room-type']), ENT_QUOTES, 'UTF-8');
				$room->beds = htmlentities(strip_tags($_POST['beds']), ENT_QUOTES, 'UTF-8');
				$room->price = htmlentities(strip_tags($_POST['price']), ENT_QUOTES, 'UTF-8');
				$room->description = htmlentities(strip_tags($_POST['description']), ENT_QUOTES, 'UTF-8');
				$room->status = htmlentities(strip_tags($_POST['status']), ENT_QUOTES, 'UTF-8');

				if (isset($_FILES)) {
					if (!empty($_FILES['image']['name'])) {
						$room->image = rand(99999999, 9) . '-' . $_FILES['image']['name'];
			            $image_tmp = $_FILES['image']['tmp_name'];
			        }
				}

				if ($room->Update(" room_id = '$id' ")) {
                    $this->logger->info("Updated Room", array('room_id' => $id ,'Admin: ' => $_SESSION['loggedin']->username));

					if ($room->image) {
						move_uploaded_file($image_tmp, IMAGES_PATH . 'rooms-img/' . "$room->image");
					}
					$_SESSION['adminMessages'] = array('success', 'You successfully updated the room.');
	        		header("location: " . HOST_NAME . 'admin/rooms');
				} else {
					$_SESSION['adminMessages'] = array('error', 'Sorry, Something wrong happened!');
					header("location: " . HOST_NAME . 'admin/rooms');
				}
			}

	        $oldRoom = RoomsModel::getOne(" room_id = " . $id);
	        $this->_data = ['room' => $oldRoom];
        }

		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function DeleteroomAction()
	{
        if ($_SESSION['privileges']->rooms_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
        	$room = new RoomsModel;
        	if ($room->Delete(" room_id = " . $id)) {
                $this->logger->info("Deleted Room", array('room_id' => $id ,'Admin: ' => $_SESSION['loggedin']->username));
        		$_SESSION['adminMessages'] = array('success', 'You successfully deleted a room.');
        		header("location: " . HOST_NAME . 'admin/rooms');
        	}
        }
	}
	/* End Rooms Section */


    /* Reservations Section */
    public function ReservationsAction()
    {
        if ($_SESSION['privileges']->view_reservations !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;
        if (!isset($page) || !is_numeric($page)) {$page = 1;}

        $filter = (isset($_GET['filter']) && $_GET['filter'] !== null) ? $_GET['filter'] : null;

        switch ($filter)
        {
            case 'unconfirmedreservations':
                $sql = " WHERE reservations.reservation_status = 'unconfirmed' ";
                break;
            case 'confirmedreservations':
                $sql = " WHERE reservations.reservation_status = 'confirmed' ";
                break;
            case 'upcomingreservations':
                $sql = " WHERE reservations.check_in >= CURRENT_DATE() ";
                break;
            case 'activereservations':
                $sql = " WHERE reservations.check_in <= CURRENT_DATE() AND reservations.check_out >= CURRENT_DATE() ";
                break;
            case 'donereservations':
                $sql = " WHERE reservations.check_out < CURRENT_DATE() ";
                break;
            default:
                $sql = " ";
                break;
        }

        $per_page = 10;
        $total_records = ReservationsModel::Count($sql);
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $invoices = InvoicesModel::getReservations($sql . " ORDER BY reservations.reservation_date DESC LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'invoices' => $invoices,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];

        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function EditreservationAction()
    {
        if ($_SESSION['privileges']->update_reservations !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {

            if (isset($_POST['submit'])) {
                $room_id = htmlentities(strip_tags($_POST['room_id']), ENT_QUOTES, 'UTF-8');

                $reservation = ReservationsModel::getOne(" id = " . $id);
                $invoice = InvoicesModel::getOne(" reservation_id = " . $id);
                $room = RoomsModel::getOne(" room_id = '$room_id' ");

                $check_in = htmlentities(strip_tags($_POST['check_in']), ENT_QUOTES, 'UTF-8');
                $check_out = htmlentities(strip_tags($_POST['check_out']), ENT_QUOTES, 'UTF-8');

                if ($room && $reservation) {
                    if ($check_in != '' && $check_out != '') {
                        $check_in = str_replace('/', '-', $check_in);
                        $check_in_date = new \DateTime($check_in);

                        $check_out = str_replace('/', '-', $check_out);
                        $check_out_date = new \DateTime($check_out);

                        $diff = $this->DateDiff($check_in, $check_out);

                        if (!$diff->y == 0 || !$diff->m == 0) {
                            $_SESSION['adminMessages'] = array('error', 'You can\'t book more than 29 days.');
                            echo "<script>window.open('".HOST_NAME."admin/editreservation/".$reservation->id."','_self')</script>";
                        }

                        if ($diff->d > 0) {
                            $total = intval($diff->d) * intval($room->price);

                            $new_reservation = new ReservationsModel;
                            $new_reservation->check_in = $check_in_date->format('Y-m-d');
                            $new_reservation->check_out = $check_out_date->format('Y-m-d');
                            $new_reservation->period = $diff->d;

                            $new_reservation->total = $total;

                            $new_reservation->room_id = $room->room_id;
                            $new_reservation->room_price = $room->price;

                            $new_reservation->guests = htmlentities(strip_tags($_POST['guests']), ENT_QUOTES, 'UTF-8');
                            $new_reservation->email = htmlentities(strip_tags($_POST['email']), ENT_QUOTES, 'UTF-8');
                            $new_reservation->note = htmlentities(strip_tags($_POST['note']), ENT_QUOTES, 'UTF-8');
                            $new_reservation->reservation_status = htmlentities(strip_tags($_POST['status']), ENT_QUOTES, 'UTF-8');

                            if ($new_reservation->Update(" id = " . $reservation->id)) {
                                $this->logger->info("Updated Reservation", array('reservation_id' => $reservation->id ,'Admin: ' => $_SESSION['loggedin']->username));
                                if ($total !== $reservation->total) {
                                    $amount_due = (intval($total) - intval($invoice->total_amount)) + intval($invoice->amount_due);
                                    $new_invoice = new InvoicesModel;
                                    $new_invoice->total_amount = $total;
                                    $new_invoice->amount_due = $amount_due;
                                    $new_invoice->last_updated = date('Y-m-d h:i:s');
                                    $new_invoice->Update(" invoice_id = " . $invoice->invoice_id);
                                }
                                $_SESSION['adminMessages'] = array('success', 'You successfully updated a reservation.');
                                echo "<script>window.open('".HOST_NAME."admin/reservations/','_self')</script>";
                            }
                        }
                    }
                }
            }

            $old_reservation = InvoicesModel::getCheckOut($id);
            $rooms = RoomsModel::getAll();
            $this->_data = ['rooms' => $rooms, 'reservation' => $old_reservation];
        }

        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function EditinvoiceAction()
    {
        if ($_SESSION['privileges']->update_reservations !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            if (isset($_POST['submit'])) {
                $reservation = ReservationsModel::getOne(" id = " . $id);
                $invoice = new InvoicesModel;
                $invoice->total_amount = htmlentities(strip_tags($_POST['total']), ENT_QUOTES, 'UTF-8');
                $invoice->amount_paid = htmlentities(strip_tags($_POST['amount_paid']), ENT_QUOTES, 'UTF-8');
                $invoice->amount_paid_egp = htmlentities(strip_tags($_POST['amount_paid_egp']), ENT_QUOTES, 'UTF-8');
                $invoice->amount_due = htmlentities(strip_tags($_POST['amount_due']), ENT_QUOTES, 'UTF-8');
                $invoice->payment_method = htmlentities(strip_tags($_POST['payment_method']), ENT_QUOTES, 'UTF-8');
                $invoice->last_updated = date('Y-m-d h:i:s');

                if ($invoice->total_amount !== $reservation->total) {
                    $new_reservation = new ReservationsModel;
                    $new_reservation->total = $invoice->total_amount;
                    $new_reservation->payment_status = 'paid';
                    $new_reservation->Update(" id = " . $id);
                }
                if ($invoice->Update(" reservation_id = " . $id)) {
                    $this->logger->info("Updated Reservation's Invoice", array('reservation_id' => $id ,'Admin: ' => $_SESSION['loggedin']->username));
                    $_SESSION['adminMessages'] = array('success', 'You successfully updated a reservation\'s invoice.');
                    echo "<script>window.open('".HOST_NAME."admin/reservations/','_self')</script>";
                } else {
                    $_SESSION['adminMessages'] = array('error', 'Something went wrong, please try again later.');
                }
            }

            $old_reservation = InvoicesModel::getCheckOut($id);
            $this->_data = ['reservation' => $old_reservation];
        }

        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function CalctotalAction()
    {
        if (isset($_POST)) {
            $room_id = htmlentities(strip_tags($_POST['room_id']), ENT_QUOTES, 'UTF-8');

            $check_in = htmlentities(strip_tags($_POST['check_in']), ENT_QUOTES, 'UTF-8');
            $check_out = htmlentities(strip_tags($_POST['check_out']), ENT_QUOTES, 'UTF-8');

            if ($room_id) {
                if ($check_in != '' && $check_out != '') {
                    $check_in = str_replace('/', '-', $check_in);
                    $check_out = str_replace('/', '-', $check_out);

                    $room = RoomsModel::getOne(" room_id = '$room_id' ");

                    $diff = $this->DateDiff($check_in, $check_out);
                    if (!$diff->y == 0 || !$diff->m == 0) {
                        die(json_encode(array(
                            'status' => 0,
                            'msg' => "You can't book more than 29 days."
                        )));
                    }

                    if ($diff->d > 0) {
                        $total = intval($diff->d) * intval($room->price);
                        if ($total) {
                            die(json_encode(array(
                                'status' => 1,
                                'total' => $total
                            )));
                        }
                    }

                }
            }
        }
    }

    public function ReservationreceiptAction()
    {
        if ($_SESSION['privileges']->view_reservations !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {

            $contactinfo = Contact_infoModel::getAll();
            if (empty($contactinfo)) {
                $new_contact = new Contact_infoModel;
                $new_contact->phone = '00000000000';
                $new_contact->email = 'tango@mail.com';
                $new_contact->address = 'Dahab - South Sinai, Egypt';
                $new_contact->Create();

                $contactinfo = Contact_infoModel::getAll();
            }
            $contactinfo = array_shift($contactinfo);

            $invoice = InvoicesModel::getReservations(" WHERE reservations.id = " . $id);
            $invoice = ($invoice) ? array_shift($invoice) : null;

            $this->_data = [
                'contactinfo' => $contactinfo,
                'reservation' => $invoice
                ];
            $this->SetView();
            $this->RenderOnlyView($this->_view);

        }
    }

    public function NewreservationAction()
    {
        if ($_SESSION['privileges']->add_reservations !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

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
                        $reservation->reservation_status = 'confirmed';
                        $reservation->payment_status = 'unpaid';

                        if ($reservation->Create()) {
                            $this->logger->info("New Reservation", array('reservation_id' => $reservation->id ,'Admin: ' => $_SESSION['loggedin']->username));
                            $invoice = new InvoicesModel;
                            $invoice->reservation_id = $reservation->id;
                            $invoice->total_amount = $reservation->total;
                            $invoice->amount_paid = 0;
                            $invoice->amount_due = $reservation->total;

                            if ($invoice->Create()) {
                                header("location: " . HOST_NAME . 'admin/reservations');
                            } else {
                                $d_reservation = new ReservationsModel;
                                $d_reservation->Delete(" id = " . $reservation->id);
                                $this->logger->info("Deleted Reservation (Error creating invoice)", array('reservation_id' => $reservation->id ,'Admin: ' => $_SESSION['loggedin']->username));
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
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function DeletereservationAction()
    {
        if ($_SESSION['privileges']->add_reservations !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            $reservation = new ReservationsModel;

            if ($reservation->Delete(" id = " . $id)) {
                $invoice = new InvoicesModel;

                if ($invoice->Delete(" reservation_id = " . $id)) {
                    $this->logger->info("Deleted Reservation", array('reservation_id' => $id ,'Admin: ' => $_SESSION['loggedin']->username));
                    $_SESSION['adminMessages'] = array('success', 'You successfully deleted a reservation.');
                    echo "<script>window.open('".HOST_NAME."admin/reservations/','_self')</script>";
                }
            }

        }
    }
    /* End Reservations Section */


    /* Users Section */
    public function ManageusersAction()
    {
        if ($_SESSION['privileges']->users_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = UsersModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $users = UsersModel::getAll(" LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'users' => $users,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function ManagecustomersAction()
    {
        if ($_SESSION['privileges']->users_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = UsersModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $users = UsersModel::getAll(" WHERE role = 'customer' LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'users' => $users,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function ManageadminsAction()
    {
        if ($_SESSION['privileges']->users_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = UsersModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $users = UsersModel::getAll(" WHERE role = 'admin' LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'users' => $users,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function DeleteuserAction()
    {
        if ($_SESSION['privileges']->users_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            $old_user = UsersModel::getOne("user_id = ". $id);
            if ($old_user->role == 'admin') {
                $privileges = new PrivilegesModel;
                $privileges->Delete(" user_id = " . $id);
            }

            $user = new UsersModel;
            if ($user->Delete(" user_id = " . $id)) {
                $this->logger->info("Deleted User", array('user_id' => $id ,'Admin: ' => $_SESSION['loggedin']->username));
                $_SESSION['adminMessages'] = array('success', 'You successfully deleted a user.');
                header("location: " . HOST_NAME . 'admin/manageusers');
            }
        }
    }

    public function AdduserAction()
    {
        if ($_SESSION['privileges']->users_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        if (isset($_POST['submit'])) {
            $user = new UsersModel;
            $user->fullname = htmlentities(strip_tags($_POST['fullname']), ENT_QUOTES, 'UTF-8');
            $user->username = htmlentities(strip_tags($_POST['username']), ENT_QUOTES, 'UTF-8');
            $user->email = htmlentities(strip_tags($_POST['email']), ENT_QUOTES, 'UTF-8');
            $password = $_POST['password'];
            $user->phone = htmlentities(strip_tags($_POST['phone']), ENT_QUOTES, 'UTF-8');
            $user->governorate = htmlentities(strip_tags($_POST['country']), ENT_QUOTES, 'UTF-8');
            $user->role = $_POST['role'];

            $checkEmail = UsersModel::Count(" WHERE email = '$user->email'");
            $checkUsername = UsersModel::Count(" WHERE username = '$user->username'");

            if (!is_numeric($user->phone)) {
                $_SESSION['adminMessages'] = array('error', 'Sorry, Theres Something Wrong with your phone number.');
            } elseif ($checkEmail > 0) {
                $_SESSION['adminMessages'] = array('error', 'Sorry, Email already taken.');
            } elseif ($checkUsername > 0) {
                $_SESSION['adminMessages'] = array('error', 'Sorry, username already taken.');
            } else {
                $user->password = md5(SAULT . md5($password) . SAULT);

                if ($user->Create()) {
                    $this->logger->info("Added New User", array('user_id' => $user->user_id ,'Admin: ' => $_SESSION['loggedin']->username));
                    if ($user->role == 'admin') {
                        $privileges = new PrivilegesModel;
                        $privileges->user_id = $user->user_id;
                        $privileges->rooms_management = filter_var($_POST['rooms_management'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                        $privileges->users_management = filter_var($_POST['users_management'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                        $privileges->messages_management = filter_var($_POST['messages_management'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                        $privileges->news_management = filter_var($_POST['news_management'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                        $privileges->testimonials_management = filter_var($_POST['testimonials_management'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                        $privileges->website_settings_management = filter_var($_POST['website_settings_management'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                        $privileges->view_reservations = filter_var($_POST['view_reservations'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                        $privileges->add_reservations = filter_var($_POST['add_reservations'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                        $privileges->update_reservations = filter_var($_POST['update_reservations'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                        $privileges->logs = filter_var($_POST['logs'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);

                        if ($privileges->Create()) {
                            $this->logger->info("Added New Admin", array('user_id' => $user->user_id ,'Admin: ' => $_SESSION['loggedin']->username));
                            $_SESSION['adminMessages'] = array('success', 'You successfully created new admin.');
                            header("location: " . HOST_NAME . 'admin/manageusers');
                        } else {
                            $admin = new UsersModel;
                            $admin->Delete(" user_id = " . $user->user_id);
                            $_SESSION['adminMessages'] = array('error', 'Sorry, Some error happened. Try again later.');
                        }
                    } else {
                        $_SESSION['adminMessages'] = array('success', 'You successfully created new user.');
                        header("location: " . HOST_NAME . 'admin/manageusers');
                    }
                } else {
                    $_SESSION['adminMessages'] = array('error', 'Sorry, Some error happened. Try again later.');
                }
            }
        }

        if (file_exists(TEMPLATE_PATH . 'governorates.php')) {
            require TEMPLATE_PATH . 'governorates.php';
        } else {
            $gov = array();
        }

        $this->_data = ['countries' => $gov];
        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function EdituserAction()
    {
        if ($_SESSION['privileges']->users_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            if (isset($_POST['submit'])) {
                $new_user = new UsersModel;
                $new_user->fullname = htmlentities(strip_tags($_POST['fullname']), ENT_QUOTES, 'UTF-8');
                $new_user->username = htmlentities(strip_tags($_POST['username']), ENT_QUOTES, 'UTF-8');
                $new_user->email = htmlentities(strip_tags($_POST['email']), ENT_QUOTES, 'UTF-8');

                if (!empty($_POST['password'])) {
                    $password = $_POST['password'];
                }

                $new_user->phone = htmlentities(strip_tags($_POST['phone']), ENT_QUOTES, 'UTF-8');
                $new_user->governorate = htmlentities(strip_tags($_POST['country']), ENT_QUOTES, 'UTF-8');

                $checkEmail = UsersModel::Count(" WHERE email = '$new_user->email'");
                $checkUsername = UsersModel::Count(" WHERE username = '$new_user->username'");

                if (!empty($new_user->phone)) {
                    if (!is_numeric($new_user->phone)) {
                        $_SESSION['adminMessages'] = array('error', 'Sorry, Theres Something Wrong with your phone number.');
                    }
                } elseif ($checkEmail > 0) {
                    $_SESSION['adminMessages'] = array('error', 'Sorry, Email already taken.');
                } elseif ($checkUsername > 0) {
                    $_SESSION['adminMessages'] = array('error', 'Sorry, username already taken.');
                } else {
                    if (!empty($_POST['password'])) {
                        $new_user->password = md5(SAULT . md5($password) . SAULT);
                    }

                    if ($new_user->Update(" user_id = " . $id)) {
                        $this->logger->info("Updated User", array('user_id' => $id ,'Admin: ' => $_SESSION['loggedin']->username));
                        $old_user = UsersModel::getOne("user_id = ". $id);
                        if ($old_user->role == 'admin') {
                            $privileges = new PrivilegesModel;
                            $privileges->user_id = $old_user->user_id;
                            $privileges->rooms_management = filter_var($_POST['rooms_management'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                            $privileges->users_management = filter_var($_POST['users_management'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                            $privileges->messages_management = filter_var($_POST['messages_management'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                            $privileges->news_management = filter_var($_POST['news_management'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                            $privileges->testimonials_management = filter_var($_POST['testimonials_management'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                            $privileges->website_settings_management = filter_var($_POST['website_settings_management'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                            $privileges->view_reservations = filter_var($_POST['view_reservations'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                            $privileges->add_reservations = filter_var($_POST['add_reservations'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                            $privileges->update_reservations = filter_var($_POST['update_reservations'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                            $privileges->logs = filter_var($_POST['logs'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
                            $privileges->Update(" user_id = '$old_user->user_id' ");
                        }

                        $_SESSION['adminMessages'] = array('success', 'You successfully updated a user.');
                        header("location: " . HOST_NAME . 'admin/manageusers');
                    } else {
                        $_SESSION['adminMessages'] = array('error', 'Sorry, Some error happened. Try again later.');
                    }
                }
            }

            $user = UsersModel::getOne("user_id = ". $id);
            if ($user->role == 'admin') {
                $privileges = PrivilegesModel::getAll(" WHERE user_id = '$user->user_id' ");
                $privileges = array_shift($privileges);
            } else {
                $privileges = null;
            }

            if (file_exists(TEMPLATE_PATH . 'governorates.php')) {
                require TEMPLATE_PATH . 'governorates.php';
            } else {
                $gov = array();
            }

            $this->_data = ['user' => $user, 'countries' => $gov, 'privileges' => $privileges];
            $this->SetView();
            $this->AdminRender([
                'view' => $this->_view
            ]);
        }
    }
    /* End Users Section */


    /* Messages Section */
    public function MessagesAction()
    {
        if ($_SESSION['privileges']->messages_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = MessagesModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $messages = MessagesModel::getAll(" LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'messages' => $messages,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function MessageAction()
    {
        if ($_SESSION['privileges']->messages_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            $message = MessagesModel::getOne(' message_id = ' . $id);
            $replies = Message_repliesModel::getAll(' WHERE message_id = ' . $id);

            $this->_data = ['message' => $message, 'replies' => $replies];
            $this->SetView();
            $this->AdminRender([
                'view' => $this->_view
            ]);
        }
    }

    public function SendmessageAction()
    {
        if ($_SESSION['privileges']->messages_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            $message = MessagesModel::getOne(" message_id = " . $id);
            if ($message) {
                if (isset($_POST['message'])) {
                    $msg = htmlentities(strip_tags($_POST['message']), ENT_QUOTES, 'UTF-8');
                    $status = 1;
                    $response = '';

                    $msg_content = "Reply from <strong>Tango Camp</strong> regarding your inquiry: ";
                    $msg_content .= "<br>";
                    $msg_content .= "Subject: " . $message->subject;
                    $msg_content .= "<br>";
                    $msg_content .= "Your message: " . $message->message;
                    $msg_content .= "<br>";
                    $msg_content .= "<br>";
                    $msg_content .= $msg;

                    $mail = new PHPMailer;
                    $mail->setFrom(CONTACT_EMAIL, 'Tango - Camp &amp; Resort');
                    $mail->addAddress($message->email, $message->name);
                    $mail->Subject = $message->subject;
                    $mail->isHTML(true);

                    $mail->Body = $msg_content;
                    $mail->AltBody = $msg_content;

                    if (!$mail->send()) {
                        $status = 0;
                        $response = "Mailer Error: " . $mail->ErrorInfo;
                    } else {
                        $reply = new Message_repliesModel;
                        $reply->message_id = $message->message_id;
                        $reply->name = $_SESSION['loggedin']->fullname;
                        $reply->email = $_SESSION['loggedin']->email;
                        $reply->message = $msg;
                        $reply->sender = 'admin';
                        if (!$reply->Create()) {
                            $status = 0;
                            $response = "Mail was sent but not saved!";
                        } else {
                            $this->logger->info("Sent new message", array('message_id' => $reply->message_id ,'Admin: ' => $_SESSION['loggedin']->username));
                            $response = $msg;
                        }
                        $original_message = new MessagesModel;
                        $original_message->status = 1;
                        $original_message->last_updated = date("Y-m-d h-i-s");
                        $original_message->Update(' message_id = ' . $id);
                    }

                    die(json_encode(array(
                        'status' => $status,
                        'response' => $response
                    )));
                }
            }
        }
    }

    public function DeletemessageAction()
    {
        if ($_SESSION['privileges']->messages_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            $message = new MessagesModel;
            if ($message->Delete(" message_id = " . $id)) {
                $this->logger->info("Deleted Message", array('message_id' => $id ,'Admin: ' => $_SESSION['loggedin']->username));
                $message_replies = new Message_repliesModel;
                $message_replies->Delete(" message_id = " . $id);

                $_SESSION['adminMessages'] = array('success', 'You successfully deleted a message.');
                header("location: " . HOST_NAME . 'admin/messages');
            }
        }
    }

    public function NewmessageAction()
    {
        if ($_SESSION['privileges']->messages_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        if (isset($_POST['send'])) {
            $email = htmlentities(strip_tags($_POST['send-to']), ENT_QUOTES, 'UTF-8');
            $subject = htmlentities(strip_tags($_POST['subject']), ENT_QUOTES, 'UTF-8');
            $message = htmlentities(strip_tags($_POST['message']), ENT_QUOTES, 'UTF-8');

            $msg_content = "Message from <strong>Tango Camp</strong>";
            $msg_content .= "<br>";
            $msg_content .= "Subject: " . $subject;
            $msg_content .= "<br>";
            $msg_content .= "<br>";
            $msg_content .= $message;

            $mail = new PHPMailer;
            $mail->setFrom(CONTACT_EMAIL, 'Tango - Camp &amp; Resort');
            $mail->addAddress($email);
            $mail->Subject = $subject;
            $mail->isHTML(true);

            $mail->Body = $msg_content;
            $mail->AltBody = $msg_content;

            if (!$mail->send()) {
                $_SESSION['adminMessages'] = array('error', "Mailer Error: " . $mail->ErrorInfo);
            } else {
                $sent_message = new Sent_messagesModel;
                $sent_message->email = $email;
                $sent_message->subject = $subject;
                $sent_message->message = $message;
                if ($sent_message->Create()) {
                    $this->logger->info("Sent new message", array('message_id' => $sent_message->message_id ,'Admin: ' => $_SESSION['loggedin']->username));
                    $_SESSION['adminMessages'] = array('success', 'You successfully sent a new message.');
                    header("location: " . HOST_NAME . 'admin/sentmessages');
                } else {
                    $_SESSION['adminMessages'] = array('success', 'Message was sent successfully but not saved.');
                    header("location: " . HOST_NAME . 'admin/sentmessages');
                }
            }
        }

        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function SentmessagesAction()
    {
        if ($_SESSION['privileges']->messages_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = Sent_messagesModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $messages = Sent_messagesModel::getAll(" LIMIT " . $start_from . ', ' . $per_page);

        $this->_data = [
            'messages' => $messages,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }
    /* End Messages Section */


    /* News Section */
    public function NewsAction()
    {
        if ($_SESSION['privileges']->news_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = NewsModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $news = NewsModel::getAll(" LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'news' => $news,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function AddnewsAction()
    {
        if ($_SESSION['privileges']->news_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        if (isset($_POST['submit'])) {
            $news = new NewsModel;
            $news->title = htmlentities(strip_tags($_POST['title']), ENT_QUOTES, 'UTF-8');
            $news->description = htmlentities(strip_tags($_POST['description']), ENT_QUOTES, 'UTF-8');
            $news->place = htmlentities(strip_tags($_POST['place']), ENT_QUOTES, 'UTF-8');
            $news->date = htmlentities(strip_tags($_POST['date']), ENT_QUOTES, 'UTF-8');

            $news->image = rand(99999999, 9) . '-' . $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];

            if ($news->Create()) {
                $this->logger->info("Added New News post", array('post_id' => $news->post_id ,'Admin: ' => $_SESSION['loggedin']->username));
                move_uploaded_file($image_tmp, IMAGES_PATH . 'blog-img/' . "$news->image");
                $_SESSION['adminMessages'] = array('success', 'You successfully created a new post.');
                header("location: " . HOST_NAME . 'admin/news');
            } else {
                $_SESSION['adminMessages'] = array('error', 'Sorry, Something wrong happened!');
                header("location: " . HOST_NAME . 'admin/addnews');
            }
        }

        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function EditnewsAction()
    {
        if ($_SESSION['privileges']->news_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {

            if (isset($_POST['submit'])) {
                $news = new NewsModel;
                $news->title = htmlentities(strip_tags($_POST['title']), ENT_QUOTES, 'UTF-8');
                $news->description = htmlentities(strip_tags($_POST['description']), ENT_QUOTES, 'UTF-8');
                $news->place = htmlentities(strip_tags($_POST['place']), ENT_QUOTES, 'UTF-8');
                $news->date = htmlentities(strip_tags($_POST['date']), ENT_QUOTES, 'UTF-8');

                if (isset($_FILES)) {
                    if (!empty($_FILES['image']['name'])) {
                        $news->image = rand(99999999, 9) . '-' . $_FILES['image']['name'];
                        $image_tmp = $_FILES['image']['tmp_name'];
                    }
                }

                if ($news->Update(" post_id = '$id' ")) {
                    $this->logger->info("Updated News post", array('post_id' => $id ,'Admin: ' => $_SESSION['loggedin']->username));
                    if ($news->image) {
                        move_uploaded_file($image_tmp, IMAGES_PATH . 'blog-img/' . "$news->image");
                    }
                    $_SESSION['adminMessages'] = array('success', 'You successfully updated a post.');
                    header("location: " . HOST_NAME . 'admin/news');
                } else {
                    $_SESSION['adminMessages'] = array('error', 'Sorry, Something wrong happened!');
                    header("location: " . HOST_NAME . 'admin/news');
                }
            }

            $oldNews = NewsModel::getOne(" post_id = " . $id);
            $this->_data = ['news' => $oldNews];
        }

        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function DeletenewsAction()
    {
        if ($_SESSION['privileges']->news_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            $news = new NewsModel;
            if ($news->Delete(" post_id = " . $id)) {
                $this->logger->info("Deleted News post", array('post_id' => $id ,'Admin: ' => $_SESSION['loggedin']->username));
                $_SESSION['adminMessages'] = array('success', 'You successfully deleted a post.');
                header("location: " . HOST_NAME . 'admin/news');
            }
        }
    }
    /* End News Section */


	/* Manage Website Section */
	public function PaymentoptionAction()
	{
        if ($_SESSION['privileges']->website_settings_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        if (isset($_POST['value'])) {
			$manage_website = new Manage_websiteModel;
			$manage_website->content = (isset($_POST['option'])) ? '1' : '2';

			if ($manage_website->Update(" setting = 'paying-option' ")) {
                $this->logger->info("Updated not paying on reservation option", array('Admin: ' => $_SESSION['loggedin']->username));
				$_SESSION['adminMessages'] = array('success', 'You successfully updated the not paying option.');
				header("location: " . HOST_NAME . 'admin/paymentoption');
			} else {
				$_SESSION['adminMessages'] = array('error', 'Error, Not paying option was not updated.');
				header("location: " . HOST_NAME . 'admin/paymentoption');
			}
		}

		$option = Manage_websiteModel::getAll(" WHERE setting = 'paying-option' LIMIT 1");
        if (empty($option)) {
            $new_option = new Manage_websiteModel;
            $new_option->setting = "paying-option";
            $new_option->content = '1';
            $new_option->Create();
            $option = Manage_websiteModel::getAll(" WHERE setting = 'paying-option' LIMIT 1");
        }

		$option = array_shift($option);

		$this->_data = ['option' => $option];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function SubscribersAction()
	{
        if ($_SESSION['privileges']->website_settings_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $data = SubscribtionModel::getAll(" WHERE status = 1 ");
		$this->_data = ['subscribers' => $data];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function ContactinfoAction()
	{
        if ($_SESSION['privileges']->website_settings_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        if (isset($_POST['submit1'])) {
			$contactinfo1 = new Contact_infoModel;
			$contactinfo1->phone = htmlentities(strip_tags($_POST['phone']), ENT_QUOTES, 'UTF-8');
			$contactinfo1->email = htmlentities(strip_tags($_POST['email']), ENT_QUOTES, 'UTF-8');
			$contactinfo1->address = htmlentities(strip_tags($_POST['address']), ENT_QUOTES, 'UTF-8');
			$id = htmlentities(strip_tags($_POST['id']), ENT_QUOTES, 'UTF-8');

			if ($contactinfo1->Update(" id = '$id' ")) {
                $this->logger->info("Updated Contact Info", array('Admin: ' => $_SESSION['loggedin']->username));
				$_SESSION['adminMessages'] = array('success', 'You successfully updated contact info');
				header("location: " . HOST_NAME . 'admin/contactinfo');
			} else {
				$_SESSION['adminMessages'] = array('error', 'Error, Contact Info was not updated.');
				header("location: " . HOST_NAME . 'admin/contactinfo');
			}
		}

		$contactinfo = Contact_infoModel::getAll();
		if (empty($contactinfo)) {
			$new_contact = new Contact_infoModel;
			$new_contact->phone = '00000000000';
			$new_contact->email = 'tango@mail.com';
			$new_contact->address = 'Dahab - South Sinai, Egypt';
			$new_contact->Create();
			
			$contactinfo = Contact_infoModel::getAll();
		}
		
		$contactinfo = array_shift($contactinfo);

		$this->_data = ['contactinfo' => $contactinfo];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function AboutusAction()
	{
        if ($_SESSION['privileges']->website_settings_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        if (isset($_POST['aboutus-edit'])) {
			$manage_website = new Manage_websiteModel;
			$manage_website->content = htmlentities(strip_tags($_POST['aboutus-edit']), ENT_QUOTES, 'UTF-8');

			if ($manage_website->Update(" setting = 'aboutus' ")) {
                $this->logger->info("Updated About us", array('Admin: ' => $_SESSION['loggedin']->username));
				$_SESSION['adminMessages'] = array('success', 'You successfully updated about us');
				header("location: " . HOST_NAME . 'admin/aboutus');
			} else {
				$_SESSION['adminMessages'] = array('error', 'Error, About us was not updated.');
				header("location: " . HOST_NAME . 'admin/aboutus');
			}
		}

		$aboutus = Manage_websiteModel::getAll(" WHERE setting = 'aboutus' LIMIT 1");
        if (empty($aboutus)) {
            $new_about = new Manage_websiteModel;
            $new_about->setting = "aboutus";
            $new_about->content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.";
            $new_about->image = '2.jpg';
            $new_about->Create();
            $aboutus = Manage_websiteModel::getAll(" WHERE setting = 'aboutus' LIMIT 1");
        }

		$aboutus = array_shift($aboutus);

		$this->_data = ['aboutus' => $aboutus];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function Aboutus1Action()
	{
        if ($_SESSION['privileges']->website_settings_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        if (isset($_POST['aboutus-edit'])) {
			$manage_website = new Manage_websiteModel;
			$manage_website->content = htmlentities(strip_tags($_POST['aboutus-edit']), ENT_QUOTES, 'UTF-8');

			if ($manage_website->Update(" setting = 'home-aboutus1' ")) {
				$_SESSION['adminMessages'] = array('success', 'You successfully updated home about us');
				header("location: " . HOST_NAME . 'admin/aboutus1');
			} else {
				$_SESSION['adminMessages'] = array('error', 'Error, About us was not updated.');
				header("location: " . HOST_NAME . 'admin/aboutus1');
			}
		}

		$aboutus = Manage_websiteModel::getAll(" WHERE setting = 'home-aboutus1' LIMIT 1");
        if (empty($aboutus)) {
            $new_about = new Manage_websiteModel;
            $new_about->setting = "home-aboutus1";
            $new_about->content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.";
            $new_about->image = '2.jpg';
            $new_about->Create();
            $aboutus = Manage_websiteModel::getAll(" WHERE setting = 'home-aboutus1' LIMIT 1");
        }

		$aboutus = array_shift($aboutus);

		$this->_data = ['aboutus' => $aboutus];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function Aboutus2Action()
	{
        if ($_SESSION['privileges']->website_settings_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        if (isset($_POST['aboutus-edit'])) {
			$manage_website = new Manage_websiteModel;
			$manage_website->content = htmlentities(strip_tags($_POST['aboutus-edit']), ENT_QUOTES, 'UTF-8');

			if ($manage_website->Update(" setting = 'home-aboutus2' ")) {
				$_SESSION['adminMessages'] = array('success', 'You successfully updated home about us');
				header("location: " . HOST_NAME . 'admin/aboutus2');
			} else {
				$_SESSION['adminMessages'] = array('error', 'Error, About us was not updated.');
				header("location: " . HOST_NAME . 'admin/aboutus2');
			}
		}

		$aboutus = Manage_websiteModel::getAll(" WHERE setting = 'home-aboutus2' LIMIT 1");
        if (empty($aboutus)) {
            $new_about = new Manage_websiteModel;
            $new_about->setting = "home-aboutus2";
            $new_about->content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.";
            $new_about->image = '2.jpg';
            $new_about->Create();
            $aboutus = Manage_websiteModel::getAll(" WHERE setting = 'home-aboutus2' LIMIT 1");
        }

		$aboutus = array_shift($aboutus);

		$this->_data = ['aboutus' => $aboutus];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function Aboutus3Action()
	{
        if ($_SESSION['privileges']->website_settings_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        if (isset($_POST['aboutus-edit'])) {
			$manage_website = new Manage_websiteModel;
			$manage_website->content = htmlentities(strip_tags($_POST['aboutus-edit']), ENT_QUOTES, 'UTF-8');

			if ($manage_website->Update(" setting = 'home-aboutus3' ")) {
				$_SESSION['adminMessages'] = array('success', 'You successfully updated home about us');
				header("location: " . HOST_NAME . 'admin/aboutus3');
			} else {
				$_SESSION['adminMessages'] = array('error', 'Error, About us was not updated.');
				header("location: " . HOST_NAME . 'admin/aboutus3');
			}
		}

		$aboutus = Manage_websiteModel::getAll(" WHERE setting = 'home-aboutus3' LIMIT 1");
        if (empty($aboutus)) {
            $new_about = new Manage_websiteModel;
            $new_about->setting = "home-aboutus3";
            $new_about->content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.";
            $new_about->image = '2.jpg';
            $new_about->Create();
            $aboutus = Manage_websiteModel::getAll(" WHERE setting = 'home-aboutus3' LIMIT 1");
        }

		$aboutus = array_shift($aboutus);

		$this->_data = ['aboutus' => $aboutus];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function TermsconditionsAction()
	{
        if ($_SESSION['privileges']->website_settings_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        if (isset($_POST['termsconditions'])) {
			$manage_website = new Manage_websiteModel;
			$manage_website->content = htmlentities(strip_tags($_POST['termsconditions']), ENT_QUOTES, 'UTF-8');

			if ($manage_website->Update(" setting = 'termsconditions' ")) {
                $this->logger->info("Updated Terms & Conditions", array('Admin: ' => $_SESSION['loggedin']->username));
				$_SESSION['adminMessages'] = array('success', 'You successfully updated terms & conditions');
				header("location: " . HOST_NAME . 'admin/termsconditions');
			} else {
				$_SESSION['adminMessages'] = array('error', 'Error, Terms & Consitions was not updated.');
				header("location: " . HOST_NAME . 'admin/termsconditions');
			}
		}
		
		$termsconditions = Manage_websiteModel::getAll(" WHERE setting = 'termsconditions' LIMIT 1");
        if (empty($termsconditions)) {
            $new_termsconditions = new Manage_websiteModel;
            $new_termsconditions->setting = "termsconditions";
            $new_termsconditions->content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.";
            $new_termsconditions->image = '2.jpg';
            $new_termsconditions->Create();
            $termsconditions = Manage_websiteModel::getAll(" WHERE setting = 'termsconditions' LIMIT 1");
        }

        $termsconditions = array_shift($termsconditions);
		$this->_data = ['termsconditions' => $termsconditions];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function LogsAction()
    {
        if ($_SESSION['privileges']->logs !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $data = (file_exists(LOG_FILE)) ? file_get_contents(LOG_FILE) : null;

        $this->_data = ['logs' => $data];
        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }
	/* End Manage Website Section */


    /* Testimonials Section */
    public function ManagetestimonialsAction()
    {
        if ($_SESSION['privileges']->testimonials_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = TestimonialsModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $testimonials = TestimonialsModel::getAll(" LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'testimonials' => $testimonials,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }

    public function DeletetestimonialAction()
    {
        if ($_SESSION['privileges']->testimonials_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            $testimonial = new TestimonialsModel;
            if ($testimonial->Delete(" id = " . $id)) {
                $this->logger->info("Deleted Testimonial", array('testimonial_id' => $id ,'Admin: ' => $_SESSION['loggedin']->username));
                $_SESSION['adminMessages'] = array('success', 'You successfully deleted a testimonial.');
                header("location: " . HOST_NAME . 'admin/managetestimonials');
            }
        }
    }

    public function AddtestimonialsAction()
    {
        if ($_SESSION['privileges']->testimonials_management !== '1') {
            header("location: ". HOST_NAME . 'admin');
        }

        if (isset($_POST['name'])) {
            $testimonial = new TestimonialsModel;
            $testimonial->name = htmlentities(strip_tags($_POST['name']), ENT_QUOTES, 'UTF-8');
            $testimonial->position = htmlentities(strip_tags($_POST['job']), ENT_QUOTES, 'UTF-8');
            $testimonial->review = htmlentities(strip_tags($_POST['review']), ENT_QUOTES, 'UTF-8');
            $testimonial->image = rand(99999999, 9) . '-' . $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];

            if ($testimonial->Create()) {
                $this->logger->info("Added New Testimonial", array('testimonial_id' => $testimonial->id ,'Admin: ' => $_SESSION['loggedin']->username));
                move_uploaded_file($image_tmp, IMAGES_PATH . 'testimonial-img/' . "$testimonial->image");
                $_SESSION['adminMessages'] = array('success', 'You successfully created new testimonial.');
                header("location: " . HOST_NAME . 'admin/managetestimonials');
            }
        }

        $this->SetView();
        $this->AdminRender([
            'view' => $this->_view
        ]);
    }
    /* End Testimonials Section */


    public function ProfileAction()
	{
		$user = $_SESSION['loggedin'];
		$view_user = UsersModel::getOne('user_id = ' . $user->user_id);
		$this->_data = ['user' => $view_user];
		$this->SetView();
		$this->AdminRender([
			'view' => $this->_view
		]);
	}

	public function SignoutAction()
	{
		if (isset($_SESSION['loggedin'])) {
			unset($_SESSION['loggedin']);
			session_destroy();
			header("location: ". HOST_NAME);
		} else {
			header("location: ". HOST_NAME);
		}
	}
}
