<?php

namespace Framework\Models;
use Framework\Lib\AbstractModel;

class InvoicesModel extends AbstractModel
{
	public $invoice_id;
	public $reservation_id;
	public $total_amount;
	public $amount_paid;
	public $amount_paid_egp;
	public $amount_due;
	public $payment_method;
	public $invoiced;
	public $last_updated;

	protected static $tableName = 'invoices';
    protected static $pk = 'invoice_id';

	protected $tableSchema = array(
		'reservation_id',
		'total_amount',
		'amount_paid',
		'amount_paid_egp',
		'amount_due',
		'payment_method',
		'invoiced',
		'last_updated'
		);

	public static function getCheckOut($id)
	{
		$sql = "SELECT invoices.*, reservations.*, rooms.room_number
				FROM invoices
				LEFT JOIN reservations ON invoices.reservation_id = reservations.id
				LEFT JOIN rooms ON reservations.room_id = rooms.room_id
				WHERE invoices.reservation_id = '$id'";
		return parent::getSQL($sql, true);
	}

    public static function getReservations($option = '')
    {
        $sql = "SELECT invoices.*, reservations.*, rooms.room_number, 
                  users.user_id, users.fullname, users.username, users.phone, users.governorate, users.email AS user_email 
				FROM invoices
				LEFT JOIN reservations ON invoices.reservation_id = reservations.id
				LEFT JOIN rooms ON reservations.room_id = rooms.room_id
				LEFT JOIN users ON reservations.email = users.email
				$option ";
        return parent::getSQL($sql);
    }
}	