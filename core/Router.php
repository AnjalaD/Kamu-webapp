<?php
namespace core;
use core\Session;
use app\models\UserModel;
use core\H;

class Router
{
    public static function route($url)
    {
        //controller
        $controller = (isset($url[0]) && !empty($url[0])) ? ucwords($url[0]) . 'Controller' : DEFAULT_CONTROLLER . 'Controller';
        $controller_name = str_replace('Controller', '', $controller);
        array_shift($url);

        //action
        $action = (isset($url[0]) && !empty($url[0])) ? $url[0] . '_action' : 'index_action';
        $action_name = (isset($url[0]) && !empty($url[0])) ? $url[0] : 'index';
        array_shift($url);

        //params
        $params = $url;

        //acl check
        $grant_access = self::has_access($controller_name, $action_name);
        if (!$grant_access) {
            $controller = ACCESS_RESTRICTED . 'Controller';
            $controller_name = ACCESS_RESTRICTED;
            $action = 'no_permission_action';
        }

        $controller = 'app'.SP.'controllers'.SP. $controller;
        $dispatch = new $controller($controller_name, $action);

        if (!method_exists($controller, $action)) {
            // die('"' . $action_name .'" method does not exist in controller "' . $controller_name . '"');
            $params = $controller_name . $action_name;
            $controller = ACCESS_RESTRICTED . 'Controller';
            $action = 'page_not_found_action';
        }
        call_user_func_array([$dispatch, $action], $params);
    }


    public static function redirect($location)
    {
        if (!headers_sent()) {
            header('location: ' . SROOT . $location);
            exit();
        } else {
            echo '<script type = "text/javascript">';
            echo 'window.location.href="' . SROOT . $location . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
            echo '</noscrip>';
            exit;
        }
    }

    public static function has_access($controller_name, $action_name = "index_action")
    {
        $acl_file = file_get_contents(ROOT.SP.'app'.SP.'acl.json');
        $acl = json_decode($acl_file, true);
        $current_user_acls = ["Guest"];
        $grant_access = false;

        if (Session::exists(CURRENT_USER_SESSION_ID) && Session::exists(CURRENT_USER_SESSION_TYPE)) {
            $current_user_acls[] = "Logged_in";
            $current_user_acls = array_merge($current_user_acls, UserModel::current_user()->acls());
            // H::dnd($current_user_acls);
        }

        foreach ($current_user_acls as $level) {
            if (array_key_exists($level, $acl) && array_key_exists($controller_name, $acl[$level])) {
                if (in_array($action_name, $acl[$level][$controller_name]) || in_array("*", $acl[$level][$controller_name])) {                        $grant_access = true;
                    break;
                }
            }            
        }

        //check for denied
        foreach ($current_user_acls as $level) {
            $denied = $acl[$level]['denied'];
            if (!empty($denied) && array_key_exists($controller_name, $denied) && in_array($action_name, $denied[$controller_name])) {
                $grant_access = false;
                break;
            }
        }

        return $grant_access;
    }

    public static function get_menu($menu)
    {
        $menu_ary = [];
        $menu_file = file_get_contents(ROOT.SP.'app'.SP.$menu.'.json');  
        $acl = json_decode($menu_file, true);

        foreach ($acl as $key => $value) {
            if (is_array($value)) {
                $sub = [];
                foreach ($value as $k => $v) {
                    if ($k == 'separator' && !empty($sub)) {
                        $sub[$k] = '';
                        continue;
                    } else if ($final_val = self::get_link($v)) {
                        $sub[$k] = $final_val;
                    }
                }
                if (!empty($sub)) {
                    $menu_ary[$key] = $sub;
                }
            } else {
                if ($final_val = self::get_link($value)) {
                    $menu_ary[$key] = $final_val;
                }
            }
        }

        return $menu_ary;
    }

    public static function get_link($value)
    {
        //check if external link
        if (preg_match('/https?:\/\//', $value) == 1) {
            return $value;
        } else {
            $ary = explode('/', $value);
            $controller_name = ucwords($ary[0]);
            $action_name = isset($ary[1]) ? $ary[1] : '';
            if (self::has_access($controller_name, $action_name)) {
                return SROOT . $value;
            } else false;
        }
    }
}
