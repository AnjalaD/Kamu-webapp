<?php
namespace app\controllers;
use core\Controller;
use core\H;
use app\models\UserModel;
class ProfileController extends Controller
{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->view->set_layout('default');
    }

    public function index_action()
    {
        $user = UserModel::current_user();
        $this->view->user = $user;
        $this->view->render('profile/index');
    }

}