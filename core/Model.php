<?php
namespace core;
use core\H;

class Model
{
    protected $_db, $_table, $_model_name, $_soft_del = false, $_validates=true, $_validation_errors=[];
    public $id;

    public function __construct($table, $model_name)
    {
        $this->_db = DB::get_instance();
        $this->_table = $table;
        $this->_model_name = $model_name;
    }


    public function get_columns()
    {
        return $this->_db->get_columns($this->_table);
    }

    public function find($params = [], $get_deleted=false)
    {
        $params = $get_deleted? $params : $this->_soft_delete_params($params);
        $results_query = $this->_db->find($this->_table, $params, get_class($this));
        if(!$results_query) return [];
        return $results_query;
    }

    public function find_first($params = [], $get_deleted=false)
    {
        $params = $get_deleted? $params : $this->_soft_delete_params($params);
        $results_query = $this->_db->find_first($this->_table, $params, get_class($this));
        return $results_query;
    }

    public function find_by_id($id)
    {
        return $this->find_first([
            'conditions' => "id = ?",
            'bind' => [$id]
            ]);
    }

    public function save()
    {
        $this->validator();
        
        if($this->_validates)
        {
            $this->before_save();
            $fields = H::get_obj_properties($this);
            //determine where to update or insert
            if (property_exists($this, 'id') && $this->id != '') {
                $save = $this->update($this->id, $fields);
                $this->after_save();
                return $save;
            } else 
            {
                // H::dnd($fields);
                $save = $this->insert($fields);
                $this->after_save();
                return $save;
            }
        }
        return false;
        
    }

    public function insert($fields)
    {
        if (empty($fields)) return false;
        return $this->_db->insert($this->_table, $fields);
    }
    
    public function update($id, $fields)
    {
        if (empty($fields) || $id == '') return false;
        return $this->_db->update($this->_table, $id, $fields);
    }


    public function delete($id = '')
    {
        if ($id == '' && $this->id == ' ') return false;
        $id = ($id == '') ? $this->id : $id;
        if ($this->_soft_del) {
            return $this->update($id, ['deleted' => 1]);
        }
        return $this->_db->delete($this->_table, $id);
    }


    public function query($sql, $bind = [], $class=false)
    {
        $this->_db->query($sql, $bind, $class);
        return $this->_db->error()? false : $this->_db->results();
    }

    public function data()
    {
        $data = new stdClass();
        foreach (H::get_obj_properties($this) as $column => $value) {
                $data->column = $value;
            }
        return $data;
    }

    public function assign($params)
    {
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = FH::sanatize($value);
                }
            }
            return true;
        }
        return false;
    }

    public function populate_obj_data($result)
    {
        foreach ($result as $key => $value) {
            $this->$key = $value;
        }
    }

    protected function _soft_delete_params($params)
    { 
        if($this->_soft_del){
            if(array_key_exists('conditions', $params)){
                if(is_array($params['conditions'])){
                    $params['conditions'][] = $this->_table.".deleted!=1";
                }else{
                    $params['conditions'] .= " AND ".$this->_table.".deleted!=1";
                }
            }else{
                $params['conditions'] = "deleted !=1";
            }
        }
        return $params;
    }

    public function validator()
    {}

    public function run_validation($validator)
    {
        $key = $validator->field;
        if(!$validator->success)
        {
            $this->_validates = false;
            $this->_validation_errors[$key] = $validator->msg;
        }
    }

    public function get_error_messages()
    {
        return $this->_validation_errors;
    }

    public function validation_passed()
    {
        return $this->_validates;
    }

    public function add_error_message($field, $msg)
    {
        $this->_validates = false;
        $this->_validation_errors[$field] = $msg;
    }

    public function before_save(){}

    public function after_save(){}
    
    public function is_new()
    {
        return (property_exists($this, 'id') && !empty($this->id))? false : true;
    }

    public function last_inserted_id()
    {
        return $this->_db->last_id();
    }
}