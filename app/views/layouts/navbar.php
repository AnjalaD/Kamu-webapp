<?php
$menu = Router::get_menu('menu_acl');
$current_page = H::current_page();
?>

<nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
    <div class="container">
        <a class="navbar-brand" href="<?= SROOT ?>">
            <?= BRAND_NAME ?></a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav nav-tabs">
                <?php foreach ($menu as $key => $value) :
                    $active = ''; ?>
                <?php if (is_array($value)) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <?= $key ?></a>
                    <div class="dropdown-menu">
                        <?php foreach ($value as $k => $v) :
                            $active = ($v == $current_page) ? 'active' : '' ?>
                        <?php if ($k == 'separator') : ?>
                        <div class="dropdown-divider"></div>
                        <?php else : ?>
                        <a class="<dropdown-item <?= $active ?>" href="<?= $v ?>">
                            <?= $k ?></a>
                        <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </li>
                <?php else :
                $active = ($value == $current_page) ? 'active' : '' ?>
                <li class="nav-item"><a class="nav-link <?= $active ?>" href="<?= $value ?>">
                        <?= $key ?></a></li>
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