<?php

class RestrictedController extends Controller
{
    public function __construct($controller, $acttion)
    {
        parent::__construct($controller, $acttion);
    }

    public function index_action()
    {
        $this->view->render('restricted/index');
    }
}