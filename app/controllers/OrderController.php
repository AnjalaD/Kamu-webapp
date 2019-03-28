<?php
namespace app\controllers;
use core\Controller;
use core\FH;
use core\H;
use app\models\OrderModel;
use core\Session;
use core\Router;

class OrderController extends Controller
{
    public function __construct($controller, $acttion)
    {
        parent::__construct($controller, $acttion);
        $this->load_model('ItemsModel');
        $this->load_model('OrderModel');
    }


    public function order_action()
    {
        $order = [];
        if(Session::exists('items')){
            $order = json_decode(Session::get('items'), true)['items'];
        }
        $this->view->items = $this->itemsmodel->get_order_items($order);
        $this->view->render('order/index');
    }

    public function add_to_order_action($restaurant_id, $id, $quantity=1){
        if(Session::exists('items'))
        {
            $items = json_decode(Session::get('items'), true);
            if($items['rid'] != $restaurant_id){
                // Session::add_msg('info', 'You should select items from one restaurant');
                return;
            }  
        }else
        {
            $items['rid'] = (int)$restaurant_id;
        }
        $items['items'][$id] = $quantity;
        Session::set('items', json_encode($items));
        echo true;
        return;
        
    }

    public function remove_from_order_action($id)
    {
        $items = json_decode(Session::get('items'), true);
        unset($items['items'][$id]);
        Session::set('items', json_encode($items));
        $this->view->items = $this->itemsmodel->get_order_items($items['items']);
        if(empty($items['items']))
        {
            Session::delete('items');
        }
        $this->view->render('order/index');
    }

    public function cancel_order_action()
    {
        Session::delete('items');
        Session::add_msg('info', 'Your order canceled successfully!');
        $this->view->render('order/index');
    }

    public function submit_order_action()
    {
        
    }
}
