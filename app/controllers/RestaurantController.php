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
        $this->load_model('CashierModel');
        $this->load_model('OwnerModel');
        $this->load_model('FoodItemModel');
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
        $this->view->render('restaurant/unverified_restaurants');
    }


    //add new restaurant
    public function verify_action($restaurant_id)
    {
        $restaurant = $this->restaurantmodel->find_unverified_by_id($restaurant_id);
        if ($this->request->is_post()) {
            $this->request->csrf_check();

            // H::dnd($restaurant);
            $restaurant->assign($this->request->get());

            $owner = $this->ownermodel->find_by_id($restaurant->owner_id);
            $owner->restaurant_id = $restaurant->id;

            $restaurant->verified = 1;

            if (!empty($this->request->get('image'))) {
                $restaurant->image_url = SROOT.'img/restaurant/'.time().'.png';
            }
            // H::dnd(($this->request->get('image')));
            
            if ($restaurant->save()) {
                H::save_image($this->request->get('image'), $restaurant->image_url);
                Session::add_msg('success', 'New Restaurant Verified successfully!');
                if(!$owner->save()) {
                    Session::add_msg('danger', 'Cannot bind the owner!!');
                }
                Router::redirect('restaurant');
            }
        }
        $this->view->restaurant = $restaurant;
        $this->view->display_errors = $restaurant->get_error_messages();

        $this->view->post_action = SROOT . 'restaurant/verify/'. $restaurant->id;
        $this->view->render('restaurant/verify');
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
                // H::dnd($restaurant->save());

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
        if ($this->request->is_post() && $this->request->csrf_check()) {
            $owner = UserModel::current_user();
            $submittedordermodel = new SubmittedOrderModel();
            $nooforders = sizeof($submittedordermodel->find_pending_by_restaurant_id((int)$owner->restaurant_id));
            // echo (strval($nooforders));
            $this->json_response($nooforders);
        }
    }

    public function submit_details_action()
    {
        $restaurant = $this->restaurantmodel->find_by_owner_id(UserModel::current_user()->id);
        if($restaurant) {
            Session::add_msg('danger', 'Your have previously submitted a restaurant!!');
            Router::redirect('');
        }
        $restaurant = new RestaurantModel();
        if ($this->request->is_post()) {
            $this->request->csrf_check();
            // H::dnd($this->request->get());

            $restaurant->assign($this->request->get());
            if (!empty($this->request->get('image'))) {
                $restaurant->image_url = SROOT.'img/restaurant/'.time().'.png';
            }
            $restaurant->owner_id = UserModel::current_user()->id;
            // H::dnd($restaurant);
            if ($restaurant->save()) {
                H::save_image($this->request->get('image'), $restaurant->image_url);
                Session::add_msg('success', 'Details submitted successfully! Your restaurant will be registered soon...');
                Router::redirect('');
            }
        }
        $this->view->restaurant = $restaurant;
        $this->view->display_errors = $restaurant->get_error_messages();

        $this->view->post_action = SROOT . 'restaurant/submit_details';
        $this->view->render('restaurant/submit_details');
    }


    // show casheirs of restaurant - by owner
    public function cashiers_action()
    {
        $cashiers = $this->cashiermodel->find_all_by_restaurant_id(UserModel::current_user()->restaurant_id);
        $this->view->cashiers = $cashiers? $cashiers : [];
        $this->view->render('restaurant/cashiers');
    }


    //toggle cashier status -> disable-enable - by owner
    public function cashier_status_toggle_action($cashier_id)
    {
        $cashier = $this->cashiermodel->find_by_id_restaurant_id($cashier_id, UserModel::current_user()->restaurant_id);
        if(!$cashier->toggle_disable()) {
            Session::add_msg('danger', 'Cannot change the Cashier status!');
        }else{
            Session::add_msg('success', 'Cashier status changed');
        }
        Router::redirect('restaurant/cashiers');
    }

    //remove cashier - by owner
    public function remove_cashier_action($cashier_id)
    {
        $cashier = $this->cashiermodel->find_by_id_restaurant_id($cashier_id, UserModel::current_user()->restaurant_id);
        if(! $cashier->delete()){
            Session::add_msg('danger', 'Cannot delete cashier!');
        }else{
            Session::add_msg('danger', 'Cashier deleted');
        }
        Router::redirect('restaurant/cashiers');
    }


    //ajax search for restaurant items
    public function search_action($restaurant_id, $page=0)
    {
        $filters = $this->request->get();
        $this->request->csrf_check();


        $response = $this->fooditemmodel->filter_by_restaurant($restaurant_id, $filters, $page);
        
        return $this->json_response($response);
    }

}
