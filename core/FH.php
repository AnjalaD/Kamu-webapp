<?php
namespace core;
use core\Session;

class FH{

    public static function input_block($type, $label, $name, $value='', $input_attrs=[], $div_attrs=[])
    {   
        $div_str = self::stringfy_attrs($div_attrs);
        $input_str = self::stringfy_attrs($input_attrs);
        $html = '<div' . $div_str . '>';
        $html .= '<label for="'. $name .'">'. $label . '</label>';
        $html .= '<input type="'. $type .'" id="'. $name .'" name="'. $name .'" value="'. $value .'"'. $input_str .'/>'; 
        $html .= '</div>';
        return $html;
    }

    public static function submit_tag($button_text, $input_attrs=[]){
        $input_str = self::stringfy_attrs($input_attrs);
        $html = '<input type="submit" value="'.$button_text.'"'.$input_str.' />'; 
        return $html;
    }
    
    
    public static function stringfy_attrs($attrs)
    {
        $string = '';
        foreach($attrs as $key => $value)
        {
            $string .= ' ' . $key . '="' . $value . '"';
        }
        return $string;
    }

    public static function generate_token()
    {
        $token = base64_encode(openssl_random_pseudo_bytes(32));
        Session::set('csrf_token', $token);
        return $token;
    }

    public static function check_token($token)
    {
        return (Session::exists('csrf_token') && Session::get('csrf_token') == $token);
    }

    public static function csrf_input($token =''){
        if($token==''){
            $token = self::generate_token();
        }
        return '<input type="hidden" name="csrf_token" id="csrf_token" value="'.$token.'"/>';
    }
    

    public static function sanatize($dirty)
    {
        return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }

    public static function posted_values($post)
    {
        $clean_ary = [];
        foreach ($post as $key => $value) {
                $clean_ary[$key] = self::sanatize($value);
            }
        return $clean_ary;
    }

    public static function display_errors($errors)
    {
        $html = '<div class="form-errors"><ul>';
        foreach($errors as $field => $error)
        {
            $html .= '<li class="text-danger" >' . $error . '</li>' ;
            $html .= '<script>jQuery("document").ready(function(){jQuery("#' . $field . '").parent().closest("div").addClass("text-danger");}); </script>';
        }
        $html .= '</ul></div>';
        return $html;
    }


}