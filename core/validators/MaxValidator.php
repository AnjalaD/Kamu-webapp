<?php
namespace core\validators;
use core\validators\Validator;
use core\H;

class MaxValidator extends Validator
{
    public function run_validation()
    {
        $value = $this->_model->{$this->field};
        $pass = (strlen($value) <= $this->rule);
        return $pass;
    }
}