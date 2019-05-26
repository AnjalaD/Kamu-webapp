<?php
namespace app\models;

use core\Model;
use core\H;


class ItemTagModel extends Model
{
    public $item_id, $tag_id;

    public function __construct($item_id='', $tag_id='')
    {
        $this->tag_id = $tag_id;
        $this->item_id = $item_id;
        
        $table = 'item_tags';
        $model_name = 'TagModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = false;
    }

    public function get_tags_by_item_id($item_id)
    {   }

    public function validator()
    {   }
    

    public function save_item_tags($item_id, $tags)
    {
        $this->delete_tags($item_id);
        foreach($tags as $tag)
        {
            $new_item_tag = new ItemTagModel($item_id, $tag->id);
            $new_item_tag->save();
        }
    }

    public function delete_tags($item_id)
    {
        $sql = "DELETE FROM {$this->_table} WHERE item_id = ? ;";
        $result = $this->query($sql, [$item_id], get_class($this));
        return $result;
    }


}