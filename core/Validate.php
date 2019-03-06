<?php

class Validate
{
    private $_passed=false, $_errors=[], $_db=null;

    public function __construct()
    {
        $this->_db = DB::get_instance();
    }

    public function check($source, $items=[])
    {
        $this->_errors = [];
        foreach($items as $item => $rules)
        {
            $item = Input::sanatize($item);
            $display = $rules['display'];
            foreach($rules as $rule => $rule_value)
            {
                $value = Input::sanatize(trim($source[$item]));

                if($rule === 'required' && empty($value))
                {
                    $this->add_error(["{$display} is required!", $item]);
                }else if(!empty($value))
                {
                    switch($rule)
                    {
                        case 'min':
                            if(strlen($value) < $rule_value)
                            {
                                $this->add_error(["{$display} must be minimum of {$rule_value} characters.", $item]);
                            }break;

                        case 'max':
                            if(strlen($value) > $rule_value)
                            {
                                $this->add_error(["{$display} must be maximum of {$rule_value} characters.", $item]);
                            }break;

                        case 'match':
                            if($value != $source[$rule_value])
                            {
                                $match_display = $items[$rule_value]['display'];
                                $this->add_error(["{$match_display} and {$display} must match.", $item]);
                            }break;

                        case 'unique':
                            $check = $this->_db->query("SELECT {$item} FROM {$rule_value} WHERE {$item} = ?", [$value]);
                            if($check->count())
                            {
                                $this->add_error(["{$display} already exsits. Please choose another {$display}.", $item]);
                            }break;

                        case 'unique_update':
                            $t = explode(',', $rule_value);
                            $table = $t[0];
                            $id = $t[1];
                            $query = $this->_db->query("SELECT * FROM {$table} WHERE id != ? AND {$item} = ?", [$id, $value]);
                            if($query->count())
                            {
                                $this->add_error(["{$display} already exsits. Please choose another {$display}.", $item]);
                            }break;

                        case 'is_numeric':
                            if(!is_numeric($value))
                            {
                                $this->add_error(["{$display} has to be a number. Please use a numeric value.", $item]);
                            }break;

                        case 'valid_email':
                            if(!filter_var($value, FILTER_VALIDATE_EMAIL))
                            {
                                $this->add_error(["{$display} must be a valid email address.", $item]);
                            }
                    }
                }
            }
        }

        if(empty($this->_errors))
        {
            $this->_passed = true;
        }
    }

    public function add_error($error)
    {
        $this->_errors[] = $error;
        if(empty($this->_errors))
        {
            $this->_passed = true;
        }else
        {
            $this->_passed = false;
        }
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }

    public function display_errors()
    {
        $html = '<ul>';
        foreach($this->_errors as $error)
        {
            if(is_array($error))
            {
                $html .= '<li class="text-danger" >' . $error[0] . '</li>' ;
                $html .= '<script>jQuery("document").ready(function(){jQuery("#' . $error[1] . '").parent().closest("div").addClass("text-danger");}); </script>';
            }else
            {
                $html .= '<li class="text-danger" >' . $error . '</li>' ;
            }
        }
        $html .= '</ul>';
        return $html;
    }

} 