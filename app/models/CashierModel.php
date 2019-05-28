<?php
namespace app\models;

use core\H;

class CashierModel extends UserModel
{
    public $restaurant_id=null, $disabled=0;

    public function __construct($user='')
    {
        $table = 'cashiers';
        $user_model = 'CashierModel';
        parent::__construct($table, $user_model);

        $this->_soft_del = true;
        
        if(is_int($user))
        {
            $u = $this->_db->find_first($table,['conditions' => 'id=?', 'bind' => [$user]], 'app\models\CashierModel');
        }else
        {
            $u = $this->_db->find_first($table,['conditions' => 'email=?', 'bind' => [$user]], 'app\models\CashierModel');
        }
        
        if($u)
        {
            foreach($u as $key => $value)
            {
                $this->$key = $value;
            }
        }
    }

    public function acls()
    {
        return ['Cashier'];
    }

    public function find_all_by_restaurant_id($restaurant_id)
    {
        $conditions = [
            'conditions' => 'restaurant_id = ?',
            'bind' => [$restaurant_id]
        ];
        return $this->find($conditions);
    }

    public function find_by_id_restaurant_id($cashier_id, $restaurant_id)
    {
        $conditions = [
            'conditions' => 'id=? AND restaurant_id = ?',
            'bind' => [$cashier_id, $restaurant_id]
        ];
        return $this->find_first($conditions);
    }

    public function toggle_disable()
    {
        $this->set_password_changed(false);
        $this->disabled = !($this->disabled);
        // H::dnd($this);
        return $this->save();
    }
} 