<?php

class Input
{
    public static function sanatize($dirty)
    {
        return htmlentities($dirty, ENT_QUOTES, "UTF-8");
    }


    public static function get($input)
    {
        if(isset($_POST[$input]))
        {
            return self::sanatize($_POST[$input]);
        }else if(isset($_POST[$input]))
        {
            return self::sanatize($_GET[$input]);
        }
    }
}