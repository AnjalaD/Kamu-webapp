<?php

abstract class Validator
{
    public $sucess=true, $msg='', $field, $rule;
    protected $_model;

    public function __construct($model, $params)
    {
        $this->_model = $model;
        if(!array_key_exists('field', $params))
        {
            throw new Exception("You must add a field to params");
        }else
        {
            $this->field = (is_array($params['field']))? $params['field'][0] : $params['field'];
        }

        if(!property_exists($model, $this->field))
        {
            throw new Exception("The field must exist in the model");
        }

        if(!array_key_exists('msg', $params))
        {
            throw new Exception("You must add a msg to params");
        }else
        {
            $this->msg = $params['msg'];
        }

        if(!array_key_exists('rule', $params))
        {
            $this->rule = $params['rule'];
        }

        try
        {
            $this->success = $this->run_validation();

        }catch(Exception $e)
        {
            echo "Validation exception on " . get_class() . ": " . $e->getMessage() . "<br>";
        }
    }

    abstract public function run_validation();
}