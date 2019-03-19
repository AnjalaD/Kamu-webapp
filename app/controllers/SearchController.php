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
        $this->load_model('RestaurantModel');
        $this->view->set_layout('default');
    }

    public function index_action()
    {
        // H::dnd($this->request->get());
        if($this->request->is_post())
        {
            if($this->request->exists('food'))
            {
                $this->food($this->request->get('search_string'));
            }elseif($this->request->exists('restaurant'))
            {
                $this->restaurant($this->request->get('search_string'));
            }
        }

    }

    public function food($data='')
    {
        $results = $this->itemsmodel->search('name', $data);
        $this->view->results = $this->itemsmodel->create_list($results);
        $this->view->post_data = $data;
        $this->view->render('search/food');
    }

    public function resturant($data='')
    {

        $this->view->render('search/restaurant');
    }

    public function auto_complete_action($data=[])
    {
        $result =[];
        if(!empty($data))
        {
            $result = $this->itemsmodel->auto_complete('name',$data);
        }
        $this->json_response($result);
    }

}