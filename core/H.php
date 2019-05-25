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
    <div class="grid-item card block span3 m-1">
      <div class="product">
        <img src=<?= $item->image_url ?>>
      </div>
      <div class="info">
        <h4><?= $item->item_name ?></h4>
        <span class="restaurant_name">
          <a class="link" href="<?= SROOT ?>restaurant/details/<?= $item->restaurant_id ?>"><?= $item->restaurant_name ?></a>
        </span>
        <span class="description"><?= $item->description ?></span>
        <div id="tags">
        <?php if($item->tags) :?>
          <?php foreach($item->tags as $tag) :?>
            <button class="tag btn btn-sm " style="border-color:black;" id="<?=$tag?>"> <?=$tag?> </button>
          <?php endforeach ?>
        <?php endif ?>
        </div>
        <span class="price">LKR.<?= $item->price ?></span>
        <br>
        <i class="icon-shopping-cart icon-2x"></i>
        <?php if (Session::exists('items')) : ?>
          <?php if (array_key_exists($item->id, json_decode(Session::get('items'), true)['items'])) : ?>
            <a class="btn btn-info pull-right" onClick="">Item Added</a>
          <?php else : ?>
            <a class="btn btn-info pull-right" onClick="addToOrder(<?= $item->restaurant_id ?>, <?= $item->id ?>,this)">Add to Order</a>

          <?php endif ?>
        <?php else : ?>
          <a class="btn btn-info pull-right" onClick="addToOrder(<?= $item->restaurant_id ?>, <?= $item->id ?>,this)">Add to Order</a>
        <?php endif ?>
      </div>
      <div class="details">
        <span>Rating : </span>
        <span id="rating"><?= $item->rating.'('.$item->rating_num.')'?></span>
        <br>
        <span class="rating" id="<?= $item->id?>" >
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

  public static function create_order_dropdown($item_list, $order_id){
    ob_start();
    foreach($item_list as $item) : ?>
      <li><?=$item->item_name.'-x'.$item->quantity?></li>
    <?php endforeach ?>
    <li>
      <a class="btn btn-primary" href="<?=SROOT?>order/use_saved_order/<?=$order_id?>">Use</a>
      <a class="btn btn-danger" href="<?=SROOT?>order/remove_saved_order/<?=$order_id?>">Remove</a>
    </li>
    <?php
    return ob_get_clean();
  }

  public static function create_pagination_tabs($page_no, $end=false)
  {
    ob_start(); ?>
    <?php if($end) : ?>
    <span>End of Results</span>
    <?php endif ?>
    <nav>
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="#" onclick="goToPage(0)">First</a></li>
      <?php if($page_no > 0) :?>
      <li class="page-item"><a class="page-link" href="#" onclick="goToPage(<?=$page_no-1?>)"><?=$page_no?></a></li>
      <?php endif ?>
      <li class="page-item active"><a class="page-link" href="#" onclick="goToPage(<?=$page_no?>)"><?=$page_no+1?></a></li>
      <?php if(!$end) :?>
      <li class="page-item"><a class="page-link" href="#" onclick="goToPage(<?=$page_no+1?>)"><?=$page_no+2?></a></li>
      <?php endif ?>
    </ul>
    </nav>
    <?php
    return ob_get_clean();
  }
}
