<?php

function input_block($type, $label, $name, $value='', $input_attrs=[], $div_attrs=[])
{   
    $div_str = stringfy_attrs($div_attrs);
    $input_str = stringfy_attrs($input_attrs);
    $html = '<div' . $div_str . '>';
    $html .= '<label for="'. $name .'">'. $label . '</label>';
    $html .= '<input type="'. $type .'" id="'. $name .'" name="'. $name .'" value="'. $value .'"'. $input_str .'/>'; 
    $html .= '</div>';
    return $html;
}


function stringfy_attrs($attrs)
{
    $string = '';
    foreach($attrs as $key => $value)
    {
        $string .= ' ' . $key . '="' . $value . '"';
    }
    return $string;
}