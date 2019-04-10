<?php
namespace app\models;

use core\Model;
use core\H;


class TagModel extends Model
{
    public $tag_name;

    public function __construct($tag_name='')
    {
        if(!empty($tag_name))
        {
            $this->tag_name = $tag_name;
        }
        $table = 'tags';
        $model_name = 'TagModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = false;
    }

    public function validator()
    {
       
    }

    public function save_tags($tags)
    {
        foreach($tags as $tag)
        {
            $new_tag = new TagModel($tag);
            $new_tag->save();
        }

        $tag_names = '("'.implode('","', $tags).'")';

        $params = [
            'conditions' => 'tag_name IN '.$tag_names,
        ];

        return $this->find($params);
        
    }

}