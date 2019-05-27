<?php
namespace core;

interface DBWrapper{
    public static function get_instance();
    public function query($sql, $params = [], $class=false);
    public function find($table, $params = [], $class=flase);
    public function find_first($table, $params = [], $class=false);
    public function insert($table, $fields = []);
    public function update($table, $id, $fields = []);
    public function delete($table, $id);
    public function results();
    public function first();
    public function count();
    public function last_id();
    public function get_columns($table);
    public function error();

}