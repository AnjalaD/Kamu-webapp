<?php
define('DEBUG', true);

//database detailes
define('DB_NAME', 'accounts');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost:3306');

define('DEFAULT_CONTROLLER', 'Home'); //if no controller is set Route will use this
define('DEFAULT_LAYOUT', 'default'); //if no layout is set controller use this

define('SROOT', '/Kamu/'); //set this for / for a live server

define('SITE_TITLE', 'MVC framwork'); //default web page title
define('BRAND_NAME',"Kamu");

define('CURRENT_USER_SESSION_NAME', 'kwDa23kka3sad7kfa9sS'); //session name for logged user
define('REMEMBER_ME_COOKIE_NAME', 'JasdYADIAassjdakduA');  //cookie name for logged user remember me
define('REMEMBER_ME_COOKIE_EXPIRY', 2592000);  //time in seconds - 30days

define('ACCESS_RESTRICTED','Restricted'); //controller name for restricted redirect

// .htaccess
// Options -MultiViews
// RewriteEngine On

// RewriteCond %{REQUEST_FILENAME} !-d
// RewriteCond %{REQUEST_FILENAME} !-d
// RewriteCond $1 !^(config|core|css|js|fonts)

// RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]


//sql queries for create table
// CREATE TABLE `contacts` (
//     `id` int(11) NOT NULL AUTO_INCREMENT,
//     `user_id` int(11) DEFAULT NULL,
//     `name` varchar(255) DEFAULT NULL,
//     `email` varchar(255) DEFAULT NULL,
//     `address` varchar(255) DEFAULT NULL,
//     `deleted` tinyint(4) NOT NULL DEFAULT '0',
//     PRIMARY KEY (`id`),
//     KEY `user_id` (`user_id`),
//     KEY `deleted` (`deleted`)
//    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;  
// CREATE TABLE `user_sessions` (
//     `id` int(11) NOT NULL AUTO_INCREMENT,
//     `user_id` int(11) NOT NULL,
//     `session` varchar(255) NOT NULL,
//     `agent` varchar(255) NOT NULL,
//     PRIMARY KEY (`id`)
//    ) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
// CREATE TABLE `users` (
//     `id` int(11) NOT NULL AUTO_INCREMENT,
//     `first_name` varchar(50) NOT NULL,
//     `last_name` varchar(50) NOT NULL,
//     `email` varchar(100) NOT NULL,
//     `password` varchar(100) NOT NULL,
//     `hash` varchar(32) NOT NULL,
//     `acl` text,
//     `active` tinyint(1) DEFAULT '0',
//     `deleted` tinyint(1) DEFAULT '0',
//     PRIMARY KEY (`id`)
//    ) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;   