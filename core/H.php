<?php

class H
{

    public static function current_page()
    {
        $current_page = $_SERVER['REQUEST_URI'];
        if ($current_page == SROOT || $current_page == SROOT . 'home/index') {
                $current_page = SROOT . 'home';
            }
        return $current_page;
    }

    public static function get_obj_properties($obj)
    {
        return get_object_vars($obj);
    }
}

