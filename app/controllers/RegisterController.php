<?php

class RegisterController extends Controller
{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('UserModel');
        $this->view->set_layout('default');
    }


    public function login_action()
    {   
        $validation = new Validate();

        if($_POST)
        {
            $validation->check($_POST, [
                'email' => [
                    'display' => 'Email',
                    'valid_email' => true,
                    'required' => true
                ],
                'password' => [
                    'display' => 'Password',
                    'required' => true
                ]
                ], true);
            if($validation->passed())
            {
                $user = $this->usermodel->find_by_email($_POST['email']);
                if($user && password_verify(Input::get('password'), $user->password))
                {
                    // $this->usermodel->id = $user->id;
                    $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true :false;
                    $user->login($remember);
                    Router::redirect('');
                }else
                {
                    $validation->add_error("Your email and password dose not match");
                }
            }
        }
        $this->view->display_errors = $validation->display_errors();
        $this->view->render('register/login');
    }


    public function logout_action()
    {
        if(current_user())
        {
            current_user()->logout();
        }
        Router::redirect('register/login');
    }


    public function register_action()
    {
        $validation = new Validate();
        $posted_values = ['first_name'=>'', 'last_name'=>'', 'email'=>'', 'password'=>'', 'confirm'=>''];
        if($_POST)
        {     
            $posted_values = posted_values($_POST);   
            $validation->check($_POST,[
                'first_name'=>[
                    'display' => 'First Name',
                    'required' => true
                ],
                'last_name'=>[
                    'display' => 'Last Name',
                    'required' => true
                ],
                'email' => [
                    'display' => 'Email',
                    'required' => true,
                    'unique' => 'users',
                    'valid_email' => true
                ],
                'password' => [
                    'display' => 'Password',
                    'required' => true
                ],
                'confirm' => [
                    'display' => 'Confirm Password',
                    'required' => true,
                    'match' => 'password'
                ]
                ], true);
        }

        if($validation->passed())
        {
            $new_user = new UserModel();
            $new_user->register_new_user($_POST);
            Router::redirect('register/login');
        }
        $this->view->post = $posted_values;
        $this->view->display_errors = $validation->display_errors();
        $this->view->render('register/register');
    }
} 