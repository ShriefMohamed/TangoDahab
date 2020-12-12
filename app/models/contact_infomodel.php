<?php

namespace Framework\Models;
use Framework\Lib\AbstractModel;

class Contact_infoModel extends AbstractModel
{
	public $id;
	public $phone;
	public $email;
	public $address;

	protected static $tableName = 'contact_info';
    protected static $pk = 'id';

	protected $tableSchema = array(
		'phone',
		'email',
		'address'
		);
}	