<?php

namespace Framework\Models;
use Framework\Lib\AbstractModel;

class SubscribtionModel extends AbstractModel
{
	public $id;
	public $email;
	public $date_subscribe;
	public $date_unsubscribe;
	public $status;

	protected static $tableName = 'subscribtion';
    protected static $pk = 'id';

	protected $tableSchema = array(
		'email',
		'date_subscribe',
		'date_unsubscribe',
		'status'
		);
}	