<?php

namespace Framework\Models;
use Framework\Lib\AbstractModel;

class Manage_websiteModel extends AbstractModel
{
	public $setting;
	public $content;
	public $image;

	protected static $tableName = 'manage_website';
    protected static $pk = 'setting';

	protected $tableSchema = array(
		'setting',
		'content',
		'image'
		);
}	