<?php
class Controller extends App
{
    protected $_controller, $_action;
    public $view;

    public function __construct($controller, $action)
    {
        parent::__construct();
        $this->_controller = $controller;
        $this->_action = $action;
        $this->view = new View();
    }


    protected function load_model($model)
    {
        if(class_exists($model))
        {
            $this->{strtolower($model)} = new $model(strtolower($model));
        }
    }
}