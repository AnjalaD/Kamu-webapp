<?php
namespace app\controllers;
use core\Controller;
use core\Router;
use app\models\CustomerModel;
use app\models\OwnerModel;
use core\H;

class RegisterController extends Controller
{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('CustomerModel');
        $this->load_model('OwnerModel');
        $this->view->set_layout('default');
    }


    public function login_action()
    {
        $this->view->display_errors = [];
        $this->view->render('register/login');
    }

    public function login_user_action()
    {
        $this->login(new CustomerModel(), 'customermodel');
    }

    public function login_owner_action()
    {
        $this->login(new OwnerModel(), 'ownermodel');
    }

    public function login($model, $modelname)
    {   
        $new_user = $model;

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
        $this->view->render('register/login');
    }


    public function logout_action()
    {
        if(CustomerModel::current_user())
        {
            CustomerModel::current_user()->logout();
        }

        if(OwnerModel::current_user()){
            OwnerModel::current_user()->logout();
        }
        Router::redirect('register/login');
    }


    public function register_action()
    {
        $this->register(new CustomerModel());
    }


    public function register_user_action()
    {
        $this->register(new CustomerModel());
    }

    public function register_owner_action()
    {
        $this->register(new OwnerModel());
    }


    public function register($model)
    {
        $new_user = $model;
        if($this->request->is_post())
        {
            $this->request->csrf_check();    
            $new_user->assign($this->request->get());
            $new_user->set_confirm($this->request->get('confirm'));
            // H::dnd($new_user);
            if($new_user->save())
            {
                Router::redirect('register/login');
            }
        }
        $this->view->new_user = $new_user;
        $this->view->display_errors = $new_user->get_error_messages();
        $this->view->render('register/register');
    }

    public function demo_action(){
        // H::dnd($this->request->get());
    }
} 