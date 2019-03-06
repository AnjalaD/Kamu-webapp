<?php

class ContactsModel extends Model
{
    public function __construct(){
        $table = 'contacts';
        $model_name = 'ContactsModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = true;
    }

    public function find_all_by_user_id($user_id, $params=[])
    {
        $conditions = [
            'conditions' => 'user_id=?',
            'bind' => [$user_id]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);

    }

    public static function validation(){
        $validation = [
            'name' =>[
                'dispaly' => 'Name',
                'required' => 'true'
            ],
            'email' =>[
                'dispaly' => 'Email',
                'required' => 'true',
                'valid_email' => 'true'
            ]
        ];

        return $validation;
    }

}