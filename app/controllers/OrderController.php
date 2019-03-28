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
        if(Session::exists('items')){
            $order_items = json_decode(Session::get('items'));
            $items = [];
            foreach($order_items as $item)
            {
                $items[] = $this->itemsmodel->find_by_id((int)$item);
            }
            $this->view->items = $items;
        }
        $this->view->render('order/index');
    }

    public function add_to_order_action($restaurant_id, $id){
        if(Session::exists('items'))
        {
            if(Session::get('rid') != $restaurant_id){
                // Session::add_msg('info', 'You should select items from one restaurant');
                return;
            }
            $items = json_decode(Session::get('items'));
            
        }else
        {
            Session::set('rid', $restaurant_id);
        }
        $items[] = $id;
        Session::set('items', json_encode(array_unique($items)));
        echo true;
        return;
        
    }

    public function remove_from_order($id){
        $items = Session::get('items');
        unset($items[$id]);
        Session::set('items', $items);
        $this->json_response($items);
    }

    public function cancel_order_action()
    {
        Session::delete('items');
        Session::delete('rid');
        Session::add_msg('info', 'Your order canceled successfully!');
        $this->view->render('order/index');
    }
}
