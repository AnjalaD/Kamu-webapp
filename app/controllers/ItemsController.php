<?php
namespace app\controllers;

use core\Controller;
use core\Router;
use core\Session;
use app\models\ItemsModel;
use app\models\UserModel;
use core\H;
use app\models\OwnerModel;
use app\models\RatingModel;

class ItemsController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->set_layout('default');
        $this->load_model('ItemsModel');
        $this->load_model('FoodItemModel');
        $this->load_model('TagModel');
        $this->load_model('ItemTagModel');
        $this->load_model('RatingModel');
    }


    //show food items belongs to logged in owner
    public function index_action()
    {
        $items = $this->itemsmodel->find_all_by_restaurant_id(UserModel::current_user()->restaurant_id, ['order' => 'item_name']);
        if (!$items) {
            $items = [];
        }
        $this->view->items = $items;
        $this->view->render('items/index');
    }


    //add new food item
    public function add_action()
    {
        $item = new ItemsModel();
        if ($this->request->is_post()) {
            $this->request->csrf_check();

            $tags = explode(',', $this->request->get('tag_array'));

            $item->assign($this->request->get());
            $item->restaurant_id = UserModel::current_user()->restaurant_id;

            if (!empty($this->request->get('image'))) {
                $item->image_url = SROOT . 'img/items/' . time() . '.png';
            }

            if ($item->save()) {
                H::save_image($this->request->get('image'), $item->image_url);

                $this->itemtagmodel->save_item_tags($item->last_inserted_id(), $this->tagmodel->save_tags($tags));

                Session::add_msg('success', 'New item added successfully!');
                Router::redirect('items');
            }

            $item->tags = $tags;
        }
        $this->view->item = $item;
        $this->view->display_errors = $item->get_error_messages();

        $this->view->post_action = SROOT . 'items/add';
        $this->view->render('items/add');
    }


    //edit existing food item
    public function edit_action($item_id)
    {
        $item = $this->fooditemmodel->find_by_item_id_restaurant_id((int)$item_id, OwnerModel::current_user()->restaurant_id);
        // H::dnd($item);
        $new_item = new ItemsModel();
        if ($item) {
            if ($this->request->is_post()) {
                $this->request->csrf_check();
                $item->assign($this->request->get());

                $tags = explode(',', $this->request->get('tag_array'));
                
                $new_item->assign($this->request->get());
                $new_item->id = $item->id;
                $new_item->restaurant_id = $item->restaurant_id;
                $new_item->image_url = $item->image_url;
                

                if (!empty($this->request->get('image'))) {
                    $new_item->image_url = SROOT . 'img/items/' . time() . '.png';
                }

                // H::dnd($new_item);

                if ($new_item->save()) {
                    H::save_image($this->request->get('image'), $new_item->image_url);

                    $this->itemtagmodel->save_item_tags($item->id, $this->tagmodel->save_tags($tags));

                    Session::add_msg('success', 'Changes saved successfully!');
                    Router::redirect('items');
                }
                
                $new_item->tags = $tags;
                $this->view->item = $new_item;

            }else{
                $this->view->item = $item;
            }

            $this->view->display_errors = $new_item->get_error_messages();
            $this->view->post_action = SROOT . 'items/edit/' . $item->id;
            $this->view->render('items/edit');
            return;
        }
        Router::redirect('restricted/error');
    }


    //show preview of a selected food item
    public function details_action($item_id)
    {
        $item = $this->fooditemmodel->find_by_item_id_restaurant_id((int)$item_id, OwnerModel::current_user()->restaurant_id);
        // H::dnd($item);
        if (!$item) {
            $response = false;
        } else {
            $response = H::create_card($item);
        }
        return $this->json_response($response);
    }

    //hide and unhide food item
    public function hide_unhide_action($item_id)
    {
        $item = $this->itemsmodel->find_by_id_restaurant_id((int)$item_id, OwnerModel::current_user()->restaurant_id);
        if ($item) {
            $item->hidden = !($item->hidden);
            if (!$item->save()) {
                Session::add_msg('danger', 'Something went wrong!');
            }
        }
        Router::redirect('items');
    }

    //delete food item 
    public function delete_action($item_id)
    {
        $item = $this->itemsmodel->find_by_id_restaurant_id((int)$item_id, OwnerModel::current_user()->restaurant_id);
        if ($item) {
            $item->delete();
            Session::add_msg('success', 'Item deleted successfully!');
        }
        
        Router::redirect('items');
    }

    
    //update rating of a item
    public function update_rating_action($item_id, $rating)
    {
        $this->request->csrf_check();
        
        if ($item = $this->itemsmodel->find_by_id($item_id)) {
            $customer_id = UserModel::current_user()->id;

            $new_rating = null;
            $effective_rating = 0;
            $rating_num = 0;

            if ($new_rating = $this->ratingmodel->find_by_item_id_customer_id($item_id, $customer_id)) {
                $prev_rating = $new_rating->rating;
                $new_rating->rating = $rating;

                $effective_rating = $rating - $prev_rating;
            } else {
                $new_rating = new RatingModel();
                $new_rating->item_id = $item_id;
                $new_rating->customer_id = $customer_id;
                $new_rating->rating =  $rating;

                $effective_rating = $rating;
                $rating_num = 1;
            }
            $new_rating->save();
            $item->rating = ($item->rating*$item->rating_num + $effective_rating)/($item->rating_num + $rating_num);
            $item->rating_num += $rating_num;
            $item->save();
        }
    }
}
