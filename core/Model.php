<?php

class Model
{
    protected $_db, $_table, $_model_name, $_soft_del = false, $_column_names = [];
    public $id;

    public function __construct($table, $model_name)
    {
        $this->_db = DB::get_instance();
        $this->_table = $table;
        $this->_set_table_columns();
        $this->_model_name = $model_name;
    }

    protected function _set_table_columns()
    {
        $columns = $this->get_columns();
        foreach ($columns as $column) {
            $column_name = $column->Field;
            $this->_column_names[] = $column->Field;
            $this->{$column_name} = null;
        }
    }

    public function get_columns()
    {
        return $this->_db->get_columns($this->_table);
    }

    public function find($params = [])
    {
        $params = $this->_soft_delete_params($params);
        $results = [];
        $results_query = $this->_db->find($this->_table, $params);
        if(!$results_query) return false;
        foreach ($results_query as $result) {
            $obj = new $this->_model_name($this->_table);
            $obj->populate_obj_data($result);
            $results[] = $obj;
        }

        return $results;
    }

    public function find_first($params = [])
    {
        $params = $this->_soft_delete_params($params);
        $results_query = $this->_db->find_first($this->_table, $params);
        $result = new $this->_model_name($this->_table);
        if ($results_query) {
                $result->populate_obj_data($results_query);
            }
        return $result;
    }

    public function find_by_id($id)
    {
        return $this->find_first(['conditions' => "id = ?", 'bind' => $id]);
    }

    public function save()
    {
        $fields = [];
        foreach ($this->_column_names as $column) {
                $fields[$column] = $this->$column;
            }
        //determine where to update or insert
        if (property_exists($this, 'id') && $this->id != '') {
                return $this->update($this->if, $fields);
            } else {
            return $this->insert($fields);
        }
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


    public function query($sql, $bind = [])
    {
        return $this->_db->query($sql, $bind);
    }

    public function data()
    {
        $data = new stdClass();
        foreach ($this->_column_names as $column) {
                $data->column = $column;
            }
        return $data;
    }

    public function assign($params)
    {
        if (!empty($params)) {
                foreach ($params as $key => $value) {
                        if (in_array($key, $this->_column_names)) {
                                $this->$key = sanatize($value);
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
                    $params['conditions'][] = "deleted!=1";
                }else{
                    $params['conditions'] .= "AND deleted!=1";
                }
            }else{
                $params['conditions'] = "deleted !=1";
            }
        }
        return $params;
    }
}
