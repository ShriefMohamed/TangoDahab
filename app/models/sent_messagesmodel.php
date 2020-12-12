<?php
/**
 * sent_messagesmodel.php @ TangoDahab
 * Created by PhpStorm.
 * User: shrief
 * Date: 3/13/19
 * Time: 9:59 AM
 * @User\Developer Shrief Mohamed
 */

namespace Framework\models;


use Framework\Lib\AbstractModel;

class Sent_messagesModel extends AbstractModel
{
    public $message_id;
    public $email;
    public $subject;
    public $message;
    public $date;

    protected static $tableName = 'sent_messages';
    protected static $pk = 'message_id';

    protected $tableSchema = array(
        'email',
        'subject',
        'message'
    );
}