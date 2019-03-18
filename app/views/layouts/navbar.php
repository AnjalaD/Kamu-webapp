<?php
use core\Router;
use core\H;
use app\models\UserModel;

$menu = Router::get_menu('menu_acl');
$current_page = H::current_page();
?>
<link rel="stylesheet" href="<?=SROOT?>css/homestyles.min.css">
<nav class="navbar navbar-light navbar-expand-md navigation-clean-button" id="NavigationBar">
    <div class="container">
        <a class="navbar-brand" href="<?= SROOT ?>"><img src="<?= SROOT ?>assets/img/blacklogokamu200.png" alt="<?= BRAND_NAME ?>" id="Home_NavBar_Logo" class="NavBarLogo"></a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#Home_NavBar_Row">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse NavBar_Row" id="Home_NavBar_Row">

            <ul class="nav navbar-nav mr-auto" style="font-family:Montserrat, sans-serif;">
                <?php foreach ($menu as $key => $value) :
                    $active = ''; ?>
                <?php if (is_array($value)) : ?>
                <li class="nav-item dropdown">
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                        <?= $key ?>
                    </a>
                    <div class="dropdown-menu" role="menu">
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
                <?php endforeach ?>
            </ul>

            <span class="navbar-item text-right">
                <?php if (UserModel::current_user()) : ?>
                <a href="">Hello
                    <?= UserModel::current_user()->first_name ?></a>
                <?php endif ?>
            </span>
        </div>
    </div>
</nav> 