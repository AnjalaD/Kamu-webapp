<?php

require 'user-management/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['login'])) {
        // require 'user-management/login.php';
        $email = $mysqli->escape_string($_POST['email']);
        $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

        if ($result->num_rows == 0){ //user dosent exist
            $_SESSION['login_error_message'] = "User with this email dosent exist!";
            // header("location: error.php");

        }else{  //user exists
            $user = $result->fetch_assoc();

            if (password_verify($_POST['password'], $user['password'])){
                $_SESSION['email'] = $user['email'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['active'] = $user['active'];

                $_SESSION['logged_in'] = true;

                $_SESSION['login_error_message'] = null;

                header("location: kamu.php");

            }else{
                $_SESSION['login_error_message'] = "You have entered a wrong password!";
                // header("location: login.php");
            }
        }
    }
}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamu_1.0</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="assets/css/dh-card-image-left-dark.css">
    <link rel="stylesheet" href="assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Pretty-Search-Form.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/Simple-Vertical-Navigation-Menu-v-10.css">
    <link rel="stylesheet" href="assets/css/Social-Icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
            <div class="container"><a class="navbar-brand" href="#">Kamu</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="#">Restaurants</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="#">Food</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="#">Saved Lists</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="#">Recent</a></li>
                    </ul><span class="navbar-text actions"> <a href="#" class="login">Log In</a><a class="btn btn-light action-button" role="button" href="#">Sign Up</a></span></div>
            </div>
        </nav>
    </div>
    <?php if( !empty($_SESSION['login_error_message'])){
         echo $_SESSION['login_error_message'];
    }
    ?>
    <div class="login-clean">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="login" id="login">Log In</button></div><a href="#" class="forgot">Forgot your email or password?</a></form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/Simple-Slider1.js"></script>

</body>

</html>