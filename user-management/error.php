<?php
session_start();
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <p>
    <?php
    if (isset($_SESSION['message']) AND !empty($_SESSION['message'])):
        echo $_SESSION['message'];
    else:
        header("location: index.php ");
    endif;
    ?>
    </p>
</body>
</html>