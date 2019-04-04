<?php
namespace app\models;

use core\Model;
use core\H;


class ItemTagModel extends Model
{
    public $item_id, $tag_id;

    public function __construct($item_id='', $tag_id='')
    {
        if(!empty($tag_id))
        {
            $this->tag_id = $tag_id;
        }
        if(!empty($item_id))
        {
            $this->item_id = $item_id;
        }
        
        $table = 'tags';
        $model_name = 'TagModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = true;
    }


    public function validator()
    {   

    }
    

    public function save_items_tags($item_id, $tags)
    {
        foreach($tags as $tag)
        {
            $new_item_tag = new ItemTagModel($item_id, $tag->id);
            $new_item_tag->save();
        }
    }


    public function get_item_tags($item_id)
    {

    }

}