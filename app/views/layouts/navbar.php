<?php
use core\Router;
use core\H;
use app\models\UserModel;

$menu = Router::get_menu('menu_acl');
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
                <?=H::build_menu($menu)?>
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