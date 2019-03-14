<?php
namespace core;
use core\App;

class Controller extends App
{
    protected $_controller, $_action;
    public $view, $request;

    public function __construct($controller, $action)
    {
        parent::__construct();
        $this->_controller = $controller;
        $this->_action = $action;
        $this->request = new Input();
        $this->view = new View();
    }


    protected function load_model($model)
    {
        $model_path = 'app\models\\' . $model;
        if(class_exists($model_path))
        {
            $this->{strtolower($model)} = new $model_path();
        }
    }

    public function json_response($resp)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=UTF-8");
        http_response_code(200);
        echo json_encode($resp);
        exit;
    }
}