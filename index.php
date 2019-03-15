<?php
use core\Session;
use core\Cookie;
use core\Router;
use core\H;
use app\models\UserModel;

define('ROOT', dirname(__FILE__));
define('SP', DIRECTORY_SEPARATOR);

// load configuration and helper functions
require_once(ROOT.SP.'config'.SP.'config.php');

function autoload($class_name)
{
    $class_ary = explode('\\', $class_name);
    $class = array_pop($class_ary);
    $sub_path = implode(SP, $class_ary);
    
    $path = ROOT.SP.$sub_path.SP.$class.'.php';
    if(file_exists($path))
    {
        require_once($path);
    }
}

spl_autoload_register('autoload');
session_start();

if ($_GET['url'] == 'index.php') {
    $url = [];
} else {
    $url = isset($_GET['url']) ? $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : [];
}

if (!Session::exists(CURRENT_USER_SESSION_ID) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
    UserModel::login_from_cookie();
}

//Route the request
Router::route($url);
