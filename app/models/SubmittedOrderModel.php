<?php
namespace app\models;
use core\Model;
use core\H;

class SubmittedOrderModel extends Model
{
    public $customer_id, $items=null, $restaurant_id, $type, $delivery_time, $order_code, $accepted=0, $rejected=0, $completed=0,$notes, $time_stamp;

    public function __construct()
    {
        $table = 'submitted_orders';
        $model_name = 'SubmittedOrderModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = false;
    }

    public function find_by_restaurant_id($restaurant_id, $params = [])
    {
        $conditions = [
            'conditions' => 'restaurant_id=?',
            'bind' => [$restaurant_id]
        ];
        return $this->find($conditions);
    }

    public function find_by_id_restaurant_id($order_id, $restaurant_id, $params = [])
    {
        $conditions = [
            'conditions' => 'id=? AND restaurant_id=?',
            'bind' => [$order_id, $restaurant_id]
        ];
        return $this->find_first($conditions);
    }


    public function find_accepted_by_restaurant_id($restaurant_id, $params = [])
    {
        $conditions = [
            'conditions' => 'restaurant_id=? AND accepted=?',
            'bind' => [$restaurant_id, 1]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);
    }

    public function find_pending_by_restaurant_id($restaurant_id, $params = [])
    {
        $conditions = [
            'conditions' => 'restaurant_id=? AND accepted=? AND rejected=?',
            'bind' => [$restaurant_id, 0, 0]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);
    }

    public function find_all_pending_by_id_customer_id($customer_id)
    {
        $conditions = [
            'conditions' => 'customer_id=? AND completed=?',
            'bind' => [$customer_id, 0]
        ];
        $conditions = array_merge($conditions);
        return $this->find($conditions);
    }


    public function find_rejected_by_restaurant_id($restaurant_id, $params = [])
    {
        $conditions = [
            'conditions' => 'restaurant_id=? AND rejected=?',
            'bind' => [$restaurant_id, 1]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);
    }


    public function find_by_id_customer_id($order_id, $customer_id)
    {
        $conditions = [
            'conditions' => 'id=? AND customer_id=?',
            'bind' => [$order_id, $customer_id]
        ];
        $conditions = array_merge($conditions);
        
        return $this->find_first($conditions);
    }

    public function validator()
    {

    }
    
}
