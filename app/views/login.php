<?php

require 'user-management/db.php';
require_once "user-management/status.php";
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamu_1.0</title>
    <?php include 'inc/ref.php'?>
</head>

<body>
    <div>
        <?php include 'inc/navbar.php'?>
    </div>

    <?php  if(!empty($data['login_error'])) echo $data['login_error'] ?>
    <div class="login-clean">
        <form method="post" action="/mcv/public/account/login">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="login" id="login">Log In</button></div>
            <a href="/mcv/public/page/forgot" class="forgot">Forgot your email or password?</a></form>
    </div>

    <?php include 'inc/footer.php'?>

    <?php include 'inc/scripts.php'?>

</body>

</html>