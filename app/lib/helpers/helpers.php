<?php

function dnd($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function sanatize($dirty)
{
    return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
}

function current_user()
{
    return UserModel::current_logged_user();
}

function posted_values($post)
{
    $clean_ary = [];
    foreach($post as $key => $value)
    {
        $clean_ary[$key] = sanatize($value);
    }
    return $clean_ary;
}

function current_page()
{ 
    $current_page = $_SERVER['REQUEST_URI'];
    if($current_page == SROOT || $current_page == SROOT . 'home/index')
    {
        $current_page = SROOT . 'home';
    }
    return $current_page;
}