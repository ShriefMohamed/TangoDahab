<?php

namespace Framework\Models;
use Framework\Lib\AbstractModel;

class TestimonialsModel extends AbstractModel
{
	public $id;
	public $name;
	public $position;
	public $review;
	public $image;

	protected static $tableName = 'testimonials';
    protected static $pk = 'id';

	protected $tableSchema = array(
		'name',
		'position',
		'review',
		'image'
		);
}	