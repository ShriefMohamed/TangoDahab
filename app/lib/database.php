<?php

namespace Framework\Lib;

class Database
{
	private static $connection;

	private function __construct() {}

	##### GetConnection ##########
	// Parameters :- None
	// Return Type :- Database Connection
	// Purpose :- Connect to the database and return that connection.
	###########################
	public static function GetConnection()
	{
		if (self::$connection === null) 
		{
			try {
				self::$connection = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
			} catch (Exception $e) {
				echo 'Database connection can not be estabilished. Please try again later.' . '<br>';
                echo 'Error code: ' . $e->getCode();				
                exit;
			}
		}
		return self::$connection;
	}
}

?>