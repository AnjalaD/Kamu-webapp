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
            <a class="btn btn-info pull-right" onClick="">Item Added</a>
        <?php else : ?>
          <a class="btn btn-info pull-right" onClick="addToOrder(<?= $item->restaurant_id ?>, <?= $item->id ?>,this)">Add to Order</a>
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
                  <?php if($item->deleted == 1) :?>
                  <td>This item no longer exsits</td>
                  <?php else :?>
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
              <a href="<?= SROOT ?>order/remove_saved_order/<?= $order_id ?>"><button class="btn btn-danger"  >Delete</button></a>
            </div>
            <div class="col-md-6 text-center" >
              <a  href="<?= SROOT ?>order/use_saved_order/<?= $order_id ?>"><button class="btn btn-success">Use now</button></a>
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

              <?php foreach ($items as $item_id => $qty): ?>
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

              <?php foreach ($items as $item_id => $qty) :?>
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

  <div class="order-card p-5">
    <div class="row">
      <div class="col-md-6" style="padding-right: 0;">
        <h5 style="background-color: #9d2525; color: #FFFFFF; padding: 5px;"><?= $order->order_code ?></h5>
      </div>
      <div class="col-md-6" style="padding-left: 0;">
        <h5 style="padding: 5px; background-color: rgba(234, 167, 15, 0.73);"><?= $order->delivery_time ?></h5>
      </div>
    </div>

    <div class="row">

      <div class="col-md-4 text-center">
        <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> View Items </button> -->
        <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> -->
          <table class="table">
            <thead>
              <tr class="thead-dark text-left">
                <th class="col-md-10">Item</th>
                <th class="col-md-2">Qty</th>
              </tr>
            </thead>
            <tbody>
              <?php $items = json_decode($order->items, true) ?>

              <?php foreach ($items as $item_id => $qty) :?>
              <tr>
                <td class="text-left"><?= $item_id ?></td>
                <td><?= $qty ?></td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      

      <div class="col-md-4 text-center">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 80%; width: auto;"> View Notes </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
          <div class="overflow-auto dropdown-item" rows="" style="width: auto;"><?= $order->notes ?></div>
        </div>
      </div>

      <div class="col-md-4 text-center ">
          <p><?= $order->total_price ?> LKR</p>
      </div>
    </div>

    <div class="row" style="display:inline">
      <div class="text-right">
        <a class="btn btn-danger" href="<?=SROOT?>order/cancel_pending_order/<?=$order->id?>">Cancel</a> 
      </div>       
    </div> 

    

    <!-- <div class="row" style="height: auto;"> -->
      <!-- <div class="col-md-6 text-center">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 80%; width: auto;"> View Notes </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
          <div class="overflow-auto dropdown-item" rows="" style="width: auto;"><?= $order->notes ?></div>
        </div>
      </div> -->
      <!-- <div class="col-md-3 text-center">
        <a class="btn btn-light" style="background-color: #fa0404; width: auto; height: 90%; color: #ffffff;" href="<?= SROOT . 'order/reject_order/' . $order->id ?>""><small>Reject </small></a>
              </div>
              <div class=" col-md-3 text-center">
          <a class="btn btn-light" style="width: auto; height: 90%; background-color: #17f607;" href="<?= SROOT . 'order/accept_order/' . $order->id ?>">Accept </a>
      </div> -->
    <!-- </div> -->
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
  <div class="grid-item card m-1" style="border-top: 2px solid; border-left: 2px solid; border-right: 15px solid #9d2525; border-style: solid; border-bottom: 10px solid #9d2525; border-bottom-right-radius: 62px; display: grid; grid-template-columns: fit-content(50%) 3fr; grid-template-rows: 55px repeat(auto-fit, minmax(180px, 210px)); grid-template-areas: 'info info' 'gallery map'; min-width: 450px;">
    <div style="grid-area:1 / 1 / 2 / 3;" class="info">
      <h3 class="name" style="background-image: -webkit-linear-gradient(top, rgb(208, 77, 77) 78.1429%, rgb(157, 37, 37) 94.8571%);"><?=$restaurant->restaurant_name?></h3>
      <h3 class="number" style="background-color: #fbd367; text-align: right; font-size: 25px; font-family: Aclonica; background-image: -webkit-linear-gradient(top, rgb(251, 210, 101) 82.8571%, rgb(178, 141, 43) 96%);"><?=$restaurant->telephone?></h3>
    </div>
    <div style="grid-area:2 / 1 / 3 / 2;" class="gallery">
      <img class="d-block w-100" src="<?=$restaurant->image_url ?>">
    </div>
    <div style="grid-area: 2 / 2 / 3 / 3; border-bottom-right-radius: 46px; border-bottom: 1px solid; border-right: 1px solid;" class="map">
      <p class="address"><?=$restaurant->address?></p>
      <p class="email"><?=$restaurant->email?></p>
    </div>
  </div>
  <?php
  return ob_get_clean();
}


}
