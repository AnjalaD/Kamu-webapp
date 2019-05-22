<?php
namespace app\controllers;

use core\Controller;
use core\Router;
use core\Session;
use app\models\RestaurantModel;
use app\models\UserModel;
use app\models\SubmittedOrderModel;
use core\H;

class RestaurantController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->set_layout('default');
        $this->load_model('RestaurantModel');
        $this->load_model('ItemsModel');
        $this->load_model('SubmittedOrderModel');
    }


    //view list of restaurants
    public function index_action()
    {
        $restaurants = $this->restaurantmodel->find_all();
        if (!$restaurants) {
            $restaurants = [];
        }
        $this->view->restaurants = $restaurants;
        $this->view->render('restaurant/index');
    }

    public function unverified_restaurant_action()
    {
        $restaurants = $this->restaurantmodel->find_all_unverified();
        if (!$restaurants) {
            $restaurants = [];
        }
        $this->view->restaurants = $restaurants;
        $this->view->render('restaurant/index');
    }


    //add new restaurant
    public function register_action($restaurant_id)
    {
        $restaurant = new RestaurantModel();
        if ($this->request->is_post()) {
            $this->request->csrf_check();

            $restaurant->assign($this->request->get());
            $restaurant->verified = 1;
            if (!empty($this->request->get('image'))) {
                $restaurant->image_url = SROOT.'img/restaurant/'.time().'.png';
            }
            // H::dnd($restaurant);
            if ($restaurant->save()) {
                H::save_image($this->request->get('image'), $restaurant->image_url);
                Session::add_msg('success', 'New item added successfully!');
                Router::redirect('restaurant');
            }

            $this->view->restaurant = $restaurant;
        } else {
            $this->view->restaurant = $this->restaurantmodel->find_unverified_by_id($restaurant_id);
        }
        $this->view->display_errors = $restaurant->get_error_messages();

        $this->view->post_action = SROOT . 'restaurant/register';
        $this->view->render('restaurant/register');
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

    //view owner's restaurant - editable page
    public function my_restaurant_action()
    {
        $owner = UserModel::current_user();
        $restaurant = $this->restaurantmodel->find_verified_by_id((int)$owner->restaurant_id);
        if (!$restaurant) {
            Router::redirect('restaurant/submit_details');
        }
        // $items = $this->itemsmodel->find_all_by_restaurant_id((int)$id);

        // $this->view->items = $items;
        $submittedordermodel = new SubmittedOrderModel();
        $nooforders = sizeof($submittedordermodel->find_pending_by_restaurant_id((int)$owner->restaurant_id));
        // H::dnd($submittedordermodel->find_unaccepted_by_restaurant_id((int)$owner->restaurant_id));
        $this->view->restaurant = $restaurant;
        $this->view->nooforders = $nooforders;
        $this->view->render('restaurant/my_restaurant');
    }

    public function no_of_orders_action(){
        $owner = UserModel::current_user();
        $submittedordermodel = new SubmittedOrderModel();
        $nooforders = sizeof($submittedordermodel->find_pending_by_restaurant_id((int)$owner->restaurant_id));
        echo (strval($nooforders));
    }

    public function submit_details_action()
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
                Session::add_msg('success', 'Details submitted successfully!');
                Router::redirect('');
            }
        }
        $this->view->restaurant = $restaurant;
        $this->view->display_errors = $restaurant->get_error_messages();

        $this->view->post_action = SROOT . 'restaurant/submit_details';
        $this->view->render('restaurant/submit_details');
    }
}
