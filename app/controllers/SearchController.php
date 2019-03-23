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
                $this->food_action();
            }elseif($this->request->exists('restaurant'))
            {
                $this->restaurant_action();
            }
        }

    }

    public function food_action()
    {   
        $data = $this->request->exists('search_string')? $this->request->get('search_string') : '';
        $results = $this->itemsmodel->search('name', $data);
        $this->view->results = H::create_card_list($results);
        $this->view->post_data = $data;
        $this->view->render('search/food');
    }
    

    public function restaurant_action()
    {
        $this->view->render('search/restaurant');
    }

    public function auto_complete_action($data=[])
    {
        $result =[];
        if(!empty($data))
        {
            $type = $this->request->get('type');
            if(!$type)
            {
                $result = array_merge($this->itemsmodel->auto_complete('name',$data), $this->restaurantmodel->auto_complete('name',$data));
            }elseif($type == 'food')
            {
                $result = $this->itemsmodel->auto_complete('name',$data);
            }elseif($type == 'restaurant')
            {
                $result = $this->restaurantmodel->auto_complete('name',$data);
            }
        }
        $this->json_response($result);
    }

}