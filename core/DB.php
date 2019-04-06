<?php
namespace core;
use \PDO;
use \PDOException;

class DB
{
    private static $_instance = null;
    private $_pdo, $_query, $_error = false, $_result, $_count = 0, $_last_insert_id = null;

    public function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, []);
        } catch (PDOExecption $e) {
            die($e->getMessage());
        }
    }


    public static function get_instance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    public function query($sql, $params = [], $class=false)
    {
        // H::dnd($sql);
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                if($class)
                {
                    $this->_result = $this->_query->fetchALL(PDO::FETCH_CLASS, $class);
                }else
                {
                    $this->_result = $this->_query->fetchALL(PDO::FETCH_OBJ);
                }
                $this->_count = $this->_query->rowCount();
                $this->_last_insert_id = $this->_pdo->lastInsertID();
            } else {
                $this->_error = true;
            }

            return $this;;
        }
    }


    protected function _read($table, $params = [], $class)
    {
        $condition_string = '';
        $special = '';
        $columns = '*';
        $bind = [];
        $order = '';
        $limit = '';

        if (isset($params['conditions'])) {
            if (is_array($params['conditions'])) {
                foreach ($params['conditions'] as $condition) {
                    $condition_string .= ' ' . $condition . ' AND';
                }
                $condition_string = trim($condition_string);
                $condition_string = rtrim($condition_string, 'AND');
            } else {
                $condition_string = $params['conditions'];
            }
            if (!empty($condition_string)) {
                $condition_string = ' WHERE ' . $condition_string;
            }
        }

        if (array_key_exists('special', $params)) {
            $special = ' '.$params['special'];
        }

        if (array_key_exists('columns', $params)) {
            $columns = '';
            foreach($params['columns'] as $t => $c)
            {
                foreach($c as $column)
                {
                    $columns .= $t.'.'.$column.', ';
                }
            }
            $columns = rtrim($columns, ', ');
        }

        if (array_key_exists('bind', $params)) {
            $bind = $params['bind'];
        }

        if (array_key_exists('order', $params)) {
            $order = ' ORDER BY ' . $params['order'];
        }

        if (array_key_exists('limit', $params)) {
            $limit = ' LIMIT ' . $params['limit'];
        }

        $sql = "SELECT {$columns} FROM {$table}{$special}{$condition_string}{$order}{$limit}";
        if ($this->query($sql, $bind, $class)) {
            if (!empty($this->_result) && !count($this->_result)) return false;
            return true;
        }
        return false;
    }

    public function find($table, $params = [], $class=flase)
    {
        if ($this->_read($table, $params, $class)) {
            return $this->results();
        }
        return false;
    }



    public function find_first($table, $params = [], $class=false)
    {
        if ($this->_read($table, $params, $class)) {
            return $this->first();
        }
        return false;
    }


    public function insert($table, $fields = [])
    {
        $field_string = '';
        $value_string = '';
        $values = [];

        foreach ($fields as $field => $value) {
            $field_string .= $field . ',';
            $value_string .= '?,';
            $values[] = $value;
        }
        $field_string = rtrim($field_string, ',');
        $value_string = rtrim($value_string, ',');

        $sql = "INSERT INTO {$table} ({$field_string}) VALUES ({$value_string})";
        if (!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;
    }


    public function update($table, $id, $fields = [])
    {
        $field_string = '';
        $values = [];

        foreach ($fields as $field => $value) {
            $field_string .= ' ' . $field . '=?,';
            $values[] = $value;
        }
        $field_string = trim($field_string);
        $field_string = rtrim($field_string, ',');

        $sql = "UPDATE {$table} SET {$field_string} WHERE id = {$id}";
        if (!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = {$id}";
        if (!$this->query($sql)->error()) {
            return true;
        }
        return false;
    }


    public function results()
    {
        return $this->_result;
    }


    public function first()
    {
        return (!empty($this->_result) ? $this->_result[0] : []);
    }


    public function count()
    {
        return $this->_count;
    }

    public function last_id()
    {
        return $this->_last_insert_id;
    }

    public function get_columns($table)
    {
        return $this->query("SHOW COLUMNS FROM {$table}")->results();
    }

    public function error()
    {
        return $this->_error;
    }
}
