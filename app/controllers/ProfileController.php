<?php
namespace app\controllers;
use core\Controller;
use core\H;
use app\models\UserModel;
use core\FH;
use core\Router;

class ProfileController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->set_layout('default');
    }

    //view profile page
    public function index_action()
    {
        $user = UserModel::current_user();
        $this->view->user = $user;
        $this->view->render('profile/index');
    }
    

    //handle edit profile ajax request
    public function edit_action()
    {
        $user = UserModel::current_user();
        // H::dnd($this->request->get());
        if($this->request->is_post())
        {
            if($this->request->exists('current_password') && password_verify($this->request->get('current_password'), $user->password) )
            {
                $user->assign($this->request->get());
                if($user->save())
                {
                    return $this->json_response(["task"=>true]);
                }
            }
            else
            {
                $user->add_error_message('current_password', 'Current password does not match');
            }
        }
        return $this->json_response(["task"=>false, "errors"=>FH::display_errors($user->get_error_messages())]);
    }

}