<?php
namespace core;

class SQL_DBWrapper
{

    private $_SQL_DB;

    public function __construct()
    {
        $this->_SQL_DB = SQL_DB::get_instance();
    }

    public  function get_instance()
    {
        return $this->_SQL_DB;
    }

    public function query($sql, $params, $class )
    {
        return $this->_SQL_DB->query($sql, $params, $class);
    }

    public function find($table, $params, $class)
    {
        return $this->_SQL_DB->find($table, $params, $class);
    }

    public function find_first($table, $params, $class)
    {
        return $this->_SQL_DB->find_first($table, $params, $class);
    }

    public function insert($table, $fields)
    {
        return $this->_SQL_DB->insert($table, $fields);
    }

    public function update($table, $id, $fields)
    {
        return $this->_SQL_DB->update($table, $id, $fields);
    }

    public function delete($table, $id)
    {
        return $this->_SQL_DB->delete($table, $id);
    }

    public function results()
    {
        return $this->_SQL_DB->results();
    }

    public function first()
    {
        return $this->_SQL_DB->first();
    }

    public function count()
    {
        return $this->_SQL_DB->count();
    }
    
    public function last_id()
    {
        return $this->_SQL_DB->last_id();
    }
    public function get_columns($table)
    {
        return $this->_SQL_DB->get_columns($table);
    }
    
    public function error()
    {
        return $this->_SQL_DB->error();
    }
}
