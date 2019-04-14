<?php
namespace app\models;
use core\Model;
use core\H;

class SubmittedOrderModel extends Model
{
    public $customer_id, $items=null, $restaurant_id, $type, $submit_time, $order_code, $accepted=0, $rejected=0, $completed=0, $time_stamp;

    public function __construct()
    {
        $table = 'submitted_orders';
        $model_name = 'SubmittedOrdersModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = false;
    }

    public function find_by_restaurant_id($restaurant_id, $params = [])
    {
        $conditions = [
            'conditions' => 'restaurant_id=?',
            'bind' => [$restaurant_id]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);
    }


    public function find_unaccepted_by_restaurant_id($restaurant_id, $params = [])
    {
        $conditions = [
            'conditions' => 'restaurant_id=? AND accepted=?',
            'bind' => [$restaurant_id,0]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);
    }


    public function find_by_id_customer_id($order_id, $customer_id, $params = [])
    {
        $conditions = [
            'conditions' => 'id=? AND customer_id=?',
            'bind' => [$order_id, $customer_id]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find_first($conditions);
    }

    public function validator()
    {

    }
    
}
