<?php
namespace core;

class App
{
    public function __construct()
    {
        $this->_set_reporting();
        $this->_unregister_globals();
    }

    private function _set_reporting()
    {
        if(DEBUG) 
        {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        }else
        {
            error_reporting(0);
            ini_set('display_error', 0);
            ini_set('log_errors', 1);
            ini_set('error_log', ROOT .SP.'tmp'.SP.'logs'.SP.'errors.log');
        }
    }

    private function _unregister_globals()
    {
        if(ini_get('register_globals'))
        {
            $global_ary = ['_SESSION', '_COOKIE', '_POST', '_GET', '_REQUEST', '_SERVER', '_ENV', '_FILES'];
            foreach($global_ary as $g)
            {
                foreach($GLOBALS[$g] as $k => $v)
                {
                    if($GLOBALS[$k] == $v)
                    {
                        unset($GLOBALS[$k]);
                    }
                }
            }
        }
    }
}