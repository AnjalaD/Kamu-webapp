<?php
session_start();
require_once "user-management/status.php";
?>

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
    <div class="login-clean">
        <form method="post" action="/mcv/public/account/signup">
            <h2 class="sr-only">Sign Up Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="form-group"><input type="text" name="firstname" placeholder="First Name" class="form-control" /></div>
            <div class="form-group"><input type="text" name="lastname" placeholder="Last Name" class="form-control" /></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><input class="form-control" type="password" name="password2" placeholder="Re-Enter Password" /></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="signup">Sign Up</button></div>
            <a href="/mcv/public/page/forgot" class="forgot">Forgot your email or password?</a></form>
    </div>

    <?php include 'inc/footer.php'?>

    <?php include 'inc/scripts.php'?>
    
</body>

</html>