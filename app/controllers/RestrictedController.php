<?php
namespace app\controllers;
use core\Controller;

class RestrictedController extends Controller
{
    public function __construct($controller, $acttion)
    {
        parent::__construct($controller, $acttion);
    }

    public function no_permission_action()
    {
        $this->view->render('restricted/no_permission');
    }

    public function error_action()
    {
        $this->view->render('restricted/error');
    }

    public function invalid_token_action()
    {
        $this->view->render('restricted/invalid_token');
    }

    public function link_expired_action()
    {
        $this->view->render('restricted/link_expired');
    }

    public function page_not_found_action($info)
    {
        $this->view->info = $info;
        $this->view->render('restricted/page_not_found');
    }
}