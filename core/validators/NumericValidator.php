<?php
namespace core\validators;
use core\validators\Validator;

class NumericValidator extends Validator
{
    public function run_validation()
    {
        $value = $this->_model->{$this->field};
        $pass = is_numeric($value);
        return $pass;
    }
}