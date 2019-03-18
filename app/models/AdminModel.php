<?php
namespace app\models;
use app\models\UserModel;

class AdminModel extends UserModel
{
    public function __construct($user='')
    {
        $table = 'admins';
        $user_model = 'AdminModel';
        parent::__construct($table, $user_model);

        $this->_soft_del = true;

        if(is_int($user))
        {
            $u = $this->_db->find_first($table,['conditions' => 'id=?', 'bind' => [$user]], 'app\models\AdminModel');
        }else
        {
            $u = $this->_db->find_first($table,['conditions' => 'email=?', 'bind' => [$user]], 'app\models\AdminModel');
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
        return ['Admin'];
    }
} 