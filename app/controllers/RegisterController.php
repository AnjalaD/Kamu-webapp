<?php
namespace app\controllers;
use core\Controller;
use core\Router;
use app\models\CustomerModel;
use app\models\OwnerModel;
use app\models\CashierModel;
use core\H;
use app\models\UserModel;
use app\models\AdminModel;
use core\Session;

class RegisterController extends Controller
{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('CustomerModel');
        $this->load_model('OwnerModel');
        $this->load_model('AdminModel');
        $this->load_model('CashierModel');
        $this->view->set_layout('default');
    }

    public function index_action(){
        Router::redirect('');
    }

    //login for customer and owner
    public function login_action()
    {
        $redirect = '';
        $page='register/login';
        $this->login(new CustomerModel(), 'customermodel', $page, $redirect);
    }

    //login for admin
    public function login_admin_action()
    {
        $this->login(new AdminModel(), 'adminmodel', 'register/login_admin');
    }

    public function login_owner_action($user_type='owner')
    {
        if ($user_type == 'owner') {
            $new_user = new OwnerModel();
            $redirect = 'restaurant/my_restaurant';
        }
        elseif ($user_type == 'cashier') {
            $new_user = new CashierModel();
            $redirect = 'order/view_orders';
        }
        
        $this->login($new_user, $user_type.'model', 'register/login_owner', $redirect);

    }


    //base login function
    public function login($new_user, $modelname, $page='register/login', $redirect='')
    {
        if($this->request->is_post() && $this->request->exists('submit'))
        {
            $this->request->csrf_check();
            $new_user->assign($this->request->get());
            $new_user->login_validator();
            if($new_user->validation_passed())
            {
                $user = $this->{$modelname}->find_by_email($this->request->get('email'));
                
                if($user && password_verify($this->request->get('password'), $user->password))
                {
                    $remember = (isset($_POST['remember_me']) && $this->request->get('remember_me')) ? true :false;
                    
                    $user->login($remember);
                    Router::redirect($redirect);
                }else
                {
                    $new_user->add_error_message('email', 'Email and password does not match');
                }
            } 
        }
        $this->view->display_errors = $new_user->get_error_messages();
        
        $this->view->render($page);
    }


    //logout
    public function logout_action()
    {
        $redirect = 'register/login';
        if(UserModel::current_user())
        {
            if(UserModel::current_user() instanceof OwnerModel || UserModel::current_user() instanceof CashierModel){
                $redirect = "register/login_owner";
            }
            UserModel::current_user()->logout();
        }
        Router::redirect($redirect);
    }


    //register for customer and owner
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


    //register for admin
    public function register_admin_action()
    {
        $this->register(new AdminModel(), 'register/register_admin', 'home');
    }

    public function register_cashier_action()
    {
        $this->register_cashier(new CashierModel(), 'register/register_cashier', 'restaurant/cashiers');
    }


    //base register function
    public function register($model, $page='register/register', $redirect='register/login')
    {
        $new_user = $model;
        if ($this->request->is_post() && $this->request->exists('submit')) {
            $this->request->csrf_check();

            $new_user->assign($this->request->get());
            $new_user->set_confirm($this->request->get('confirm'));
            
            // H::dnd($new_user);
            if($new_user ->save()) {
                $new_user->send_verify_email();
                Session::add_msg('success', 'Resgistration successful');
                Router::redirect($redirect);
            }else{
                Session::add_msg('danger', 'Error! Could not register');
            }
        }
        $this->view->new_user = $new_user;
        $this->view->display_errors = $new_user->get_error_messages();
        $this->view->render($page);
    }
    

    //register function for cashier - by owner
    public function register_cashier($model, $page='register/register', $redirect='register/login')
    {
        $new_user = $model;
        if ($this->request->is_post() && $this->request->exists('submit')) {
            $this->request->csrf_check();

            $new_user->assign($this->request->get());
            $new_user->set_confirm($this->request->get('confirm'));
            
            // H::dnd($new_user);
            $new_user->restaurant_id = UserModel::current_user()->restaurant_id;
            if($new_user ->save()) {
                $new_user->send_verify_email();
                Session::add_msg('success', 'Resgistration successful');
                Router::redirect($redirect);
            }else{
                Session::add_msg('danger', 'Error! Could not register');
            }
        }
        $this->view->new_user = $new_user;
        $this->view->display_errors = $new_user->get_error_messages();
        $this->view->render($page);
    }


    //verification for newly created accounts 
    public function verify_action($type, $email, $hash)
    {
        $user = $this->{$type.'model'}->find_by_email($email);
        
        if($user->hash == $hash)
        {
            $user->verified = 1;
            $user->set_password_changed(false);
            if($user->save())
            {
                Session::add_msg('success', 'Your account has successfully verified!');
                Router::redirect('');
            }
        }
        Router::redirect('restricted/link_expired');
    }


    //fogot password ->to enter email form
    public function forgot_action($user_type)
    {
        if($this->request->is_post() && $this->request->exists('email')){
            $email = $this->request->get('email');
            $user = $this->{$user_type.'model'}->find_by_email($email);
            if($user)
            {
                UserModel::send_password_reset_link($user_type, $user);
                Session::add_msg('info', 'Please check your email to reset password!');
                Router::redirect('');
            }
            Session::add_msg('danger', 'Failed! Please re-check the email address and try again.');
        }
        $this->view->post_action = SROOT . 'register/forgot/' . $user_type;
        $this->view->render('register/send_reset_link');
    }


    //change password through url
    public function reset_password_action($type, $email, $hash)
    {
        $user = $this->{$type.'model'}->find_by_email($email);
        if($user->hash == $hash)
        {
            if($this->request->is_post())
            {
                $user->assign($this->request->get());
                $user->set_confirm($this->request->get('confirm'));
                if($user->save())
                {
                    Session::add_msg('success', 'Your password has successfully changed!');
                    Router::redirect('');
                }
            }
            $this->view->post_action = SROOT . 'register/forgot/' . $type . '/' . $email . '/' . $hash;
            $this->view->render('register/reset_password');
            return;
        }
        Router::redirect('restricted/link_expired');
    }


    //send verification email - in profile page
    public function send_verify_email_action()
    {
        $user = UserModel::current_user();
        if($user->verified == 1){
            Session::add_msg('info', 'Your account has already verified!');
            Router::redirect('');
        }
        $user->send_verify_email();
        Session::add_msg('info', 'Please follow the link send to your email!');
        Router::redirect('');
    }
} 