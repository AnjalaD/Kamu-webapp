<?php
namespace app\controllers;
use core\Controller;
use core\FH;
use core\H;
use app\models\OrderModel;
use core\Session;
use core\Router;
use app\models\UserSession;
use app\models\UserModel;
use app\models\CustomerModel;

class OrderController extends Controller
{
    public function __construct($controller, $acttion)
    {
        parent::__construct($controller, $acttion);
        $this->load_model('ItemsModel');
        $this->load_model('OrderModel');
    }

    //view current-order -by customer
    public function order_action()
    {
        $order = [];
        if(Session::exists('items')){
            $order = json_decode(Session::get('items'), true)['items'];
        }
        $this->view->items = $this->itemsmodel->get_order_items($order);
        $this->view->render('order/index');
    }


    //$_SESSION['items']={'rid': restaurant_id, 'items' :[item_id : quantity,..., e:r]}
    public function add_to_order_action($restaurant_id, $id, $quantity=1){
        if(!(UserModel::current_user() instanceof CustomerModel))
        {
            echo '-1';
            return;
        }
        if(Session::exists('items'))
        {
            $items = json_decode(Session::get('items'), true);
            if($items['rid'] != $restaurant_id){
                echo '0';
                return;
            }  
        }else
        {
            $items['rid'] = (int)$restaurant_id;
        }
        $items['items'][$id] = $quantity;
        Session::set('items', json_encode($items));
        echo '1';
        return;
        
    }


    //remove item from order -by customer
    public function remove_from_order_action($id)
    {
        if(Session::exists('items'))
        {
            $items = json_decode(Session::get('items'), true);
            unset($items['items'][$id]);
            Session::set('items', json_encode($items));

            $this->view->items = $this->itemsmodel->get_order_items($items['items']);

            if(empty($items['items']))
            {
                Session::delete('items');
            }
        }
        $this->view->render('order/index');
    }


    //cancel order -by customer
    public function cancel_order_action()
    {
        Session::delete('items');
        Session::add_msg('info', 'Your order canceled successfully!');
        $this->view->render('order/index');
    }


    //submit order -by customer
    public function submit_order_action()
    {
        $new_order = new OrderModel();
        if($this->request->is_post())
        {
            $new_order->assign($this->request->get());
            if($new_order->save())
            {
                Router::redirect('');
            }
            $this->view->post_data = $new_order;
        }
        $this->view->post_data = $this;
        $this->view->render('order/submit_order');
    }

    //save order as draft -by customer
    public function save_draft()
    {

    }


    //view all orders -by restaurant
    public function view_all_orders()
    {

    }

}
