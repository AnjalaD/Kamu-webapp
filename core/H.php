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
      if ($image && file_put_contents('..' . $path, $image)) {
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
  $html = '<div class="card-columns">';
  foreach ($items as $item) {
    $html .= self::create_card($item);
  }
  $html .= '</div>';
  return $html;
}

private static function create_card($item)
{
  ob_start() ?>
  <div class="card block span3">
    <div class="product">
      <img src=<?= $item->image_url ?>>
    </div>
    <div class="info">
      <h4><?= $item->item_name ?></h4>
      <span class="restaurant_name">
        <a class="link" href="<?= SROOT ?>restaurant/details/<?= $item->restaurant_id ?>"><?= $item->restaurant_name ?></a>
      </span>
      <span class="description"><?= $item->description ?></span>
      <p>
        <?php if ($item->tags) : ?>
          <?php foreach ($item->tags as $tag) : ?>
            <a href="<?= SROOT ?>search/search_by_tag/<?= $tag ?>"> <?= $tag ?> </a>
          <?php endforeach ?>
        <?php endif ?>
      </p>
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
      <span class="rating pull-right">
        <span class="star"></span>
        <span class="star"></span>
        <span class="star"></span>
        <span class="star"></span>
        <span class="star"></span>
      </span>
    </div>
  </div>
  <?php
  return ob_get_clean();
}
}
