<?php

namespace Framework\Models;
use Framework\Lib\AbstractModel;

class ReservationsModel extends AbstractModel
{
	public $id;
	public $check_in;
	public $check_out;
	public $period;
	public $guests;
	public $room_id;
	public $room_price;
	public $total;
	public $email;
	public $note;
	public $reservation_status;
	public $payment_status;

	protected static $tableName = 'reservations';
    protected static $pk = 'id';

	protected $tableSchema = array(
		'check_in',
		'check_out',
		'period',
		'guests',
		'room_id',
		'room_price',
		'total',
		'email',
		'note',
		'reservation_status',
		'payment_status'
		);	

}	