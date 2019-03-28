<?php
namespace app\controllers;
use core\Controller;
use core\H;

class HomeController extends Controller
{
    public function __construct($controller, $acttion)
    {
        parent::__construct($controller, $acttion);
    }

    //home page
    public function index_action()
    {
        // H::dnd(CustomerModel::current_user()->acls());
        $this->view->render('home/index');
    }


    //test
    public function test_ajax_action()
    {
        $resp = ['succes'=>true, 'data'=>['id'=>2,'name'=>'aw', 'hash'=>'sdq2ew2asda']];
        $this->json_response($resp);
    }
}
