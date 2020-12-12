<?php

namespace Framework\Models;
use Framework\Lib\AbstractModel;

class MessagesModel extends AbstractModel
{
	public $message_id;
	public $name;
	public $email;
	public $subject;
	public $message;
	public $date;
	public $last_updated;
	public $status;

	protected static $tableName = 'messages';
    protected static $pk = 'message_id';

	protected $tableSchema = array(
		'name',
		'email',
		'subject',
		'message',
		'last_updated',
		'status'
    );
}	