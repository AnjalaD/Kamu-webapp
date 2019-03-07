<?php

class ItemsController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->set_layout('default');
        $this->load_model('ItemsModel');
    }

    public function index_action()
    {
        $items = $this->itemsmodel->find_all_by_user_id(UserModel::current_user()->id, ['order'=>'name']);
        if(!$items){
            $items = [];
        }
        $this->view->items = $items;
        $this->view->render('items/index');
    }

    public function add_action()
    {
        $item = new itemsModel();
        $validation = new Validate();
        if($_POST){
            $item->user_id = UserModel::current_user()->id;
            $item->assign($_POST);
            $validation->check($_POST, itemsModel::validation());
            if($validation->passed()){
                $item->save();
                Router::redirect('items');
            }
        }
        $this->view->item = $item;
        $this->view->post_action = SROOT . 'items/add';
        $this->view->display_errors = $validation->display_errors();
        $this->view->render('items/add');
    }

    public function details_action($id)
    {
        $item = $this->itemsmodel->find_by_id_user_id((int)$id, UserModel::current_user()->id);
        if(!$item)
        {
            Router::redirect('items');
        }
        $this->view->item = $item;
        $this->view->render('items/details');
    }

    public function delete_action($item_id)
    {
        $item = $this->itemsmodel->find_by_id_user_id((int)$item_id, UserModel::current_user()->id);
        if($item)
        {
            $item->delete();
        }
        Router::redirect('items');
    }

    public function edit_action($item_id)
    {
        $item = $this->itemsmodel->find_by_id_user_id((int)$item_id, UserModel::current_user()->id);
        if($item)
        {
            $validation = new Validate();
            if($_POST)
            {
                $item->assign($_POST);
                $validation->check($_POST, ItemsModel::validation());
                if($validation->passed())
                {
                    $item->save();
                    Router::redirect('items');
                }
            }
            
            $this->view->item = $item;
            $this->view->display_errors = $validation->display_errors();
            $this->view->post_action = SROOT . 'items/edit/' . $item->id;
            $this->view->render('items/edit');
            return;
        }
               
        Router::redirect('items');
    }

}