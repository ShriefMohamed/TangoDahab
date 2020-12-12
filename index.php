<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('CONFIG_PATH', 'app' . DS);

if (file_exists(CONFIG_PATH . 'config.php')) 
{
 	require_once CONFIG_PATH . 'config.php';
}

?>