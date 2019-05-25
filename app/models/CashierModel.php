<?php
namespace app\models;

use core\H;

class CashierModel extends UserModel
{
    public $restaurant_id = null;

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

} 