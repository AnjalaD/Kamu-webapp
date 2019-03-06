<?php

class Session
{
    public static function exists($name)
    {
        return isset($_SESSION[$name]);
    }

    public static function get($name)
    {
        return $_SESSION[$name];
    }


    public static function set($name, $value)
    {
        return $_SESSION[$name] = $value;
    }


    public static function delete($name)
    {
        if(self::exists($name))
        { 
            unset($_SESSION[$name]);
        }
    }


    public static function uagent_no_version()
    {
        $uagent = $_SERVER['HTTP_USER_AGENT'];
        $regx = '/\/[a-zA-Z0-9.]+/';
        $uagent = preg_replace($regx, '', $uagent);
        return $uagent;
    }

}