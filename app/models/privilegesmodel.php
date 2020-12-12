<?php
/**
 * privilegesmodel.php @ TangoDahab
 * Created by PhpStorm.
 * User: shrief
 * Date: 4/6/19
 * Time: 10:21 AM
 * @User\Developer Shrief Mohamed
 */

namespace Framework\models;


use Framework\Lib\AbstractModel;

class PrivilegesModel extends AbstractModel
{
    public $id;
    public $user_id;

    public $rooms_management;
    public $users_management;
    public $messages_management;
    public $news_management;
    public $testimonials_management;
    public $website_settings_management;
    public $view_reservations;
    public $add_reservations;
    public $update_reservations;
    public $logs;

    protected static $tableName = 'privileges';
    protected static $pk = 'id';

    protected $tableSchema = array(
        'user_id',
        'rooms_management',
        'users_management',
        'messages_management',
        'news_management',
        'testimonials_management',
        'website_settings_management',
        'view_reservations',
        'add_reservations',
        'update_reservations',
        'logs'
    );
}