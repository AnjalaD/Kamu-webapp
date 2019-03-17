<?php
namespace app\models;
use app\models\UserModel;

class OwnerModel extends UserModel
{
    public function __construct($user='')
    {
        $table = 'owners';
        $user_model = 'OwnerModel';
        parent::__construct($table, $user_model);

        $this->_soft_del = true;

        if(is_int($user))
        {
            $u = $this->_db->find_first($table,['conditions' => 'id=?', 'bind' => [$user]], 'app\models\OwnerModel');
        }else
        {
            $u = $this->_db->find_first($table,['conditions' => 'email=?', 'bind' => [$user]], 'app\models\OwnerModel');
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
        return ['Owner'];
    }
} 