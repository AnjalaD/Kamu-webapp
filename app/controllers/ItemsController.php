<?php
namespace app\controllers;
use core\Controller;
use core\Router;
use core\Session;
use app\models\ItemsModel;
use app\models\UserModel;
// use core\H;

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
        if($this->request->is_post()){
            $this->request->csrf_check();
            $item->assign($this->request->get());
            $item->user_id = UserModel::current_user()->id;
            
            if($item->save()){
                Session::add_msg('success', 'New item added successfully!');
                Router::redirect('items');
            }
        }
        $this->view->item = $item;
        $this->view->display_errors = $item->get_error_messages();

        $this->view->post_action = SROOT . 'items/add';
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
            if($this->request->is_post())
            {
                $this->request->csrf_check();
                $item->assign($this->request->get());
                if($item->save())
                {
                    Router::redirect('items');
                }
            }
            
            $this->view->item = $item;
            $this->view->display_errors = $item->get_error_messages();
            $this->view->post_action = SROOT . 'items/edit/' . $item->id;
            $this->view->render('items/edit');
            return;
        }
               
        Router::redirect('items');
    }

}