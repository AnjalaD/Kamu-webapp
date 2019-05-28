<?php
namespace core\validators;
use core\validators\Validator;

class RegexPatternValidator extends Validator
{
    public function run_validation()
    {
        $value = $this->_model->{$this->field};
        $pass = preg_match($this->rule,$value);
        return $pass;
    }
}