<?php

namespace Framework\Models;
use Framework\Lib\AbstractModel;

class NewsModel extends AbstractModel
{
    public $post_id;
    public $title;
    public $description;
    public $place;
    public $date;
    public $image;
    public $views;

    protected static $tableName = 'news';
    protected static $pk = 'post_id';

    protected $tableSchema = array(
        'title',
        'description',
        'place',
        'date',
        'image',
        'views'
    );
}