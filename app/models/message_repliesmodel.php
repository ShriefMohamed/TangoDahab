<?php
/**
 * message_repliesmodel.php @ TangoDahab
 * Created by PhpStorm.
 * User: shrief
 * Date: 3/10/19
 * Time: 7:20 AM
 * @User\Developer Shrief Mohamed
 */

namespace Framework\models;


use Framework\Lib\AbstractModel;

class Message_repliesModel extends AbstractModel
{
    public $reply_id;
    public $message_id;
    public $name;
    public $email;
    public $message;
    public $date;
    public $sender;

    protected static $tableName = 'message_replies';
    protected static $pk = 'reply_id';

    protected $tableSchema = array(
        'message_id',
        'name',
        'email',
        'message',
        'sender'
    );
}