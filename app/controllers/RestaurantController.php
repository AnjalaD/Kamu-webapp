<?php
namespace app\controllers;

use core\Controller;
use core\Router;
use core\Session;
use app\models\RestaurantModel;
use core\H;

class RestaurantController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->set_layout('default');
        $this->load_model('RestaurantModel');
        $this->load_model('ItemsModel');
    }


    //view list of restaurants
    public function index_action()
    {
        $restaurants = $this->restaurantmodel->find();
        if (!$restaurants) {
            $restaurants = [];
        }
        $this->view->restaurants = $restaurants;
        $this->view->render('restaurant/index');
    }


    //add new restaurant
    public function add_action()
    {
        $restaurant = new RestaurantModel();
        if ($this->request->is_post()) {
            $this->request->csrf_check();

            $restaurant->assign($this->request->get());
            if (!empty($this->request->get('image'))) {
                $restaurant->image_url = SROOT.'img/restaurant/'.time().'.png';
            }
            // H::dnd($restaurant);
            if ($restaurant->save()) {
                H::save_image($this->request->get('image'), $restaurant->image_url);
                Session::add_msg('success', 'New item added successfully!');
                Router::redirect('restaurant');
            }
        }
        $this->view->restaurant = $restaurant;
        $this->view->display_errors = $restaurant->get_error_messages();

        $this->view->post_action = SROOT . 'restaurant/add';
        $this->view->render('restaurant/add');
    }
    

    //view page of a selected restaurant
    public function details_action($id)
    {
        $restaurant = $this->restaurantmodel->find_by_id((int)$id);
        if (!$restaurant) {
            Router::redirect('restaurant');
        }
        $items = $this->itemsmodel->find_all_by_restaurant_id((int)$id);

        $this->view->items = $items;
        $this->view->restaurant = $restaurant;
        $this->view->render('restaurant/details');
    }

    

    // delete reataurant
    public function delete_action($id)
    {
        $restaurant = $this->restaurantmodel->find_by_id((int)$id);
        if ($restaurant) {
            $restaurant->delete();
        }
        Router::redirect('restaurant');
    }


    //edit restaurant's details
    public function edit_action($restaurant_id)
    {
        $restaurant = $this->restaurantmodel->find_by_id((int)$restaurant_id);
        if ($restaurant) {
            if ($this->request->is_post()) {
                $this->request->csrf_check();
                $restaurant->assign($this->request->get());
                
                if (!empty($this->request->get('image'))) {
                    $restaurant->image_url = SROOT.'img/restaurant/'.time().'.png';
                }

                if ($restaurant->save()) {
                    H::save_image($this->request->get('image'), $restaurant->image_url);
                    Router::redirect('restaurant');
                }
            }
            $this->view->restaurant = $restaurant;
            $this->view->display_errors = $restaurant->get_error_messages();
            $this->view->post_action = SROOT . 'restaurant/edit/' . $restaurant->id;
            $this->view->render('restaurant/edit');
            return;
        }
        Router::redirect('restaurant');
    }

    
}
