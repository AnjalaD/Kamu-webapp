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
        $items = $this->itemsmodel->find_all_by_user_id(current_user()->id, ['order'=>'name']);
        $this->view->items = $items;
        $this->view->render('items/index');
    }

    public function add_action()
    {
        $item = new itemsModel();
        $validation = new Validate();
        if($_POST){
            $item->user_id = current_user()->id;
            $item->deleted = 0;
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
        $item = $this->itemsmodel->find_by_id_user_id($id, current_user()->id);
        if(!$item)
        {
            Router::redirect('items');
        }
        $this->view->item = $item;
        $this->view->render('items/details');
    }

}