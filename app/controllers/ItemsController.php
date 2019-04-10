<?php
namespace app\controllers;

use core\Controller;
use core\Router;
use core\Session;
use app\models\ItemsModel;
use app\models\UserModel;
use core\H;
use app\models\OwnerModel;

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
            unset($_POST['tag_arry']);

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
        $item->tags = explode(',', $item->tags);
        if ($item) {
            if ($this->request->is_post()) {
                $this->request->csrf_check();
                $item->assign($this->request->get());

                $tags = explode(',', $this->request->get('tag_array'));
                unset($_POST['tag_arry']);

                $new_item = new ItemsModel();
                $new_item->assign($this->request->get());
                $new_item->id = $item->id;
                $new_item->restaurant_id = $item->restaurant_id;
                $new_item->image_url = $item->image_url;

                if (!empty($this->request->get('image'))) {
                    $new_item->image_url = SROOT . 'img/items/' . time() . '.png';
                }

                if ($new_item->save()) {
                    H::save_image($this->request->get('image'), $new_item->image_url);

                    $this->itemtagmodel->save_item_tags($item->last_inserted_id(), $this->tagmodel->save_tags($tags));

                    Session::add_msg('success', 'Changes saved successfully!');
                    Router::redirect('items');
                }
            }

            $this->view->item = $item;
            $this->view->display_errors = $item->get_error_messages();
            $this->view->post_action = SROOT . 'items/edit/' . $item->id;
            $this->view->render('items/edit');
            return;
        }
        Session::add_msg('danger', 'Something went wrong!');
        Router::redirect('items');
    }


    //show details of a selected food item
    public function details_action($id)
    {
        $item = $this->itemsmodel->find_by_id_restaurant_id((int)$id, OwnerModel::current_user()->restaurant_id);
        if (!$item) {
            Session::add_msg('danger', 'Something went wrong!');
            Router::redirect('items');
        }
        $this->view->item = $item;
        $this->view->render('items/details');
    }

    //hide food item
    public function hide_action($item_id)
    {
        $item = $this->itemsmodel->find_by_id_restaurant_id((int)$item_id, OwnerModel::current_user()->restaurant_id);
        if ($item) {
            $item->delete();
        }
        Router::redirect('items');
    }

    //unhide food item
    public function unhide_action($item_id)
    {
        $item = $this->itemsmodel->find_by_id_restaurant_id((int)$item_id, OwnerModel::current_user()->restaurant_id);
        if ($item) {
            $item->deleted = 0;
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
            $item->permenent_delete();
        }
        Session::add_msg('success', 'Item deleted successfully!');
        Router::redirect('items');
    }
}
