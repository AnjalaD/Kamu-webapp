<?php
namespace app\controllers;
use core\Controller;
use core\H;
use app\models\UserModel;
use core\FH;
use core\Router;
use core\Session;

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
            $this->request->csrf_check();
            // H::dnd($this->request->get());
            if($this->request->get('change_pass')=="true")
            {
                $user->set_confirm($this->request->get('confirm'));
                if(!password_verify($this->request->get('current_password'), $user->password))
                {
                    $user->add_error_message('','Current password does not match!');
                    return $this->json_response(["task"=>false, "errors"=>FH::display_errors($user->get_error_messages())]);
                }

            } else {
                $user->set_password_changed(false);
            }
            
            $user->assign($this->request->get());
            if($user->save())
            {
                Session::add_msg('success', 'Changes saved successfully!');
                return $this->json_response(["task"=>true]);
            }
        }

        return $this->json_response(["task"=>false, "errors"=>FH::display_errors($user->get_error_messages())]);
    }

}