<?php
define('DEBUG', true);

//database detailes
define('DB_NAME', 'accounts');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost:3306');

define('DEFAULT_CONTROLLER', 'Home'); //if no controller is set Route will use this
define('DEFAULT_LAYOUT', 'default'); //if no layout is set controller use this

define('SROOT', '/mvc/'); //set this for / for a live server

define('SITE_TITLE', 'MVC framwork'); //default web page title
define('BRAND_NAME',"Kamu");

define('CURRENT_USER_SESSION_NAME', 'kwDa23kka3sad7kfa9sS'); //session name for logged user
define('REMEMBER_ME_COOKIE_NAME', 'JasdYADIAassjdakduA');  //cookie name for logged user remember me
define('REMEMBER_ME_COOKIE_EXPIRY', 2592000);  //time in seconds - 30days

define('ACCESS_RESTRICTED','Restricted'); //controller name for restricted redirect

// Options -MultiViews
// RewriteEngine On

// RewriteCond %{REQUEST_FILENAME} !-d
// RewriteCond %{REQUEST_FILENAME} !-d
// RewriteCond $1 !^(config|core|css|js|fonts)

// RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]