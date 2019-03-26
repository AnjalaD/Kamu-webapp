<?php
define('DEBUG', true);

//database detailes
define('DB_NAME', 'kamudb');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost:3306');

define('DEFAULT_CONTROLLER', 'Home'); //if no controller is set Route will use this
define('DEFAULT_LAYOUT', 'default'); //if no layout is set controller use this

define('SROOT', '/Kamu_1.0/exported/'); //set this for / for a live server
// define('SROOT', '/mvc/');
// define('SROOT', '/mvc/'); //set this for / for a live server
define('WEB_ADDRESS', 'https://localhost/Kamu_1.0/exported/');
// define('WEB_ADDRESS', 'https://localhost/mvc/');
define('SITE_TITLE', 'MVC framwork'); //default web page title
define('BRAND_NAME','Kamu');

define('CURRENT_USER_SESSION_ID', 'kwDa23kka3sad7kfa9sS'); //session name for logged user
define('CURRENT_USER_SESSION_TYPE', 'kwsd23zla3sadrtfa2sS'); //session name for logged user type
define('REMEMBER_ME_COOKIE_NAME', 'JasdYADIAassjdakduA');  //cookie name for logged user remember me
define('REMEMBER_ME_COOKIE_EXPIRY', 2592000);  //time in seconds - 30days

define('ACCESS_RESTRICTED','Restricted'); //controller name for restricted redirect

define('DEFUALT_ITEM_IMAGE', SROOT.'img/items/default.png'); //default image_url for item
define('DEFUALT_RESTAURANT_IMAGE', SROOT.'img/restaurant/default.png'); //default image_url for restaurant 