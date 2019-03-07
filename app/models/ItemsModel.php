<?php

class ItemsModel extends Model
{
    public $id, $user_id, $name, $description, $price, $deleted = 0;

    public function __construct(){
        $table = 'items';
        $model_name = 'ItemsModel';
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
                'display' => 'Name',
                'required' => 'true'
            ],
            'description' =>[
                'display' => 'Description',
                'required' => 'true',
                'max' => 255
            ]
        ];

        return $validation;
    }

    public function find_by_id_user_id($item_id, $user_id, $params=[])
    {
        $conditions = [
            'conditions' => 'id=? AND user_id=?',
            'bind' => [$item_id, $user_id]
        ];

        $conditions = array_merge($conditions, $params);
        return $this->find_first($conditions);
    }

}