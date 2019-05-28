<?php
namespace core\validators;
use core\validators\Validator;

class MinValueValidator extends Validator
{
    public function run_validation()
    {
        $value = $this->_model->{$this->field};
        $pass = (intval($value) >= $this->rule);
        return $pass;
    }
}