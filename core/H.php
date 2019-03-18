<?php
namespace core;

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
      if ($image && file_put_contents('..'.$path, $image)) {
        return $path;
      }
    }
    return DEFUALT_ITEM_IMAGE;
  }

  public static function buildMenuListItems($menu, $dropdownClass = "")
  {
    ob_start();
    $currentPage = self::currentPage();
    foreach ($menu as $key => $val) :
      $active = '';
      if ($key == '%USERNAME%') {
        $key = (Users::currentUser()) ? "Hello " . Users::currentUser()->fname : $key;
      }
      if (is_array($val)) : ?>
<li class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $key ?></a>
    <div class="dropdown-menu <?= $dropdownClass ?>">
        <?php foreach ($val as $k => $v) :
          $active = ($v == $currentPage) ? 'active' : ''; ?>
        <?php if (substr($k, 0, 9) == 'separator') : ?>
        <div role="separator" class="dropdown-divider"></div>
        <?php else : ?>
        <a class="dropdown-item <?= $active ?>" href="<?= $v ?>"><?= $k ?></a>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</li>
<?php else :
  $active = ($val == $currentPage) ? 'active' : ''; ?>
<li class="nav-item"><a class="nav-link <?= $active ?>" href="<?= $val ?>"><?= $key ?></a></li>
<?php endif; ?>
<?php endforeach;
return ob_get_clean();
}
}
