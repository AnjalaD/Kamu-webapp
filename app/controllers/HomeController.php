<?php

class HomeController extends Controller
{
    public function __construct($controller, $acttion)
    {
        parent::__construct($controller, $acttion);
    }

    public function index_action()
    {
        $this->view->render('home/index');
    }
}


// $fields = [
//     'first_name' => 'aj',
//     'last_name' => 'di',
//     'email' => 'ad@g.com',
//     'password' => 'sfqw',
//     'hash' => 'hash12312'
// ];

// find('users', [
//     'conditions' => "first_name = ?",
//     'bind' => ['Anjala'],
//     'order' => "last_name, first_name",
//     'limit' => 2
// ]);