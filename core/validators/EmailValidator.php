<?php
namespace core\validators;
use core\validators\Validator;

class EmailValidator extends Validator
{
    public function run_validation()
    {
        $value = $this->_model->{$this->field};
        $pass = filter_var($value, FILTER_VALIDATE_EMAIL);
        return $pass;
    }
}