<?php

require_once "user-management/status.php";
@session_start();

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
        <?php include 'inc/navbar.php' ?>
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

    <?php include 'inc/footer.php'?>

    <?php include 'inc/scripts.php'?>
    
</body>

</html>