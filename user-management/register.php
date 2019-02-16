<?php

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

?>