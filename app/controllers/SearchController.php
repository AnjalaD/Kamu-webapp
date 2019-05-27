<?php
namespace app\controllers;
use core\Controller;
use core\H;

class SearchController extends Controller
{
    private $_search_model;

    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('FoodItemModel');
        $this->load_model('ItemsModel');
        $this->load_model('RestaurantModel');
        $this->view->set_layout('default');
        $this->_search_model = $this->fooditemmodel;
    }

    public function index_action()
    {
        // H::dnd($this->request->get());
        if($this->request->is_post())
        {
            $data = $this->request->exists('search_string')? $this->request->get('search_string') : '';

            if($this->request->exists('food'))
            {
                $this->food_action($data);
            }elseif($this->request->exists('restaurant'))
            {
                $this->restaurant_action($data);
            }
        }
    }

    public function food_action($data='')
    {   
        $this->view->post_data = $data;
        $this->view->render('search/food');
    }
    

    public function restaurant_action($data='')
    {
        $this->view->post_data = $data;
        $this->view->render('search/restaurant');
    }


    //handle auto complete ajax request - in search
    public function auto_complete_action($data=[])
    {
        $results =[];
        if(!empty($data))
        {
            $type = $this->request->get('type');
            if($type == 1) {
                $this->_search_model = $this->itemsmodel;
            } elseif($type == 2) {
                $this->_search_model = $this->restaurantmodel;
            } else {
                $this->_search_model = $this->itemsmodel;
            }
        }
        $results = $this->_search_model->auto_complete($data);
        // H::dnd($result);
        return $this->json_response($results);
    }


    //search food by tags
    public function search_by_tag_action($tag)
    {
        $results = $this->fooditemmodel->search_by_tag($tag);
        // H::dnd($results);
        $this->view->results = H::create_card_list($results);
        $this->view->post_data = $tag;
        $this->view->render('search/food');
    }


    //handle filter and sort ajax requests - in search
    public function search_action($type, $page=0)
    {
        $response = [];
        $filters = $this->request->get();
        $this->request->csrf_check();

        if($type==1) {
            $this->_search_model = $this->fooditemmodel;
        } elseif($type==2) {
            $this->_search_model = $this->restaurantmodel;
        }

        $response = $this->_search_model->filter($filters, $page);
        
        return $this->json_response($response);
    }

}