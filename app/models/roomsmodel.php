<?php

namespace Framework\Models;
use Framework\Lib\AbstractModel;

class RoomsModel extends AbstractModel
{
	public $room_id;
	public $room_number;
	public $room_type; // ('single', 'double', 'suite')
	public $beds;
	public $price;
	public $description;
	public $image;
	public $status; // ('active' => 1, 'inactive' => 0)

	protected static $tableName = 'rooms';
    protected static $pk = 'room_id';

	protected $tableSchema = array(
		'room_number',
		'room_type',
		'beds',
		'price',
		'description',
		'image',
		'status'
		);	

	public static function getRooms($options)
    {
        $sql = "SELECT DISTINCT rooms.*, reservations.check_in, reservations.check_out
                    FROM rooms
                    LEFT JOIN reservations ON rooms.room_id = reservations.room_id
                    $options";
        return parent::getSQL($sql);
    }
}	