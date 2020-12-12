<?php

use Framework\Lib\Database;
use Framework\Lib\FrontController;
use Framework\Lib\AbstractModel;

ob_start();

// set displaying error to 1 (1 display) (0 don't display)
ini_set('display_errors', 1);

// define some of the nessesary directories and paths so it be easier later to call them
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('APP_PATH') ? null : define('APP_PATH', realpath(dirname(__file__)) .DS);
defined('HOST_NAME') ? null : define('HOST_NAME', 'http://' . $_SERVER['HTTP_HOST'] . '/');
defined('CURRENT_URI') ? null : define('CURRENT_URI', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

define('LIB_PATH', APP_PATH . 'lib' .DS);
define('MODELS_PATH', APP_PATH . 'models' .DS);
define('VIEWS_PATH', APP_PATH . 'views' .DS);
define('CONTROLLERS_PATH', APP_PATH . 'controllers' .DS);
define('TEMPLATE_PATH', VIEWS_PATH . '_template' .DS);

define('PUBLIC_PATH', APP_PATH . '..' . DS);
define('CSS_PATH', PUBLIC_PATH . 'css' .DS);
define('IMAGES_PATH', PUBLIC_PATH . 'img' .DS);
define('PAYPAL_SDK_PATH', APP_PATH . 'PayPal-PHP-SDK' .DS);
define('LOG_FILE', APP_PATH . 'logs.log');

defined('PUBLIC_DIR') ? null : define('PUBLIC_DIR', HOST_NAME);
defined('CSS_DIR') ? null : define('CSS_DIR', HOST_NAME . 'style/');
defined('JS_DIR') ? null : define('JS_DIR', HOST_NAME . 'js/');
defined('ASSETS_DIR') ? null : define('ASSETS_DIR', HOST_NAME . 'assets/');
define('IMAGES_DIR', HOST_NAME . 'img/');
define('ADMIN_IMAGES_DIR', HOST_NAME . 'admin_images/');

define('FIXER_API', '3127c7caacc542616b7da382ab14dcac');

// define the database credentials to use later at the database class
define('DB_HOST', 'localhost');
define('DB_NAME', 'tango');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');

// define('DB_NAME', 'shriefmo_tango');
// define('DB_USER', 'shriefmo_admin');
// define('DB_PASSWORD', '9aTFga4c^82@');

defined('SAULT') ? null : define('SAULT', 'SHRIEF.MD@SHA3');

define('CONTACT_EMAIL', 'tango@mail.com');

// require autoload so the Classes get called automaticly without the need of "require" or "include"
if (file_exists(APP_PATH . DS . 'lib' . DS . 'autoload.php')) {
	require_once APP_PATH . DS . 'lib' . DS . 'autoload.php';
}

// start the session for the whole website so we can use $_SESSION anywhere in the website without starting it again
session_start();
// start the database connection and put it at the variable "$db"
$db = Database::getconnection();
// put the database connection in the AbstractModel class
// the abstract model is the main model that all the other model classes will extend,
// and the models are the only classes that intracts with the database so by adding the database connection at
// the abstract model then every model class will have access to the database connection
AbstractModel::$db = $db;
// call the FrontController class which is the class that will take the url and then require the right files and classes
$FrontController = new FrontController;

ob_flush();
