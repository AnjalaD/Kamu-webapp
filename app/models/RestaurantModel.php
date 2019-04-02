<?php
namespace app\models;
use core\Model;
use core\validators\MaxValidator;
use core\validators\RequiredValidator;
use core\validators\NumericValidator;
use core\H;


class RestaurantModel extends Model
{
    public $resturant_name, $address, $telephone, $email, $lng, $lat, $image_url=DEFUALT_RESTAURANT_IMAGE, $deleted = 0;

    public function __construct(){
        $table = 'restaurants';
        $model_name = 'RestaurantModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = true;
    }

    public function find_all($params=[])
    {
        $conditions = [
            'conditions' => '1'
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);

    }

    public function save_image($data)
    {
        $image = H::decode_image($data);
        $path = SROOT.'img/items/'.time().'.png';
        if(file_put_contents($path, $image))
        {
            $this->image_url = $path;
            return $path;
        }
        $this->image_url = DEFUALT_ITEM_IMAGE;
        return false;
    }

    public function auto_complete($field, $data)
    {
        $results = [];
        if($items = $this->search($field, $data))
        {
            foreach($items as $item)
            {
                $results[] = $item->restaurant_name;
            }
        }
        return array_unique($results);
    }

    public function search($field, $data)
    {
        $items = $this->find([
            'conditions' => $field.' LIKE ?',
            'bind' => ['%'.$data.'%']
        ]);
        return ($items)? $items : [];
    }
}