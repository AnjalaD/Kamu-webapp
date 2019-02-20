<?php

class Account extends Controller
{
    public function index()
    {
        $this->view('home');
    }

    //handle login post request
    public function login()
    {
        $user_model = $this->model('UserData');
  
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if (isset($_POST['login']))
            {
                $user_data = $user_model->check_login($_POST['email'], $_POST['password']);
                if($user_data)
                {   
                    @session_start();
                    $_SESSION['email'] = $user_data['email'];
                    $_SESSION['first_name'] = $user_data['first_name'];
                    $_SESSION['last_name'] = $user_data['last_name'];
                    $_SESSION['active'] = $user_data['active'];

                    $_SESSION['logged_in'] = true;

                    $this->view('home');
                    return;
                }else
                {
                    $this->view('login',['login_error'=>"Login failed"]);
                    return;
                }
            }
        }
        $this->view('login');
    }

    //logout account - clear session
    public function logout()
    {
        session_start();
        session_unset();
        $this->view('home');
    }

    //handle signup post request
    public function signup()
    {
        $user_model = $this->model('UserData');

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if (isset($_POST['signup']))
            {
                if($user_model->create_account($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['password'])){
                    $this->view('verifyemail');
                    return;
                }else
                {
                    $this->view('signup');
                }
            }
        }
        $this->view('signup');
    }

    //verify newly created user account
    public function verify($email, $hash)
    {
        $user_model = $this->model('UserData');

        if($user_model->verify($email, $hash))
        {
            $this->view('message', ['success'=>"Your account successfully activated"]);
            return;
        }
        $this->view('message', ['error'=>"Account activation failed"]);
    }

    //forgot password - send reset email
    public function forgot()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user_model = $this->model('UserData');

            if($user_model->forgot($_POST['email']))
            {
                $this->view('message', ['success'=>"Password reset link has been sent to the email"]);
                return;
            }
        }
        $this->view('message', ['error'=>"Invalid email address"]);
    }


    //go to password reset page
    public function reset($email, $hash)
    {
        if (isset($email) && !empty($email) AND isset($hash) && !empty($hash)){
            $user_model = $this->model('UserData');

            if($user_model->reset($email, $hash))
            {
                $this->view('resetpassword');
                return;
            }

        }
        $this->view('message', ['error'=>"Invalid url"]);
    }

    //reset password
    public function reset_password($email)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if ($_POST['password'] == $_POST['confirmpassword'])
            {
            $user_model = $this->model('UserData');

            if($user_model->reset_password($_POST['password']))
                $this->view('message', ['success'=>"Password changed successfully"]);
                return;
            }
        }
        $this->view('message', ['error'=>"Error occured while reseting password"]);
    }

}