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

    <form method="post" id="Login_Main_LoginBox" class="LoginBox" action=<?php $this->post_action ?>>
        <h2 class="sr-only">Owner-Login Form</h2>
        <?= FH::csrf_input($token) ?>
        <div id="Logo_Illustration" class="illustration">
            <img src="<?=SROOT?>assets/img/150monoLogoOnlyKamu.png">
        </div>
        <div class="form-group" id="Login_Email_FormGroup">
            <input class="form-control TextInput" type="email" name="email" placeholder="Email" id="Login_Email_TextInput">
        </div>
        <div class="form-group" id="Login_Button_FormGroup">
            <button class="btn btn-primary btn-block Button" type="submit" name="submit" id="Login_Button">Send Reset Link</button>
        </div>
    </form>

</div>
<?php $this->end(); ?> 