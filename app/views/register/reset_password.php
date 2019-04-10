<?php
use core\FH;

$token = FH::generate_token();
?>

<?php $this->set_title('Forgot Password'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/styles.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div id="Register_LoginDark_Background" class="login-dark">

    <form method="post" id="Login_Main_LoginBox" class="LoginBox" action="">
        <h2 class="sr-only">Owner-Login Form</h2>
        <?= FH::csrf_input($token) ?>
        <div id="Logo_Illustration" class="illustration">
            <img src="<?=SROOT?>assets/img/150monoLogoOnlyKamu.png">
        </div>
        <div class="form-group" id="Register_Password_FormGroup">
            <input class="form-control TextInput" type="password" name="password" placeholder="New Password" id="Register_Password_TextInput">
        </div>
        <div class="form-group" id="Register_ConfirmPassword_FormGroup">
            <input type="password" name="confirm" placeholder="Confirm Password" class="form-control TextInput" id="Register_ConfirmPassword_TextInput" />
        </div>
        <div class="form-group" id="Login_Button_FormGroup">
            <button class="btn btn-primary btn-block Button" type="submit" name="submit" id="Login_Button">Reset Password</button>
        </div>
    </form>

</div>
<?php $this->end(); ?> 