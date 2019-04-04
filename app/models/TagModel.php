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
        $this->_soft_del = true;
    }

    public function validator()
    {
       
    }

    public function save_tags($tags)
    {
        $data = json_decode($tags);
        foreach($data as $tag)
        {
            $new_tag = new TagModel($tag);
            $new_tag->save();
        }

        $tag_names = '';
        foreach($tags as $tag)
        {
            $tag_names .= '('.$tag.'), ';
        }
        $tag_names = rtrim($tag_names, ', ');

        $params = [
            'conditions' => 'item_name IN ?',
            'bind' => [$tag_names]
        ];

        return $this->find($params);
        
    }

}