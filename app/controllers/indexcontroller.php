<?php

namespace Framework\Controllers;
use Framework\Lib\AbstractController;

use Framework\Models\MessagesModel;
use Framework\Models\NewsModel;
use Framework\Models\TestimonialsModel;
use Framework\Models\SubscribtionModel;
use Framework\Models\UsersModel;
use Framework\Models\RoomsModel;
use Framework\Models\Manage_websiteModel;
use Framework\Models\Contact_infoModel;

// notifications:
//      reservation, payment, contact (admin/customer)
//          messages (admin/customer)

//      logger*
//      privileges*
//      currency*
//      multi languages
//      manual
//      reservations


class IndexController extends AbstractController
{
	public function DefaultAction()
	{
        $rooms = RoomsModel::getAll(" WHERE status = 'active' LIMIT 3 ");
        $aboutus = Manage_websiteModel::getAll(" WHERE setting = 'aboutus' LIMIT 1");
        $contactinfo = Contact_infoModel::getAll();

        if (empty($aboutus)) {
            $new_about = new Manage_websiteModel;
            $new_about->setting = "aboutus";
            $new_about->content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.";
            $new_about->image = '2.jpg';
            $new_about->Create();
            $aboutus = Manage_websiteModel::getAll(" WHERE setting = 'aboutus' LIMIT 1");
        }
        $aboutus = array_shift($aboutus);

        if (empty($contactinfo)) {
            $new_contact = new Contact_infoModel;
            $new_contact->phone = '00000000000';
            $new_contact->email = 'tango@mail.com';
            $new_contact->address = 'Dahab - South Sinai, Egypt';
            $new_contact->Create();
            
            $contactinfo = Contact_infoModel::getAll();
        }        
        $contactinfo = array_shift($contactinfo);

        $this->_data = ['rooms' => $rooms, 'aboutus' => $aboutus, 'contactinfo' => $contactinfo];
		$this->SetView();
		$this->Render([
            'hero-area' => 'hero-area',
            'book-now-area' => 'book-now-area',
			'view' => $this->_view
		]);
	}

    public function RoomsAction()
    {
        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = RoomsModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $rooms = RoomsModel::getAll(" WHERE status = 'active' LIMIT " . $start_from . ', ' . $per_page);

        $this->_data = [
            'rooms' => $rooms,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];
        $this->SetView();
        $this->Render([
            'breadcumb-area' => 'breadcumb-area',
            'book-now-area' => 'book-now-area',
            'view' => $this->_view
        ]);
    }

    public function GetfroomAction()
    {
        $id = ($this->_params) != null ? $this->_params['0'] : 0;
        $room = RoomsModel::getOne(" room_id = '$id' ");
        if ($room) {
            $usd_price = $this->convertCurrency($room->price, 'EGP', 'USD');

            die(json_encode(array(
                'room_id' => $room->room_id,
                'backgroundDiv' => $room->image,
                'roomPrice' => $room->price,
                'usd_price' => $usd_price,
                'roomType' => ucfirst($room->room_type),
                'roomBeds' => $room->beds,
                'roomDescription' => substr($room->description, 0, 100)
            )));
        }
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
                            $usdTotal = $this->convertCurrency($total, 'EGP', 'USD');
                            die(json_encode(array(
                                'status' => 1,
                                'total' => $total,
                                'usd_total' => $usdTotal
                            )));
                        }
                    }
                    
                }
            }
        }
    }

    public function NewsAction()
    {
        $page = ($this->_params) != null ? $this->_params['0'] : 1;

        if (!isset($page) || !is_numeric($page)) {
            $page = 1;
        }

        $per_page = 10;
        $total_records = RoomsModel::Count();
        $start_from = ($page-1) * $per_page;
        $total_pages = ceil($total_records / $per_page);

        $news = NewsModel::getAll(" LIMIT " . $start_from . ', ' . $per_page);

        $this->_data = [
            'news' => $news,
            'total_records' => $total_records,
            'total_pages' => $total_pages
        ];

        $this->SetView();
        $this->Render([
            'breadcumb-area' => 'breadcumb-area',
            'book-now-area' => 'book-now-area',
            'view' => $this->_view
        ]);
    }

    public function PostAction()
    {
        $id = ($this->_params) != null ? $this->_params[0] : false;
        if ($id != false) {
            $news = NewsModel::getOne(" post_id = " . $id);

            if ($news) {
                $views = new NewsModel;
                $view = intval($news->views) + 1;
                $views->views = $view;
                $views->Update(' post_id = ' . $id);
            }

            $this->_data = ['post' => $news];
            $this->SetView();
            $this->Render([
                'breadcumb-area' => 'breadcumb-area',
                'book-now-area' => 'book-now-area',
                'view' => $this->_view
            ]);
        }
    }


    private function NewOrderNotifications($order_id = '0')
    {
        $admins = UsersModel::getAll(" WHERE role = 'admin' ");
        $order = OrdersModel::getAllOrders(" WHERE orders.id = " . $order_id);
        $template = Manage_websiteModel::getAll(" WHERE setting = 'new_order_template'");

        if ($admins != null && $order != null && $template != null) {
            $order = array_shift($order);
            $template = array_shift($template);

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
            $message = $template->content;
            $message .= "<br> Order Details: <br>";
            $message .= "Customer's Info.
                        <br> Customer's Name: " . $order->fullname . "
                        <br> Customer's Email: " . $order->email . "
                        <br> Customer's Phone: " . $order->phone . "
                        <br> Customer's Billing Address: " . $order->billing_address . "
                        <br> Customer's Shipping Address: " . $order->shipping_address . "
                        <br> Customer's Country: " . $order->country_name . "
                        <br> Customer's State: " . $order->state . "
                        <br> Customer's Zip Code: " . $order->zip . "
                        <br> Order's Info.
                        <br> Order's Sub-Total: " . CURRENCY . $order->sub_total . "
                        <br> Shipping Cost: " . CURRENCY . $order->shipping_cost . "
                        <br> Order's Total: " . CURRENCY . $order->total . "
                        <br> Payment Method: " . ucfirst($order->payment_method) . "
                        <br> Date&Time Order Was Placed: " . $order->date;

            foreach ($admins as $admin) {
                mail($admin->email, "New Order Notification", $message, $headers);
            }
        }
    }


    public function ContactAction()
    {
        if (isset($_POST['send'])) {
            $name = $_POST['contact-name'];
            $email = $_POST['contact-email'];
            $subject = $_POST['contact-subject'];
            $msg = $_POST['contact-message'];

            if(!isset($name) || !isset($email) || !isset($subject) || !isset($msg) ||
                empty($name) || empty($email) || empty($subject) || empty($msg)) {
                $json_arr = array( "type" => "Error", "msg" => 'Please fill in all fields!');
                echo "<script>alert('" . $json_arr['type'] . ", " . $json_arr['msg'] . "')</script>";
            } else {
                $support = new MessagesModel;
                $support->name = $name;
                $support->email = $email;
                $support->subject = $subject;
                $support->message = $msg;
                $support->status = '0';

                if ($support->Create()) {
                    $json_arr = array( "type" => "Success", "msg" => 'Your message was sent successfully.');
                    echo "<script>alert('" . $json_arr['type'] . ", " . $json_arr['msg'] . "')</script>";
                }
            }
            header("location: " . HOST_NAME . 'index/contact');
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
        $this->Render([
            'breadcumb-area' => 'breadcumb-area',
            'book-now-area' => 'book-now-area',
            'view' => $this->_view
        ]);
    }

    public function AboutusAction()
    {
        $aboutus = Manage_websiteModel::getAll(" WHERE setting = 'aboutus' LIMIT 1");
        $testimonials = TestimonialsModel::getAll();

        if (empty($aboutus)) {
            $new_about = new Manage_websiteModel;
            $new_about->setting = "aboutus";
            $new_about->content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.";
            $new_about->image = '2.jpg';
            $new_about->Create();
            $aboutus = Manage_websiteModel::getAll(" WHERE setting = 'aboutus' LIMIT 1");
        }

        $aboutus = array_shift($aboutus);

        $this->_data = ['aboutus' => $aboutus, 'testimonials' => $testimonials];
        $this->SetView();
        $this->Render([
            'breadcumb-area' => 'breadcumb-area',
            'book-now-area' => 'book-now-area',
            'view' => $this->_view
        ]);
    }

    public function TermsconditionsAction()
    {
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
        $this->Render([
            'breadcumb-area' => 'breadcumb-area',
            'book-now-area' => 'book-now-area',
            'view' => $this->_view
        ]);
    }

    public function SubscribeAction()
    {
        if (isset($_POST['subscribe-email'])) {
            $status = 0;

            $email = htmlentities(strip_tags($_POST['subscribe-email']), ENT_QUOTES, 'UTF-8');
            $subscriber = SubscribtionModel::getAll(" WHERE email = '$email' ");
            if (empty($subscriber)) {
                $subscribe = new SubscribtionModel;
                $subscribe->email = $email;

                if ($subscribe->Create()) {
                    $status = 1;
                }
            } else {
                $status = 2;
            }

            die(json_encode(array(
                'status' => $status
            )));
        }
    }
}

?>