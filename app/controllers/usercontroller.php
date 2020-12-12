<?php

namespace Framework\Controllers;
// Framework classes
use Framework\Lib\AbstractController;
use Framework\Models\InvoicesModel;
use Framework\models\Message_repliesModel;
use Framework\Models\MessagesModel;
use Framework\Models\ReservationsModel;
use Framework\Models\UsersModel;
use Framework\Models\Contact_infoModel;

class UserController extends AbstractController
{
    public function ReservationsAction()
    {
        $page = ($this->_params) != null ? $this->_params['0'] : 1;
        if (!isset($page) || !is_numeric($page)) {$page = 1;}

        $per_page = 10;
        $total_records = ReservationsModel::Count(" WHERE email = '".$_SESSION['loggedin']->email."' ");
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $invoices = InvoicesModel::getReservations( " WHERE reservations.email = '".$_SESSION['loggedin']->email."' ORDER BY reservations.reservation_date DESC LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'invoices' => $invoices,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
        $this->SetView();
        $this->Render([
            'breadcumb-area' => 'breadcumb-area',
            'view' => $this->_view
        ]);
    }

    public function ReservationreceiptAction()
    {
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

            if ($invoice->reservation_status !== 'confirmed') {
                header("location: " . HOST_NAME . 'user/reservations');
            }

            $this->_data = [
                'contactinfo' => $contactinfo,
                'reservation' => $invoice
            ];
            $this->SetView();
            $this->RenderOnlyView($this->_view);
        }
    }


    public function MessagesAction()
    {
        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = MessagesModel::Count(" WHERE email = '".$_SESSION['loggedin']->email."' ");
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $messages = MessagesModel::getAll(" WHERE email = '".$_SESSION['loggedin']->email."' LIMIT " . $start_from . ', ' . $per_page);
        $this->_data = [
            'messages' => $messages,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
        $this->SetView();
        $this->Render([
            'breadcumb-area' => 'breadcumb-area',
            'view' => $this->_view
        ]);
    }

    public function MessageAction()
    {
        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            $message = MessagesModel::getOne(" message_id = '$id' AND email = '".$_SESSION['loggedin']->email."' ");
            $replies = Message_repliesModel::getAll(' WHERE message_id = ' . $id);

            $this->_data = ['message' => $message, 'replies' => $replies];
            $this->SetView();
            $this->Render([
                'breadcumb-area' => 'breadcumb-area',
                'view' => $this->_view
            ]);
        }
    }

    public function SendmessageAction()
    {
        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            $message = MessagesModel::getOne(" message_id = " . $id);
            if ($message) {
                if (isset($_POST['message'])) {
                    $msg = htmlentities(strip_tags($_POST['message']), ENT_QUOTES, 'UTF-8');
                    $status = 1;
                    $response = '';

                    $reply = new Message_repliesModel;
                    $reply->message_id = $message->message_id;
                    $reply->name = $_SESSION['loggedin']->fullname;
                    $reply->email = $_SESSION['loggedin']->email;
                    $reply->message = $msg;
                    $reply->sender = 'customer';
                    if ($reply->Create()) {
                        $response = $msg;
                        $original_message = new MessagesModel;
                        $original_message->status = 0;
                        $original_message->last_updated = date("Y-m-d h-i-s");
                        $original_message->Update(' message_id = ' . $id);
                    } else {
                        $status = 0;
                        $response = "Message could not be saved!";
                    }

                    die(json_encode(array(
                        'status' => $status,
                        'response' => $response
                    )));
                }
            }
        }
    }


	public function EditprofileAction()
	{
		$id = $_SESSION['loggedin']->user_id;

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
                    echo "<script>alert('Sorry, There\'s Something Wrong with your phone number.')</script>";
                }
            } elseif ($checkEmail > 0) {
                echo "<script>alert('Sorry, Email already taken.')</script>";
            } elseif ($checkUsername > 0) {
                echo "<script>alert('Sorry, username already taken.')</script>";
            } else {
                if (!empty($_POST['password'])) {
                    $new_user->password = md5(SAULT . md5($password) . SAULT);
                }

                if ($new_user->Update(" user_id = " . $id)) {
                    echo "<script>alert('Your profile was updated successfully.')</script>";
                    echo "<script>window.open('".HOST_NAME."user/profile','_self')</script>";
                }
            }
        }

    	$user = UsersModel::getOne(' user_id = ' . $id);
        if (file_exists(TEMPLATE_PATH . 'governorates.php')) {
            require TEMPLATE_PATH . 'governorates.php';
        } else {
            $gov = array();
        }

        $this->_data = ['user' => $user, 'countries' => $gov];
		$this->SetView();
		$this->Render([
            'breadcumb-area' => 'breadcumb-area',
			'view' => $this->_view
		]);
	}

	public function ProfileAction()
	{
		$user = $_SESSION['loggedin'];
        if (file_exists(TEMPLATE_PATH . 'governorates.php')) {
            require TEMPLATE_PATH . 'governorates.php';
        } else {
            $gov = array();
        }
		$view_user = UsersModel::getOne(' user_id = ' . $user->user_id);
		$this->_data = ['user' => $view_user];
		$this->SetView();
		$this->Render([
            'breadcumb-area' => 'breadcumb-area',
            'book-now-area' => 'book-now-area',
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