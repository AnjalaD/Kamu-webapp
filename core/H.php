<?php
namespace core;

use core\Session;
use app\models\UserModel;
use app\models\CustomerModel;


class H
{
  public static function dnd($data)
  {
    echo '<pre>';
    echo var_dump($data);
    echo '</pre>';
    die;
  }

  public static function current_page()
  {
    $current_page = $_SERVER['REQUEST_URI'];
    if ($current_page == SROOT || $current_page == SROOT . 'home/index') {
      $current_page = SROOT . 'home';
    }
    return $current_page;
  }

  public static function get_obj_properties($obj)
  {
    return get_object_vars($obj);
  }

  public static function decode_image($data)
  {
    //data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAAC0==
    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $data = base64_decode($image_array_2[1]);
    return $data;
  }

  public static function save_image($data, $path)
  {
    if (!empty($data)) {
      $image = H::decode_image($data);
      if ($image && file_put_contents('../..' . $path, $image)) {
        return $path;
      }
    }
    return DEFUALT_ITEM_IMAGE;
  }

  public static function build_menu($menu, $drop_down_class = "")
  {
    ob_start();
    $current_page = self::current_page();
    foreach ($menu as $key => $value) : $active = ''; ?>
    <?php if (is_array($value)) : ?>
      <li class="nav-item dropdown">
        <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
          <?= $key ?>
        </a>
        <div class="dropdown-menu <?= $drop_down_class ?>" role="menu">
          <?php foreach ($value as $k => $v) :
            $active = ($v == $current_page) ? 'active' : '' ?>
            <?php if ($k == 'separator') : ?>
              <div class="dropdown-divider"></div>
            <?php else : ?>
              <a class="dropdown-item <?= $active ?>" role="presentation" href="<?= $v ?>">
                <?= $k ?>
              </a>
            <?php endif ?>
          <?php endforeach ?>
        </div>
      </li>
    <?php else :
    $active = ($value == $current_page) ? 'active' : '' ?>
      <li class="nav-item NavBar_Item" role="presentation" id="Home_NavBarItem_Food">
        <a class="nav-link NavBar_Link <?= $active ?>" href="<?= $value ?>" id="Home_NavBar_Food" style="font-family:Aclonica, sans-serif;">
          <?= $key ?>
        </a>
      </li>
    <?php endif ?>
  <?php endforeach;
return ob_get_clean();
}

public static function create_card_list($items)
{
  if (empty($items)) {
    return '';
  }
  $html = '<div class="grid">';
  foreach ($items as $item) {
    $html .= self::create_card($item);
  }
  $html .= '</div>';
  return $html;
}

public static function create_card($item)
{
  ob_start() ?>
  <div id="food_item_display_card" class="grid-item card block span3 m-1">
    <div class="product">
      <img id="food_item_image" src=<?= $item->image_url ?>>
    </div>
    <div class="info pt-0 pb-3">
      <h4><?= $item->item_name ?></h4>
      <span class="restaurant_name">
        <a class="link" href="<?= SROOT ?>restaurant/details/<?= $item->restaurant_id ?>"><?= $item->restaurant_name ?></a>
      </span>
      <div id="food_item_description" style="height:5.5rem; overflow-y:auto;" class="description"><?= $item->description ?></div>
      <div class="m-2" id="tags" style="height:2.43rem; overflow-y:auto;">
        <?php if ($item->tags) : ?>
          <?php foreach ($item->tags as $tag) : ?>
            <button class="tag btn btn-sm m-1" style="border-color:black;" id="<?= $tag ?>"> <?= $tag ?> </button>
          <?php endforeach ?>
        <?php endif ?>
      </div>
      <span class="price"><?= $item->price ?> LKR</span>
      <div class="mt-1 mb-0">
        <i class="icon-shopping-cart icon-2x"></i>
        <?php if ((Session::exists('items')) && (array_key_exists($item->id, json_decode(Session::get('items'), true)['items']))) : ?>
          <button class="btn btn-danger pull-right" onClick="removeFromOrder(<?= $item->restaurant_id ?>, <?= $item->id ?>,this)">Remove Item</button>
        <?php else : ?>
          <button class="btn btn-info pull-right" onClick="addToOrder(<?= $item->restaurant_id ?>, <?= $item->id ?>,this)">Add to Order</button>
        <?php endif ?>
      </div>
    </div>
    <div class="details p-0 m-0">
      <span>Rating : </span>
      <span id="rating"><?= $item->rating . '(' . $item->rating_num . ')' ?></span>
      <br>
      <span class="rating" id="<?= $item->id ?>">
        <span class="star" id="5"></span>
        <span class="star" id="4"></span>
        <span class="star" id="3"></span>
        <span class="star" id="2"></span>
        <span class="star" id="1"></span>
      </span>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

public static function create_order_dropdown($item_list, $order_id)
{
  ob_start(); ?>

  <div class="dropdown-item">
    <div class="row">
      <table class="table text-center">
        <thead>
          <tr>
            <th> Item</th>
            <th> Qty</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($item_list as $item) : ?>
            <tr>
              <?php if ($item->deleted == 1) : ?>
                <td>This item is no longer available</td>
              <?php else : ?>
                <td><?= $item->item_name ?></td>
                <td><?= $item->quantity ?></td>
              <?php endif ?>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6 text-center">
        <a href="<?= SROOT ?>order/remove_saved_order/<?= $order_id ?>"><button class="btn btn-danger">Delete</button></a>
      </div>
      <div class="col-md-6 text-center">
        <a href="<?= SROOT ?>order/use_saved_order/<?= $order_id ?>"><button class="btn btn-success">Use now</button></a>
      </div>
    </div>
  </div>

  <?php
  return ob_get_clean();
}

public static function create_pagination_tabs($page_no, $end = false)
{
  ob_start(); ?>
  <?php if ($end) : ?>
    <span>End of Results</span>
  <?php endif ?>
  <nav>
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="#" onclick="goToPage(0)">First</a></li>
      <?php if ($page_no > 0) : ?>
        <li class="page-item"><a class="page-link" href="#" onclick="goToPage(<?= $page_no - 1 ?>)"><?= $page_no ?></a></li>
      <?php endif ?>
      <li class="page-item active"><a class="page-link" href="#" onclick="goToPage(<?= $page_no ?>)"><?= $page_no + 1 ?></a></li>
      <?php if (!$end) : ?>
        <li class="page-item"><a class="page-link" href="#" onclick="goToPage(<?= $page_no + 1 ?>)"><?= $page_no + 2 ?></a></li>
      <?php endif ?>
    </ul>
  </nav>
  <?php
  return ob_get_clean();
}

public static function create_pending_order_card($order)
{
  ob_start(); ?>

  <div class="order-card">
    <div class="row">
      <div class="col-md-6" style="padding-right: 0;">
        <h5 style="background-color: #9d2525; color: #FFFFFF; padding: 5px;"><?= $order->order_code ?></h5>
      </div>
      <div class="col-md-6" style="padding-left: 0;">
        <h5 style="padding: 5px; background-color: rgba(234, 167, 15, 0.73);"><?= $order->delivery_time ?></h5>
      </div>
    </div>
    <div class="row dropdown-row">
      <div class="dropdown col-md-6 text-center">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> View Items </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <table class="table dropdown-item">
            <thead>
              <tr class="thead-dark">
                <th>Item</th>
                <th>Qty</th>
              </tr>
            </thead>
            <tbody>
              <?php $items = json_decode($order->items, true) ?>

              <?php foreach ($items as $item_id => $qty) : ?>
                <tr>
                  <td><?= $item_id ?></td>
                  <td><?= $qty ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-6 text-center ">
        <p><?= $order->total_price ?> LKR</p>
      </div>
    </div>
    <div class="row" style="height: auto;">
      <div class="col-md-6 text-center">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 80%; width: auto;"> View Notes </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
          <div class="overflow-auto dropdown-item" rows="" style="width: auto;"><?= $order->notes ?></div>
        </div>
      </div>
      <div class="col-md-3 text-center">
        <a class="btn btn-light" style="background-color: #fa0404; width: auto; height: 90%; color: #ffffff;" href="<?= SROOT . 'order/reject_order/' . $order->id ?>""><small>Reject </small></a>
              </div>
              <div class=" col-md-3 text-center">
          <a class="btn btn-light" style="width: auto; height: 90%; background-color: #17f607;" href="<?= SROOT . 'order/accept_order/' . $order->id ?>">Accept </a>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

public static function create_accepted_order_card($order)
{
  ob_start(); ?>

  <div class="order-card">
    <div class="row">
      <div class="col-md-6" style="padding-right: 0;">
        <h5 style="background-color: #9d2525; color: #FFFFFF; padding: 5px;"><?= $order->order_code ?></h5>
      </div>
      <div class="col-md-6" style="padding-left: 0;">
        <h5 style="padding: 5px; background-color: rgba(234, 167, 15, 0.73);"><?= $order->delivery_time ?></h5>
      </div>
    </div>
    <div class="row dropdown-row">
      <div class="dropdown col-md-6 text-center">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> View Items </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <table class="table dropdown-item">
            <thead>
              <tr class="thead-dark">
                <th>Item</th>
                <th>Qty</th>
              </tr>
            </thead>
            <tbody>
              <?php $items = json_decode($order->items, true) ?>

              <?php foreach ($items as $item_id => $qty) : ?>
                <tr>
                  <td><?= $item_id ?></td>
                  <td><?= $qty ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-6 text-center ">
        <p><?= $order->total_price ?> LKR</p>
      </div>
    </div>
    <div class="row" style="height: auto;">
      <div class="col-md-6 text-center">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 80%; width: auto;"> View Notes </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
          <div class="overflow-auto dropdown-item" rows="" style="width: auto;"><?= $order->notes ?></div>
        </div>
      </div>

      <div class=" col-md-6 text-center">
        <a class="btn btn-warning" style="width: auto; height: 90%; " href="<?= SROOT . 'order/complete_order/' . $order->id ?>">Deliver Order </a>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

public static function create_all_order_cards_list($pending_orders, $accepted_orders)
{
  $html = '<div class="row"><div class="col " >';
  if (isset($pending_orders) && !empty($pending_orders)) {
    $html .= '<h3> New Orders... </h3><div style="height:30rem; overflow-y:scroll;" id="pending_orders_container">';
    foreach ($pending_orders as $order) {
      $html .= self::create_pending_order_card($order);
    }
    $html .= '</div>';
  } else {
    $html .= '<h5>No New Orders</h5>';
  }
  $html .= '</div>';
  $html .= '<div class="col" >';
  if (isset($accepted_orders) && !empty($accepted_orders)) {
    $html .= '<h3> Accepted Orders... </h3>
    <div style="height:30rem; overflow-y:scroll;" id="accepted_orders_container">';
    foreach ($accepted_orders as $order) {
      $html .= self::create_accepted_order_card($order);
    }
    $html .= '</div>';
  } else {
    $html .= '<h5>No Accepted Orders</h5>';
  }
  $html .= '</div></div>';
  return $html;
}

public static function create_pending_order_card_for_customer($order)
{
  ob_start(); ?>

  <div class="order-card px-3">
    <div class="pt-3 p-1 m-1" style="background-color: #9d2525; color: #FFFFFF;">
      <h6>Order code</h6>
      <h5><?= $order->order_code ?></h5>
    </div>
    <div class="pt-3 p-1 m-1" style="background-color: rgba(234, 167, 15, 0.73);">
      <h6>Delivery time</h6>
      <h5><?= $order->delivery_time ?></h5>
    </div>

    <div class="text-center p-2 pt-4 pb-0">
      <p>Restaurant: <?= $order->restaurant_name ?></p>
    </div>

    <div class="text-center p-2 pb-0">
      <p>Total: <?= $order->total_price ?> LKR</p>
    </div>

    <div class="row mb-5">
      <div class="col-md-12 text-center">
        <?php if ($order->accepted == 0 && $order->rejected == 0) : ?>
          <label class="btn" style="background-color:black; color:white;">Pending <i class="fa fa-circle-o-notch fa-spin"></i></label>
        <?php elseif ($order->accepted == 1) : ?>
          <label class="btn btn-success" style="background-color:green; color:white;">Accepted <i class="fa fa-check"></i></label>
        <?php elseif ($order->rejected == 1) : ?>
          <label class="btn" style="background-color:red; color:white;">Rejected <i class="fa fa-ban"></i></label>
        <?php endif ?>
      </div>
    </div>
    <div class="row mb-2">
      <div class="col-md-6 text-left">
        <button onclick="viewOrderReceipt(<?=$order->id?>)" class="btn btn-info">View info</button>
      </div>
      <div class="col-md-6 text-right">
        <a class="btn btn-danger" href="<?= SROOT ?>order/cancel_pending_order/<?= $order->id ?>">Cancel</a>
      </div>
    </div>


  </div>
  <?php
  return ob_get_clean();
}


public static function create_restaurant_card_list($restaurants)
{
  if (empty($restaurants)) {
    return '';
  }
  $html = '<div class="grid">';
  foreach ($restaurants as $restaurant) {
    $html .= self::create_restaurant_card($restaurant);
  }
  $html .= '</div>';
  return $html;
}

public static function create_restaurant_card($restaurant)
{
  ob_start() ?>
  <div class="restaurant-card">
    <div class="row">
      <div class="col-md-6">
        <h4 style="background-color: #9d2525; color: #FFFFFF; padding: 5px;"><?= $restaurant->restaurant_name ?></h4>
      </div>
      <div class="col-md-6">
        <h4 style="padding: 5px; background-color: rgba(234, 167, 15, 0.73);"><i class="fa fa-phone" style="color:#9D2525"></i> <?= $restaurant->telephone ?></h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div>
          <div id="carousel<?= $restaurant->id ?>" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carousel1" data-slide-to="0" class="active"></li>
              <li data-target="#carousel1" data-slide-to="1"></li>
              <li data-target="#carousel1" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" style="height: 15rem;">
              <div class="carousel-item active">
                <img class="d-block w-100" src="<?= $restaurant->image_url ?>" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="http://pinegrow.com/placeholders/img15.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="http://pinegrow.com/placeholders/img16.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carousel<?= $restaurant->id ?>" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
            <a class="carousel-control-next" href="#carousel<?= $restaurant->id ?>" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
          </div>
        </div>
      </div>
      <div class="col-md-6" style="padding: 0px 52px 0 33px;">
        <div class="row" style="padding-left: 16px;">
          <address><strong><?= $restaurant->restaurant_name ?>,</strong><br><?= $restaurant->address ?> <br><a href=""><?= $restaurant->email ?></a></address>
        </div>
        <div class="row" style="margin-top: -10px;">
          <div class="col-md-10">
            <div class="card-group">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Card title</h6>
                  <p class="card-text">Price</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">Rating</small>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Card title</h6>
                  <p class="card-text">Price</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">Rating</small>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Card title</h6>
                  <p class="card-text">Price</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">Rating</small>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <a style="font-size: 70px;" href="<?= SROOT . 'restaurant/details/' . $restaurant->id ?>"><span aria-hidden="true">&raquo;</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

public static function create_receipt($order)
{
  ob_start() ?>
  <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
      <address>
        <strong><?= $order->restaurant->restaurant_name ?></strong>
        <br>
        <?= $order->restaurant->address ?>
        <br>
        <?= $order->restaurant->telephone ?>
      </address>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
      <p>
        <em id="receipt-date">Date: <?= date("Y/m/d") ?> </em>
      </p>

    </div>
  </div>
  <div class="row">
    <div class="text-center">
      <h1>Receipt</h1>
    </div>
    </span>
    <table class="table table-hover">
      <thead>
        <tr>
          <th style="width:50%;">Item</th>
          <th style="width:10%;">Qty</th>
          <th class="text-center" style="width:30%;">Price</th>
          <th class="text-center" style="width:30%;">Total</th>
        </tr>
      </thead>
      <tbody>
        <!-- <?php $order->total = 0 ?> -->

        <?php foreach ($order->items as $item) : ?>
          <?php $order->total += ($item->quantity * $item->price) ?>
          <tr>
            <td><em><?= $item->item_name ?></em></h4>
            </td>
            <td style="text-align: center"> <?= $item->quantity ?> </td>
            <td class=" text-center"><?= $item->price . " LKR" ?></td>
            <td class=" text-center" id="receipt-subtotal-<?= $item->id ?>"><?= ($item->quantity * $item->price) . ' LKR' ?></td>
          </tr>

        <?php endforeach ?>

        <tr>
          <td>   </td>
          <td>   </td>
          <td class="text-right">
            <h5 style="color:black"><strong>Total: </strong></h4>
          </td>
          <td class="text-center text-danger">
            <h5 style="color:red"><strong id="receipt-total"><?= $order->total . ' LKR' ?></strong></h4>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="text-center font-weight-bold">
      <h3>Your Order Code is : <b><?=$order->order_code?></b></h3>
      <h3>Delivery Time : <b><?=$order->delivery_time?></b></h3>
    </div>


  </div>

  <?php
  return ob_get_clean();
}
}
