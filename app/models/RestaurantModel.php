<?php
namespace app\models;
use core\Model;
use core\validators\MaxValidator;
use core\validators\RequiredValidator;
use core\validators\NumericValidator;
use core\H;


class RestaurantModel extends Model
{
    public $name, $address, $telephone, $email, $password, $lng, $lat, $image_url, $deleted = 0;

    public function __construct(){
        $table = 'restaurants';
        $model_name = 'RestaurantModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = true;
    }

    public function find_all($params=[])
    {
        $conditions = [
            'conditions' => ''
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);

    }

    // public function find_by_id_restaurant_id($item_id, $restaurant_id, $params=[])
    // {
    //     $conditions = [
    //         'conditions' => 'id=? AND restaurant_id=?',
    //         'bind' => [$item_id, $restaurant_id]
    //     ];

    //     $conditions = array_merge($conditions, $params);
    //     return $this->find_first($conditions);
    // }

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

}