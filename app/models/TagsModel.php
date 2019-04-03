<?php
namespace app\models;

use core\Model;
use core\H;


class TagsModel extends Model
{
    public $tag_name;

    public function __construct()
    {
        $table = 'items';
        $model_name = 'ItemsModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = true;
    }

    public function validator()
    {
       
    }

    public function add_tags($tags)
    {
        $tags = json_decode($tags);
    }



}