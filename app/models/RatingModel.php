<?php
namespace app\models;
use core\Model;

class RatingModel extends Model
{
    public $item_id, $customer_id, $rating;

    public function __construct()
    {
        $table = 'ratings';
        $model_name = 'RatingModel';
        parent::__construct($table, $model_name);
    }

    public function find_by_item_id_customer_id($item_id, $customer_id)
    {
        $conditions = [
            'conditions' => 'item_id=? AND customer_id=?',
            'bind' => [$item_id, $customer_id]
        ];
        return $this->find_first($conditions);
    }
}