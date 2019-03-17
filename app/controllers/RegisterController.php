<?php
namespace app\controllers;
use core\Controller;
use core\Router;
use app\models\CustomerModel;
use app\models\OwnerModel;
use core\H;
use app\models\UserModel;
use app\models\AdminModel;

class RegisterController extends Controller
{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('CustomerModel');
        $this->load_model('OwnerModel');
        $this->load_model('AdminModel');
        $this->view->set_layout('default');
    }


    public function login_action($user_type='')
    {
        $new_user = null;
        $modelname = '';
        if($user_type == 'customer')
        {
            $new_user = new CustomerModel();
            $modelname = 'customermodel';
        }
        elseif($user_type == 'owner')
        {
            $new_user = new OwnerModel();
            $modelname = 'ownermodel';
        }
        $this->login($new_user, $modelname);
    }

    public function login_admin_action()
    {
        $this->login(new AdminModel(), 'adminmodel', 'register/login_admin');
    }


    public function login($new_user, $modelname, $page='register/login')
    {
        if($new_user)
        {
            if($this->request->is_post())
            {
                $this->request->csrf_check();
                $new_user->assign($this->request->get());
                $new_user->login_validator();
                if($new_user->validation_passed())
                {
                    $user = $this->{$modelname}->find_by_email($this->request->get('email'));
                    // H::dnd($user);
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
        }else
        {
            $this->view->display_errors = [];
        }
        $this->view->render($page);
    }


    public function logout_action()
    {
        if(UserModel::current_user())
        {
            UserModel::current_user()->logout();
        }
        Router::redirect('register/login');
    }


    public function register_action($user_type = '')
    {
        if($user_type == 'owner')
        {
            $new_user = new OwnerModel();
        }else
        {
            $new_user = new CustomerModel();
        }
        $this->register($new_user);
    }

    public function register_admin_action()
    {
        $this->register(new AdminModel(), 'register/register_admin', 'home');
    }


    public function register($model, $page='register/register', $redirect='register/login')
    {
        $new_user = $model;
        if($this->request->is_post()) {
            $this->request->csrf_check();
            $new_user->assign($this->request->get());
            $new_user->set_confirm($this->request->get('confirm'));
            // H::dnd($new_user->save());
            if($new_user ->save()) {
                Router::redirect($redirect);
            }
        }
        $this->view->new_user = $new_user;
        $this->view->display_errors = $new_user->get_error_messages();
        $this->view->render($page);
    }

    public function demo_action(){
        // H::dnd($this->request->get());
    }
} 