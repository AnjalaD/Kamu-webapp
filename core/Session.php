<?php
namespace core;

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

    
    public static function add_msg($type, $msg)
    {
        $session_name = 'alert-' . $type;
        self::set($session_name, $msg);
    }

    public static function display_msgs()
    {
        $alerts = ['alert-info', 'alert-success', 'alert-warning', 'alert-danger'];
        $html = '';
        foreach($alerts as $alert)
        {
            if(self::exists($alert))
            {
                $html .= '<div class="alert ' . $alert . ' alert-dismissible fade show" role="alert" style="width:100%;">';
                $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                $html .= self::get($alert);
                $html .= '</div>';
                self::delete($alert);
            }

        }

        return $html;
    }

}