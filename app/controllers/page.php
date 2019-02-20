<?php

class Page extends Controller
{
    public function index()
    {
        $this->view('home');
    }

    public function signUp()
    {
        $this->view('signup');
    }

    public function login()
    {
        $this->view('login');
    }

    public function logout()
    {
        session_start();
        session_destroy();
        $this->view('home');
    }

    public function forgot()
    {
        $this->view('forgot');
    }

    public function resetpassword()
    {
        $this->view('resetpassword');
    }

}