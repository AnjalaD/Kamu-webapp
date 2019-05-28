<?php
namespace app\models;

use core\Model;
use core\validators\MaxValidator;
use core\validators\RequiredValidator;
use core\validators\NumericValidator;
use core\validators\MaxValueValidator;
use core\validators\MinValueValidator;
use core\validators\RegexPatternValidator;
use core\H;
use app\interfaces\SearchAlgo;

class ItemsModel extends Model implements SearchAlgo
{
    public $restaurant_id, $item_name, $description, $price, $image_url = DEFUALT_ITEM_IMAGE, $rating = 0, $rating_num = 0, $deleted = 0, $hidden = false;

    public function __construct()
    {
        $table = 'items';
        $model_name = 'ItemsModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = true;
    }

    public function find_all_by_restaurant_id($restaurant_id, $params = [])
    {
        $conditions = [
            'conditions' => 'restaurant_id=?',
            'bind' => [$restaurant_id]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);
    }

    public function find_by_id_restaurant_id($item_id, $restaurant_id, $params = [])
    {
        $conditions = [
            'conditions' => 'id=? AND restaurant_id=?',
            'bind' => [$item_id, $restaurant_id]
        ];

        $conditions = array_merge($conditions, $params);
        return $this->find_first($conditions);
    }

    public function validator()
    {
        $this->run_validation(new RequiredValidator($this, ['field' => 'item_name', 'rule' => true, 'msg' => 'Item Name is required!']));
        $this->run_validation(new RequiredValidator($this, ['field' => 'description', 'rule' => true, 'msg' => 'Descripton is required!']));
        $this->run_validation(new RequiredValidator($this, ['field' => 'price', 'rule' => true, 'msg' => 'Price is required!']));

        $this->run_validation(new MaxValidator($this, ['field' => 'item_name', 'rule' => 50, 'msg' => 'Item Name should be maximum of 50 characters!']));
        $this->run_validation(new RegexPatternValidator($this, ['field' => 'item_name', 'rule' =>"/^[a-zA-Z0-9 ]*$/", 'msg' => 'Item Name should only consist of letters numbers and spaces']));
        $this->run_validation(new MaxValidator($this, ['field' => 'description', 'rule' => 255, 'msg' => 'Description should be maximum of 255 characters!']));
        $this->run_validation(new NumericValidator($this, ['field' => 'price', 'rule' => true, 'msg' => 'Price should be numeric!']));
        $this->run_validation(new MaxValueValidator($this, ['field' => 'price', 'rule' => 10000, 'msg' => 'Price should be less than Rs.10,000.00']));
        $this->run_validation(new MinValueValidator($this, ['field' => 'price', 'rule' => 1, 'msg' => 'Price should be at least Rs.1.00']));
    }


    //for search

    public function auto_complete($data)
    {
        $results = [];
        if ($items = $this->search('item_name', $data)) {
            foreach ($items as $item) {
                $results[] = $item->item_name;
            }
        }
        return ($results);
    }

    public function search($field, $data)
    {
        $items = $this->find([
            'conditions' => $field . ' LIKE ? ',
            'bind' => ['%' . $data . '%']
        ]);
        return ($items) ? $items : [];
    }

    public function get_order_items($order, $get_deleted=false)
    {
        $items = [];
        // H::dnd($order);
        foreach($order as $key => $val) {
            $item = $this->find_by_id((int)$key, $get_deleted);
            $item->quantity = $val;
            $items[] = $item;
        }
        return $items;
    }

    public function filter($filters, $page)
    {
        return '';
    }
    
}
