<?php
session_start();
require "user-management/status.php";
?>
<!DOCTYPE html>
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
                        <?php if(loggedIn()){
                            echo '<li class="nav-item" role="presentation"><a class="nav-link" href="#">Saved Lists</a></li>';
                            echo '<li class="nav-item" role="presentation"><a class="nav-link" href="#">Recent</a></li>';
                        }
                        ?>
                    </ul>
                    <span class="navbar-text actions">
                    <?php
                    if (!loggedIn()){
                        echo '<a href="#" class="login">Log In</a>';
                        echo '<a class="btn btn-light action-button" role="button" href="#">Sign Up</a>';
                    }
                    if (loggedIn()){
                        echo '<a class="btn btn-light action-button" role="button" href="user-management/logout.php">Sign Out</a>';
                    }
                    ?>
                    </span>
                </div>
            </div>
        </nav>
    </div>
    <form class="search-form">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div><input class="form-control" type="text" placeholder="I am looking for..">
            <div class="input-group-append"><button class="btn btn-light" type="button">Restaurant</button><button class="btn btn-light" type="button">Food</button></div>
        </div>
    </form>
    <div class="simple-slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background-image:url(https://placeholdit.imgix.net/~text?txtsize=68&amp;txt=Slideshow+Image&amp;w=1920&amp;h=500);"></div>
                <div class="swiper-slide" style="background-image:url(https://placeholdit.imgix.net/~text?txtsize=68&amp;txt=Slideshow+Image&amp;w=1920&amp;h=500);"></div>
                <div class="swiper-slide" style="background-image:url(https://placeholdit.imgix.net/~text?txtsize=68&amp;txt=Slideshow+Image&amp;w=1920&amp;h=500);"></div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
    <p>How it works?</p>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>Paragraph</p><img></div>
                <div class="col-md-4">
                    <p>Paragraph</p><img></div>
                <div class="col-md-4">
                    <p>Paragraph</p><img></div>
            </div>
        </div>
    </div>
    <div class="footer-clean">
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Services</h3>
                        <ul>
                            <li><a href="#">Web design</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Hosting</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>About</h3>
                        <ul>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Legacy</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Careers</h3>
                        <ul>
                            <li><a href="#">Job openings</a></li>
                            <li><a href="#">Employee success</a></li>
                            <li><a href="#">Benefits</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                        <p class="copyright">Company Name © 2017</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/Simple-Slider1.js"></script>
</body>

</html>