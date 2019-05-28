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
use app\helpers\Help;

class OrderController extends Controller
{
    public function __construct($controller, $acttion)
    {
        parent::__construct($controller, $acttion);
        $this->load_model('ItemsModel');
        $this->load_model('RestaurantModel');
        $this->load_model('OrderModel');
        $this->load_model('SubmittedOrderModel');
    }


    //view current-order -by customer
    public function order_action()
    {

        $items = [];
        $restaurant = null;
        if(Session::exists('items')){
            // H::dnd(Session::get('items'));
            $order = json_decode(Session::get('items'), true);
            $items = $this->itemsmodel->get_order_items($order['items']);
            $restaurant = $this->restaurantmodel->find_by_id($order['rid']);
        }
        $this->view->items = $items;
        $this->view->restaurant = $restaurant;

        $this->view->drafts = $this->ordermodel->get_drafts(UserModel::current_user()->id);
        $this->view->submitted = $this->ordermodel->get_submitted(UserModel::current_user()->id);
        $this->view->post_action_form = SROOT.'order/submit_order';
        $this->view->post_action_save = SROOT.'order/save_draft';
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

        $item = $this->itemsmodel->find_by_id_restaurant_id($id, $restaurant_id);
        $item_obj = new \stdClass();
        $item_obj->id = $item->id;
        $item_obj->item_name = $item->item_name;
        $item_obj->price = $item->price;
        

        if(Session::exists('item_objects')){
            $item_objects = Session::get('item_objects');
            if(! array_key_exists($item->id,$item_objects)){
               $item_objects[$item->id] = serialize($item_obj);
            }
        }else{
            $item_objects=[];
            $item_objects[$item->id] = serialize($item_obj);
        }
        Session::set('item_objects',$item_objects);


        if (Session::exists('items')) {
            $items = json_decode(Session::get('items'), true);
            if ($items['rid'] != $restaurant_id) {
                echo '0';
                return;
            }
        } else {
            $items = [];
            $items['rid'] = (int)$restaurant_id;
            $items['items'] = [];
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

        if(Session::exists('item_objects')){
            $item_objects = Session::get('item_objects');
            unset($item_objects[$id]);
            if(empty($item_objects)){
                Session::delete('item_objects');
            }else{
            Session::set('item_objects', $item_objects);
            }
        }
        Router::redirect('order/order');
        // $this->view->render('order/order');
    }

    public function change_item_quantity_action($item_id, $quantity)
    {
        $this->request->csrf_check();
        
        if(Session::exists('items') && Session::exists('item_objects'))
        {
            if($quantity < 1) $quantity = 1;
            $items = json_decode(Session::get('items'), true);
            $items['items'][$item_id] = (int)$quantity;
            Session::set('items', json_encode($items));
            $item_obj = unserialize(Session::get('item_objects')[$item_id]);
            $new_price = $item_obj->price * $quantity;
            $new_total = $this->get_total();
            if($new_total){
                $this->json_response([$new_price,$new_total]);
                return;
            }
        }
        $this->json_response(false);
    }


    //cancel order -by customer
    public function cancel_order_action()
    {
        Session::delete('items');
        Session::delete('item_objects');
        Session::add_msg('info', 'Your order canceled successfully!');
        Router::redirect('order/order');
    }


    public function pending_orders_action()
    {
        $orders = $this->submittedordermodel->find_all_pending_by_id_customer_id(CustomerModel::current_user()->id,["order"=>"time_stamp DESC"]);
        foreach($orders as $order){
            $order->restaurant_name = $this->restaurantmodel->find_by_id($order->restaurant_id)->restaurant_name;
        }
        $this->view->orders = $orders? $orders : [];
        // H::dnd($orders);
        $this->view->render('order/pending_orders');
    }

    // cancel pending order - by customer  !!!cannot cancel accepted orders
    public function cancel_pending_order_action($order_id)
    {
        $order = $this->submittedordermodel->find_by_id_customer_id($order_id, CustomerModel::current_user()->id);
        // H::dnd($order);
        if($order) {
            if($order->accepted == 0) {
                $order->delete();
                Session::add_msg('success', 'Your order is canceled!');
            } else {
                Session::add_msg('dange', 'You cannot cancel aproved order!');
            }
        }
        Session::add_msg('dange', 'Some thing went wrong, Please try again!');
        Router::redirect('order/pending_orders');
    }


    //submit order -by customer
    public function submit_order_action()
    {
        $new_order = new OrderModel();
        $new_submitted_order = new SubmittedOrderModel();
        if($this->request->is_post())
        {
            
            $this->request->csrf_check();
            $items = json_decode(Session::get('items'), true);

            $delivery_time = $this->request->get('date') .' '. $this->request->get('time');
            $delivery_time = Help::getDateTime($delivery_time);
            $order_code = Help::generateOrderCode();

            $new_order->assign($this->request->get());
            $new_submitted_order->assign($this->request->get());
            
            $new_order->customer_id = $new_submitted_order->customer_id = UserModel::current_user()->id;
            $new_order->restaurant_id = $new_submitted_order->restaurant_id = $items['rid'];
            $new_order->items = $new_submitted_order->items = json_encode($items['items'], JSON_FORCE_OBJECT);
            $new_order->delivery_time =$new_submitted_order->delivery_time = $delivery_time;
            $new_order->order_code =$new_submitted_order->order_code = $order_code;
            
            $new_submitted_order->total_price = $this->get_total();
            
            $new_order->submitted = 1;
            
            // H::dnd($new_submitted_order);            
            


            if($new_order->save() && $new_submitted_order->save())
            {
                Session::delete('items');
                Session::delete('item_objects');
                Session::add_msg('success', 'Order Submitted!!!');
                Router::redirect('');
            }else{
                Session::add_msg('danger','Error! Could not submit order');
            }
            $this->view->post_data = $new_order;
        }
        $this->view->post_data = $this;
        $this->view->render('order/order');
    }


    //save order as draft -by customer
    public function save_draft_action()
    {
        $draft = new OrderModel();
        if(Session::exists('items'))
        {
            if($this->request->is_post())
            {
                $this->request->csrf_check();
                $items = json_decode(Session::get('items'), true);

                $draft->customer_id = UserModel::current_user()->id;
                $draft->restaurant_id = $items['rid'];
                $restaurant_name = $this->restaurantmodel->find_by_id($draft->restaurant_id)->restaurant_name;
                $order_name = !empty($this->request->get('order_name'))? $this->request->get('order_name') : 'Saved Order';
                $draft->order_name = $restaurant_name.' : '.$order_name;
                $draft->items = json_encode($items['items']);
                
                if(!$draft->save())
                {
                    Session::add_msg('danger', 'Error in "save as draft"!');
                }
                Session::add_msg('success', 'Your order succesfully saved');
                Session::delete('items');
                Session::delete('item_objects');
            }
        }
        Router::redirect('order/order');

    }


    //get items of an saved or submitted order - by customer
    public function get_order_items_action($draft_id)
    {
        $this->request->csrf_check();
        $draft = $this->ordermodel->find_by_id_customer_id($draft_id, UserModel::current_user()->id);
        if($draft) {
            $items = $this->itemsmodel->get_order_items(json_decode($draft->items), true);
            // H::dnd($items);  
            $resposnse = H::create_order_dropdown($items, $draft->id);
        } else {
            $resposnse = '<li>Error occured</li>';
        }
        return $this->json_response($resposnse);
    }

    public function get_total(){
        
        if(Session::exists('items') && Session::exists('item_objects')){
            $total=0;
            $items = json_decode(Session::get('items'), true)['items'];
            
            $item_objects = Session::get('item_objects');
            foreach($items as $item_id => $quantity){
                // H::dnd(unserialize($item_objects[$item_id]));
                $total+= ($quantity * unserialize($item_objects[$item_id])->price);
            }
            return $total;
            
            
        }
        return false;

    }


    //use saved order as current order - by customer
    public function use_saved_order_action($order_id)
    {
        $order = $this->ordermodel->find_by_id_customer_id($order_id, UserModel::current_user()->id);
        if($order)
        {
            if(Session::exists('items'))
            {
                Session::delete('items');
            }
            if(Session::exists('item_objects'))
            {
                Session::delete('item_objects');
            }
            $items['rid'] = (int)$order->restaurant_id;
            $items['items'] = json_decode($order->items, true);
            Session::set('items', str_replace('\\', '', json_encode($items)));

            $item_objects = [];
            foreach($items['items'] as $item_id=> $qty){
                
                $item = $this->itemsmodel->find_by_id_restaurant_id($item_id,(int)$order->restaurant_id);
                $item_obj = new \stdClass();
                $item_obj->id = $item->id;
                $item_obj->item_name = $item->item_name;
                $item_obj->price = $item->price;
                
                $item_objects[$item_id]=serialize($item_obj);
            }
            Session::set('item_objects',$item_objects);


        }
        Router::redirect('order/order');
    }


    //remove saved or submitted order - by customer
    public function remove_saved_order_action($order_id)
    {
        $order = $this->ordermodel->find_by_id_customer_id($order_id, UserModel::current_user()->id);
        $order->delete();
        Session::add_msg('success', 'Saved Order Deleted!');
        Router::redirect('order/order');
    }


    //view all orders -by restaurant
    public function view_orders_action()
    {
        $pending_orders = $this->submittedordermodel->find_pending_by_restaurant_id(UserModel::current_user()->restaurant_id);
        $accepted_orders = $this->submittedordermodel->find_accepted_by_restaurant_id(UserModel::current_user()->restaurant_id);
        $this->view->pending_orders = $pending_orders;
        $this->view->accepted_orders = $accepted_orders;
        $this->view->render('order/view_orders');
        // H::dnd($orders);
    }


    //accept an order - by restaurant
    public function accept_order_action($order_id)
    {
        $order = $this->submittedordermodel->find_by_id_restaurant_id($order_id, UserModel::current_user()->restaurant_id);
        if($order)
        {
            $order->accepted = 1;
            if($order->save())
            {
                Session::add_msg('success', 'Order accepted!');
            } else {
                Session::add_msg('danger', 'Error occured!');
            }
            Router::redirect('order/view_orders');
        }
        Router::redirect('restricted/error');

    }


    //reject an order - by restaurant
    public function reject_order_action($order_id)
    {
        $order = $this->submittedordermodel->find_by_id_restaurant_id($order_id, UserModel::current_user()->restaurant_id);
        if($order)
        {
            $order->rejected = 1;
            if($order->save())
            {
                Session::add_msg('success', 'Order rejected!');
            } else {
                Session::add_msg('danger', 'Error occured!');
            }
            Router::redirect('order/view_orders');
        }
        Router::redirect('restricted/error');
    }


    //
    public function complete_order_action($order_id){
        $order = $this->submittedordermodel->find_by_id_restaurant_id($order_id, UserModel::current_user()->restaurant_id);
        if($order)
        {
            $order->completed = 1;
            if($order->save())
            {
                Session::add_msg('success', 'Order Completed!');
            } else {
                Session::add_msg('danger', 'Error occured!');
            }
            Router::redirect('order/view_orders');
        }
        Router::redirect('restricted/error');
    }

    public function get_all_orders_to_restaurant_html_action(){
        $this->request->csrf_check();
        $pending_orders = $this->submittedordermodel->find_pending_by_restaurant_id(UserModel::current_user()->restaurant_id);
        $accepted_orders = $this->submittedordermodel->find_accepted_by_restaurant_id(UserModel::current_user()->restaurant_id);
        $html = H::create_all_order_cards_list($pending_orders,$accepted_orders);
        return $this->json_response($html);
    }


    //ajax request handling - send order receipt
    public function get_order_receipt_action($order_id)
    {
        $this->request->csrf_check();
        $order = $this->submittedordermodel->find_pending_by_id_customer_id($order_id, UserModel::current_user()->id);
        $order->restaurant = $this->restaurantmodel->find_by_id($order->restaurant_id);
        $order->items = $this->itemsmodel->get_order_items(json_decode($order->items));
        return $this->json_response(H::create_receipt($order));
    }
}
