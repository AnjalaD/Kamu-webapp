<?php
namespace app\models;
use core\Model;
use core\validators\MaxValidator;
use core\validators\RequiredValidator;
use core\validators\NumericValidator;


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

    public function find_by_id_user_id($item_id, $user_id, $params=[])
    {
        $conditions = [
            'conditions' => 'id=? AND user_id=?',
            'bind' => [$item_id, $user_id]
        ];

        $conditions = array_merge($conditions, $params);
        return $this->find_first($conditions);
    }

    public function validator()
    {
        $this->run_validation(new RequiredValidator($this, ['field'=>'name', 'rule'=>true, 'msg'=>'Name is required!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'description', 'rule'=>true, 'msg'=>'Name is required!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'price', 'rule'=>true, 'msg'=>'Name is required!']));

        $this->run_validation(new MaxValidator($this, ['field'=>'description', 'rule'=>255, 'msg'=>'Description should be maximum of 255 characters!']));
        $this->run_validation(new NumericValidator($this, ['field'=>'price', 'rule'=>true, 'msg'=>'Price should be numeric!']));
    }

    public function auto_complete($field, $data)
    {
        
    }

}