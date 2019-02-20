<?php

class UserData extends Database
{
    public function check_login($email, $password)
    {
        $email = $this->sqli()->escape_string($_POST['email']);
        $result = $this->sqli()->query("SELECT * FROM users WHERE email='$email'");

        if ($result->num_rows == 0)
        { //user dosent exist
            return null;

        }else
        {  //user exists
            $user_data = $result->fetch_assoc();

            if (password_verify($_POST['password'], $user_data['password']))
            {
                return $user_data;
            }else
            {
                return null;
            }
        }
    }

    public function create_account($email, $first_name, $last_name, $password)
    {
        $first_name = $this->sqli()->escape_string($first_name);
        $last_name = $this->sqli()->escape_string($last_name);
        $email = $this->sqli()->escape_string($email);
        $password = $this->sqli()->escape_string(password_hash($password, PASSWORD_BCRYPT));
        $hash = $this->sqli()->escape_string(md5(rand(0,1000)));

        $result = $this->sqli()->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error);

        if ($result->num_rows > 0)
        {
            // $_SESSION['message'] = 'User with this email already exsits';
            return false;
        }else{
            $sql = "INSERT INTO users (first_name, last_name, email, password, hash) VALUES ('$first_name', '$last_name', '$email', '$password', '$hash' )";
            
            if ($this->sqli()->query($sql)){
                @session_start();
                $_SESSION['active'] = 0;
                $_SESSION['logged_in'] = true;
                $_SESSION['verify_message'] = "Confirmation link has been sent to $email, plsese verify your account by clicking on the link";
                
                $to = $email;
                $subject = 'Account Verification' ;
                $message_body = '
                Hello '.$first_name.',
                Thank you for signing up.
                Please click this lonk to activate your account:
                http://localhost/mcv/public/account/verify/'.$email.'/'.$hash;
                mail($to, $subject, $message_body);
                
                return true;
        
            }else{
                // $_SESSION['message'] = 'Restration failed';
                return false;
            }
        }
    }

    public function verify($email, $hash){
        if(isset($email) && !empty($email) AND isset($hash) && !empty($hash)){
            $email = $this->sqli()->escape_string($email);
            $hash = $this->sqli()->escape_string($hash);
        
            $result = $this->sqli()->query("SELECT * FROM users WHERE email='$email' AND hash='$hash' AND active='0'");
        
            if ($result->num_rows == 0){
                $_SESSION['message'] = "Account has already activated or the URL is invalid!";
                 
                return false;
                 
            }else{
                $_SESSION = "Your account has been activated";
                $this->sqli()->query("UPDATE users SET active='1' WHERE email='$email'") or die($mysqli->error);
                 
                return true;
            }
        
        }else{
            $_SESSION['message'] = "Invalid parameters provided for account verification!";
            return false;
        }
    }

    public function forgot($email){
        $email = $this->sqli()->escape_string($_POST['email']);
        $result = $this->sqli()->query("SELECT * FROM users WHERE email='$email'");
        
        if ($result->num_rows == 0 ){
            //$_SESSION['message'] = "User with that email dosen't exixts";
            return false;
        
        }else{
            $user = $result->fetch_assoc();
        
            $email = $user['email'];
            $hash = $user['hash'];
            $first_name = $user['first_name']; 
                
            //$_SESSION['message'] = "Please check your email to rest passward";
        
            $to = $email;
            $subject = 'Account Verification' ;
            $message_body = '
            Hello '.$first_name.',
            You have requested password reset.
            Please click this lonk to reset your password:
            http://localhost/mcv/account/reset/'.$email.'/'.$hash;
            mail($to, $subject, $message_body);

            return true;
        }
    }

    public function reset($email, $hash)
    {
        $email = $this->sqli()->escape_string($email);
        $hash = $this->sqli()->escape_string($hash);
        
        $result = $this->sqli()->query("SELECT * FROM users WHERE email='$email' AND hash='$hash'");
        
        if ($result->num_rows == 0){ //if no record found
                // $_SESSION['message'] = "You have entered invalid URL for password reset!";
                return false;
        }
        return true;
    }

    public function rest_password($new_password)
    {
        $new_password = password_hash($new_password, PASSWORD_BCRYPT);
        $hash = $this->sqli()->escape_string(md5(rand(0,1000)));

        $sql = "UPDATE users SET password='$new_password', hash='$hash' WHERE email='$email'";

        if ($this->sqli()->query($sql))
        {
            // $_SESSION['message'] = "Your password has been reset successfully!";
            return true;

        }else{
            // $_SESSION['message'] = "Try again";
            return false;
        }
    }


    
}