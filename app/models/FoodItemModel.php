<?php
namespace app\models;

use core\Model;
use core\H;


class FoodItemModel extends Model
{
    public $restaurant_id, $item_name, $description, $price, $image_url = DEFUALT_ITEM_IMAGE, $rating = 0, $tags = '', $deleted = 0;
    public $restaurant_name;

    public function __construct()
    {
        $table = 'items';
        $model_name = 'ItemsModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = true;
    }


    public function find_by_id_restaurant_id($item_id, $restaurant_id, $params = [])
    {
        $conditions = [
            'conditions' => 'id=? AND restaurant_id=?',
            
            'bind' => [$item_id, $restaurant_id]
        ];

        $conditions = array_merge($conditions, $params);
        return $this->find_first($conditions, true);
    }

    public function search($field, $data)
    {

        $sql = '
            SELECT I.*, R.restaurant_name,  GROUP_CONCAT(T.tag_name) as tags
            FROM items as I
            INNER JOIN restaurants R ON I.restaurant_id=R.id
            LEFT JOIN item_tags IT ON I.id=IT.item_id
            LEFT JOIN tags T ON IT.tag_id=T.id
            WHERE '.$field.' LIKE ?
            GROUP by I.id';

        $items = $this->query($sql,['%'.$data.'%'], get_class($this));

        if($items)
        {
            foreach($items as $item)
            {
                $item->tags = ($item->tags)? explode(',', $item->tags) : false ;
            }
        }
        // H::dnd($items);
        return ($items) ? $items : [];
    }
    
}
