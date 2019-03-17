<?php
namespace app\models;
use app\models\UserModel;

class CustomerModel extends UserModel
{
    public function __construct($user='')
    {
        $table = 'customers';
        $user_model = 'CustomerModel';
        parent::__construct($table, $user_model);

        $this->_soft_del = true;

        if(is_int($user))
        {
            $u = $this->_db->find_first($table,['conditions' => 'id=?', 'bind' => [$user]], 'app\models\CustomerModel');
        }else
        {
            $u = $this->_db->find_first($table,['conditions' => 'email=?', 'bind' => [$user]], 'app\models\CustomerModel');
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
        return ['Customer'];
    }
} 
