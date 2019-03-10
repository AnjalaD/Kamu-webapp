<?php
namespace app\controllers;
use core\Controller;
use core\Router;
use app\models\UserModel;
use core\H;

class RegisterController extends Controller
{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('UserModel');
        $this->view->set_layout('default');
    }


    public function login_action()
    {   
        $new_user = new UserModel();

        if($this->request->is_post())
        {
            $this->request->csrf_check();
            $new_user->assign($this->request->get());
            $new_user->login_validator();
            if($new_user->validation_passed())
            {
                $user = $this->usermodel->find_by_email($this->request->get('email'));
                if($user && password_verify($this->request->get('password'), $user->password))
                {
                    $remember = (isset($_POST['remember_me']) && $this->request->get('remember_me')) ? true :false;
                    $user->login($remember);
                    Router::redirect('');
                }else
                {
                $new_user->add_error_message('email', 'Email and password does not match');
                }
            }
            
        }
        $this->view->display_errors = $new_user->get_error_messages();
        $this->view->render('register/login');
    }


    public function logout_action()
    {
        if(UserModel::current_user())
        {
            UserModel::current_user()->logout();
        }
        Router::redirect('register/login');
    }


    public function register_action()
    {
        $new_user = new UserModel();
        if($this->request->is_post())
        {
            $this->request->csrf_check();    
            $new_user->assign($this->request->get());
            $new_user->set_confirm($this->request->get('confirm'));
            // H::dnd($this->request->get());
            if($new_user->save())
            {
                Router::redirect('register/login');
            }
        }
        $this->view->new_user = $new_user;
        $this->view->display_errors = $new_user->get_error_messages();
        $this->view->render('register/register');
    }
} 