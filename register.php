<?php
require 'user-management/db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['login'])) {
//set session variables
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

//escape all $_POST variables
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string(md5(rand(0,1000)));

// check if user with this email already exsits
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error);

if ($result->num_rows > 0){
    $_SESSION['message'] = 'User with this email already exsits';
    header("location: error.php");
}else{
    $sql = "INSERT INTO users (first_name, last_name, email, password, hash) VALUES ('$first_name', '$last_name', '$email', '$password', '$hash' )";
    
    if ($mysqli->query($sql)){
        $_SESSION['active'] = 0;
        $_SESSION['logged_in'] = true;
        $_SESSION['message'] = "Confirmation link has been sent to $email, plsese verify your account by clicking on the link";
        
        $to = $email;
        $subject = 'Account Verification' ;
        $message_body = '
        Hello '.$first_name.',
        Thank you for signing up.
        Please click this lonk to activate your account:
        http://localhost/loginsystem/verify.php?email='.$email.'&hash='.$hash;
        mail($to, $subject, $message_body);
        header('location: profile.php');

    }else{
        $_SESSION['message'] = 'Restration failed';
        header("location: error.php");
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
    <div class="login-clean">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="form-group"><input type="text" name="firstname" placeholder="First Name" class="form-control" /></div>
            <div class="form-group"><input type="text" name="lastname" placeholder="Last Name" class="form-control" /></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"><p name="email-error"></p></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><input class="form-control" type="password" name="password2" placeholder="Re-Enter Password" /></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name='register'>Log In</button></div><a href="#" class="forgot">Forgot your email or password?</a></form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/Simple-Slider1.js"></script>

    <script src="jquery-1.8.0.min.js"></script>
    //script to check whether email is used previously
    <script>
    $(document).ready(function(){
        $('[name="email"]').keyup(check_email); //use keyup,blur, or change
    });
    function check_email(){
        var email = $('[name="email"]').val();
        if (email){
        jQuery.ajax({
                type: 'POST',
                url: 'check_email.php',
                data: 'email='+ email,
                cache: false,
                success: function(response){
                    if(response == 0){
                    $('[name="email-error"]').text('available')
                    }
                    else {
                        $('[name="email-error"]').text('not available')
                        
                    }
                }
            });
        }
        else{
            $('[name="email-error"]').text('enter a valid email')
        }
    }
    </script>
</body>

</html>