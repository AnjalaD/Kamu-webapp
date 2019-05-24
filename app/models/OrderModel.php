<?php
namespace app\models;
use core\Model;
use core\H;

class OrderModel extends Model
{
    //$tyoe -> 0=takeaway, 1=dinning
    public $customer_id, $items=null, $restaurant_id, $type, $delivery_time, $order_code, $submitted=0, $time_stamp, $notes;

    public function __construct()
    {
        $table = 'orders';
        $model_name = 'OrdersModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = false;
    }


    public function find_by_customer_id($customer_id, $params = [])
    {
        $conditions = [
            'conditions' => 'customer_id=?',
            'bind' => [$customer_id]
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


    //get saved orders of a customer
    public function get_drafts($customer_id)
    {
        $params = [
            'conditions' => 'customer_id = ? AND submitted = ?',
            'bind' => [$customer_id, 0]
        ];
        $drafts = $this->find($params);
        return $drafts ? $drafts : [];
    }

    //get submitted orders of a customer
    public function get_submitted($customer_id)
    {
        $params = [
            'conditions' => 'customer_id = ? AND submitted = ?',
            'bind' => [$customer_id, 1]
        ];
        $drafts = $this->find($params);
        return $drafts ? $drafts : [];
    }
    
}
