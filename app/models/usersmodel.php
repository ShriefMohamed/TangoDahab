<?php

namespace Framework\Models;
use Framework\Lib\AbstractModel;

class UsersModel extends AbstractModel
{
	public $user_id;
	public $fullname;
	public $username;
	public $email;
	public $password;
	public $phone;
	public $governorate;
	public $role;
	public $created;

	protected static $tableName = 'users';
    protected static $pk = 'user_id';

	protected $tableSchema = array(
		'fullname',
		'username',
		'email',
		'password',
		'phone',
		'governorate',
		'role',
		'created'
		);	

	##### auth ##########
	// Parameters :- a: username/email, b: password
	// Return :- user's info/false
	// Purpose :- authenticate user for login by checking his email/username and password if they match any users in the database.
	###########################
	public static function auth($username, $password)
	{
		$sql = "select * from users where (username = '$username' or email = '$username') and password = '$password'";
		$stmt = parent::$db->prepare($sql);
		$stmt->execute();
		if ($stmt->rowCount() == 1) {
			return $stmt->fetchObject(__CLASS__);
		} else {
			return false;
		}
	}
}	