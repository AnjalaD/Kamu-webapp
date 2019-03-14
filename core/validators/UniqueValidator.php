<?php
namespace core\validators;
use core\validators\Validator;

class UniqueValidator extends Validator
{
    public function run_validation()
    {
        $field = (is_array($this->field))? $this->field[0] : $this->field;
        $value = $this->_model->{$field};

        $conditions = ["{$field}=?"];
        $bind = [$value];

        //check updating record
        if(!empty($this->_model->id))
        {
            $conditions[] = "id != ?";
            $bind[] = $this->_model->id;
        }

        //check multiple fields for unique
        if(is_array($this->field))
        {
            array_unshift($this->field);
            foreach($this->field as $adds)
            {
                $conditions[] = "{$adds}=?";
                $bind[] = $this->_model->{$adds};
            }
        }
        $query_params = ['conditions' => $conditions, 'bind'=>$bind];
        $other = $this->_model->find_first($query_params);

        return !$other;
    }
}