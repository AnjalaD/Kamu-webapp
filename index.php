<?php
define('ROOT', dirname(__FILE__));

// load configuration and helper functions
require_once(ROOT . '/config/config.php');

//autoload classes
function autoload($class_name)
{
    if (file_exists(ROOT . '/core/' . $class_name . '.php')) {
        require_once(ROOT . '/core/' . $class_name . '.php');
    } elseif (file_exists(ROOT . '/app/controllers/' . $class_name . '.php')) {
        require_once(ROOT . '/app/controllers/' . $class_name . '.php');
    } elseif (file_exists(ROOT . '/app/models/' . $class_name . '.php')) {
        require_once(ROOT . '/app/models/' . $class_name . '.php');
    } elseif (file_exists(ROOT . '/app/custom_validators/' . $class_name . '.php')) {
        require_once(file_exists(ROOT . '/app/custom_validators/' . $class_name . '.php'));
    } elseif (file_exists(ROOT . '/core/validators/' . $class_name . '.php')) {
        require_once(file_exists(ROOT . '/core/validators/' . $class_name . '.php'));
    }
}
spl_autoload_register('autoload');
session_start();

if ($_GET['url'] == 'index.php') {
    $url = [];
} else {
    $url = isset($_GET['url']) ? $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : [];
}

if (!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
    UserModel::login_from_cookie();
}

//Route the request
Router::route($url);
