<?php
namespace app\models;

use core\Model;
use core\H;


class FoodItemModel extends Model
{
    public $restaurant_id, $item_name, $description, $price, $image_url = DEFUALT_ITEM_IMAGE, $rating = 0, $tags = '', $restaurant_name;

    public function __construct()
    {
        $table = 'items';
        $model_name = 'ItemsModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = true;
    }
    

    // public function find_all_by_restaurant_id($restaurant_id)
    // {
    //     $conditions = [
    //         'special' => 'INNER JOIN restaurants ON items.restaurant_id = restaurants.id',
    //         'conditions' => 'restaurant_id = ?',
    //         'bind' => [$restaurant_id]
    //     ];
    //     return H::dnd($this->find($conditions));
    // }


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
        $conditions = [
            'special' => 'INNER JOIN restaurants ON items.restaurant_id = restaurants.id',
            'conditions' => $field.' LIKE ? ',
            'bind' => ['%'.$data.'%']
        ];
        $items = $this->find($conditions);
        return ($items) ? $items : [];
    }
    
}
