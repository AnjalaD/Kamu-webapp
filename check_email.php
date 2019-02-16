<?php
require 'user-management/db.php';
   

$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
    echo $result->num_rows;
?>