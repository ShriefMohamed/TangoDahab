<?php

namespace Framework\Lib;

// all the controllers extends this abstract controller
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

//Load Composer's autoloader
require APP_PATH . 'vendor/autoload.php';


class AbstractController
{
	protected $_controller;
	protected $_action;
	protected $_params;
	protected $_view;
	protected $_data = [];
	protected $logger;

	public function __construct()
    {
        $dateFormat = "Y-m-d H:i:s a";
        $output = "[%datetime%] %channel%.%level_name%: %message% %context%*\n";
        $formatter = new LineFormatter($output, $dateFormat);

        $stream = new StreamHandler(LOG_FILE, Logger::DEBUG);
        $stream->setFormatter($formatter);

        $this->logger = new Logger('logs.tango');
        $this->logger->pushHandler($stream);
        $this->logger->pushHandler(new FirePHPHandler());
    }

    ##### NotFoundAction ##########
	// Parameters :- None
	// Return Type :- None
	// Purpose :- at the frontcontroller if the controller class or the function/action doesn't exist then the not found
	// action is the one that get called to display a 404 not found
	###########################
	public function NotFoundAction()
	{		
		$this->SetView();
		$this->Render([
			'view' => $this->_view
		]);
	}

	##### SetController ##########
	// Parameters :- a: Conroller Class Name
	// Return Type :- None
	// Purpose :- the function used at the front controller to pass the controller name to the abstract controller and
	// by that to any class extends this class (abstract controller)
	###########################
	public function SetController($controllerName)
	{
		$this->_controller = $controllerName;
	}

	##### SetAction ##########
	// Parameters :- a: Action name
	// Return Type :- None
	// Purpose :- the function used at the front controller to pass the action name to the abstract controller
	###########################
	public function SetAction($actionName)
	{
		$this->_action = $actionName;
	}

	##### SetParams ##########
	// Parameters :- a: Parameters
	// Return Type :- None
	// Purpose :- the function used at the front controller to pass the parameters to the abstract controller 
	###########################
	public function SetParams($params)
	{
		$this->_params = $params;
	}

	##### SetView ##########
	// Parameters :- None
	// Return Type :- None
	// Purpose :- we use this at any function to set what view (html file) we want to require
	// with such a function we don't have to "require/include" some html file every time
	//  we just call this function and it does that automaticly
	###########################
	protected function SetView()
	{
		if ($this->_action == FrontController::NOT_FOUND_ACTION) {
			$this->_view = VIEWS_PATH . 'notfound' . DS . 'notfound.view.php';
		} else {			
			$this->_view = VIEWS_PATH . $this->_controller . DS . strtolower($this->_action) . '.view.php';			
		}
	}

	##### Render ##########
	// Parameters :- a: The html view directory
	// Return Type :- None
	// Purpose :- after we called the "setView" function we have to call "render" to actually call the required files
	// and if we have some data at the controller class and we want to pass it to the view we just put this data
	// at the variable _data and  the render function takes this data and convert it to a variable which can be
	// accessed at the view
	// for example if we fetched some posts from the database at the controller class and we want to send this data
	// to the html file (view) so it get displayed, 
	// $_data = ['posts' => $posts]
	// and then $Render($_view)
	// then at the view we can use the variable $posts which will contain all the data we fetched at the controller class
	###########################
	public function Render($views)
	{
		extract($this->_data);

		require_once TEMPLATE_PATH . 'head.php';
		require_once TEMPLATE_PATH . 'header.php';

		foreach ($views as $view => $value) {
			if ($view != 'view') {
				require_once TEMPLATE_PATH . $value . '.php';
			} else {
				require_once $value;
			}
		}

		require_once TEMPLATE_PATH . 'footer.php';
	}

	public function AdminRender($views)
	{
		extract($this->_data);

		require_once TEMPLATE_PATH . 'admin_head.php';
		require_once TEMPLATE_PATH . 'admin_left_panel.php';
		require_once TEMPLATE_PATH . 'admin_header.php';

		foreach ($views as $view => $value) {
			if ($view != 'view') {
				require_once TEMPLATE_PATH . $value . '.php';
			} else {
				require_once $value;
			}
		}

		require_once TEMPLATE_PATH . 'admin_footer.php';
	}

	##### RenderView ##########
	// Parameters :- a: The html view directory
	// Return Type :- None
	// Purpose :- to render only one html template from the template folder.
	###########################
	public static function RenderTemplate($view)
	{
		require_once TEMPLATE_PATH . $view . '.php';
	}

	##### RenderOnlyView ##########
	// Parameters :- a: The html view directory
	// Return Type :- None
	// Purpose :- to render only the view without any html template like rendering the login page.
	###########################
	public function RenderOnlyView($view)
	{
		extract($this->_data);
		
		require_once $view;
	}

	public function DateDiff($date, $date1)
	{
		$date = new \DateTime($date);
		$date1 = new \DateTime($date1);
		$diff = $date->diff($date1);
		return $diff;
	}

    public function Highlight($menu)
    {
        if ($this->_action == $menu) echo "active";
    }

    protected function convertCurrency($amount, $from = 'EGP', $to = 'USD'){
        @$curl = file_get_contents("http://data.fixer.io/api/latest?access_key=".FIXER_API."&symbols=$from,$to");
        @$arr = json_decode($curl,true);

        $from = $arr['rates'][$from];
        $to = $arr['rates'][$to];

        if ($from && $to) {
            $rate = $to / $from;
            $result = ($rate) ? round($amount * $rate, 2) : null;
        } else {
            $result = null;
        }
        return $result;
    }

}

?>