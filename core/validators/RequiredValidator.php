<?php
namespace core\validators;
use core\validators\Validator;

class RequiredValidator extends Validator
{
    public function run_validation()
    {
        $value = $this->_model->{$this->field};
        $pass = !empty($value);
        return $pass;
    }
}