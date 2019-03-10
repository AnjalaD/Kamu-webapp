<?php
namespace app\controllers;
use core\Controller;
use core\H;
use app\models\UserModel;

class HomeController extends Controller
{
    public function __construct($controller, $acttion)
    {
        parent::__construct($controller, $acttion);
    }

    public function index_action()
    {
        // H::dnd(UserModel::current_user()->acls());
        $this->view->render('home/index');
    }

    public function test_ajax_action()
    {
        $resp = ['succes'=>true, 'data'=>['id'=>2,'name'=>'aw', 'hash'=>'sdq2ew2asda']];
        $this->json_response($resp);
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