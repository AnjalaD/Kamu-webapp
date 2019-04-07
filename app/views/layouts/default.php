<?php
use core\Session;
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?= SROOT ?>assets/img/kamu_icon.ico" />
    <title><?= $this->get_title() ?> </title>
    <!-- Bootstrap CSS -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= SROOT ?>assets/fonts/font-awesome.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= SROOT ?>assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lancelot">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

    <?= $this->content('head') ?>
</head>

<body style="opacity:0;">
    <?php include 'navbar.php' ?>
    <?= Session::display_msgs() ?>
    <?= $this->content('body') ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- js configurations -->
    <script src="<?= SROOT ?>js/config.js"></script>

    <!-- smooth transitions -->
    
    <script>
        // page loading
        $(document).ready(function() {
            // to fade in on page load
            // $("body").css("display", "");
            // $("body").fadeIn(800);
            // $("body").css("display", "");
            $("body").animate({opacity:1},500);        
            
        })
        // page exiting
        $(window).bind('beforeunload',function(){
            $("body").fadeOut(500);

        })
    </script>
    <?= $this->content('script') ?>
</body>

</html>