<?php
namespace core\validators;
use core\validators\Validator;

class MatchValidator extends Validator
{
    public function run_validation()
    {
        $value = $this->_model->{$this->field};
        $pass = ($value == $this->rule);
        return $pass;
    }
}