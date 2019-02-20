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
    <?php 
    if(!empty($data['success'])) echo $data['success'];
    if(!empty($data['error'])) echo $data['error'];
    ?>

    <?php include 'inc/footer.php'?>

    <?php include 'inc/scripts.php'?>
    
</body>

</html>