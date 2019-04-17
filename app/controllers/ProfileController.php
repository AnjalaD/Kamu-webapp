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
        if($this->request->is_post())
        {
            $input = $this->request->get();
            if($this->request->exists('change_pass'))
            {
                if(!password_verify($input->current_password, $user->password))
                {
                    $user->add_error_message('Current password does not match!');
                    return $this->json_response(["task"=>false, "errors"=>FH::display_errors($user->get_error_messages())]);
                }
            }
            
            $user->assign($input);
            if($user->save())
            {
                return $this->json_response(["task"=>true]);
            }
        }
        return $this->json_response(["task"=>false, "errors"=>FH::display_errors($user->get_error_messages())]);
    }

}