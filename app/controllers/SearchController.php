<?php
namespace app\controllers;
use core\Controller;
use core\Router;
use app\models\ItemModel;
use core\H;

class SearchController extends Controller
{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('ItemsModel');
        $this->view->set_layout('default');
    }

    public function index_action()
    {

    }

    public function food_action($data=[])
    {
        $this->view->render('search/food');
    }

    public function resturant_action($data=[])
    {
        $this->view->render('search/resturant');
    }

}