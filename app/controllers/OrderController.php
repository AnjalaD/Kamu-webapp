<?php
namespace app\controllers;
use core\Controller;
use core\H;
use app\models\OrderModel;
use core\Session;
use core\Router;
use app\models\UserModel;
use app\models\CustomerModel;
use app\models\SubmittedOrderModel;

class OrderController extends Controller
{
    public function __construct($controller, $acttion)
    {
        parent::__construct($controller, $acttion);
        $this->load_model('ItemsModel');
        $this->load_model('OrderModel');
        $this->load_model('SubmittedOrderModel');
    }


    //view current-order -by customer
    public function order_action()
    {
        $order = [];
        if(Session::exists('items')){
            $order = json_decode(Session::get('items'), true)['items'];
        }
        $this->view->items = $this->itemsmodel->get_order_items($order);

        $this->view->drafts = $this->ordermodel->get_drafts();
        $this->view->post_action = SROOT.'order/submit_order';
        $this->view->render('order/order');
    }


    //$_SESSION['items']={'rid': restaurant_id, 'items' :[item_id : quantity,..., i:q]}
    /**
     * echo->   -1 = prompt login as customer
     *          0 = prompt cancel, new order( 1.save existing in as draft   2.dismiss existing )
     *          1 = change 'add to cart' -> 'remove item' 
     */
    public function add_to_order_action($restaurant_id, $id, $quantity = 1)
    {
        if (!(UserModel::current_user() instanceof CustomerModel)) {
                echo '-1';
                return;
            }
        if (Session::exists('items')) {
                $items = json_decode(Session::get('items'), true);
                if ($items['rid'] != $restaurant_id) {
                    echo '0';
                    return;
                }
            } else {
                $items=[];
                $items['rid'] = (int)$restaurant_id;
                $items['cid'] = (int)UserModel::current_user()->id;
                $items['items']=[];
            }
        if (array_key_exists($id, $items['items'])) {
            $items['items'][$id] += 1;
        } else {
            $items['items'][$id] = $quantity;
        }
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
        Router::redirect('order/order');
        // $this->view->render('order/order');
    }


    //cancel order -by customer
    public function cancel_order_action()
    {
        Session::delete('items');
        Session::add_msg('info', 'Your order canceled successfully!');
        $this->view->render('order/order');
    }


    //submit order -by customer
    public function submit_order_action()
    {
        $new_order = new OrderModel();
        $new_submitted_order = new SubmittedOrderModel();
        if($this->request->is_post())
        {
            $items = json_decode(Session::get('items'), true);

            $new_order->assign($this->request->get());            
            $new_order->customer_id = $items['cid'];
            $new_order->restaurant_id = $items['rid'];
            $new_order->items =  json_encode($items['items'], JSON_FORCE_OBJECT);  
            
            $new_submitted_order->assign($this->request->get());
            $new_submitted_order->customer_id = $new_order->customer_id;
            $new_submitted_order->restaurant_id = $new_order->restaurant_id;
            $new_submitted_order->items =  $new_order->items;
            // H::dnd($new_submitted_order);
            Session::delete('items');


              
            if($new_order->save() && $new_submitted_order->save())
            {
                Router::redirect('');
            }
            $this->view->post_data = $new_order;
        }
        $this->view->post_data = $this;
        $this->view->render('order/submit_order');
    }


    //save order as draft -by customer
    public function save_draft_action()
    {
        $draft = new OrderModel();
        if(Session::exists('items'))
        {
            $items = json_decode(Session::get('items'), true);
            $draft->customer_id = UserModel::current_user()->id;
            $draft->restaurant_id = $items['rid'];
            $draft->items = json_encode($items['items']);
            
            if(!$draft->save())
            {
                Session::add_msg('danger', 'Error in "save as draft"!');
            }
            Session::add_msg('success', 'Your order succesfully saved as a draft!');
            Session::delete('items');
        }
        Router::redirect('order/order');

    }


    //view all orders -by restaurant
    public function view_orders_action()
    {
        $orders = $this->submittedordermodel->find_by_restaurant_id(UserModel::current_user()->restaurant_id);
        $this->view->orders = $orders;
        $this->view->render('order/view_orders');
        // H::dnd($orders);
    }

}
