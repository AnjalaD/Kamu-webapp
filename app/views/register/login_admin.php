<?php
use core\FH;
?>

<?php $this->set_title('Login'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=SROOT?>css/styles.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div id="Login_LoginDark_Background" class="login-dark">
    <form method="post" id="Login_Main_LoginBox" class="LoginBox" action="<?=SROOT?>register/login_admin">
        <h2 class="sr-only">Login Form</h2>
        <?= FH::csrf_input() ?>
        <?= FH::display_errors($this->display_errors) ?>
        <div id="Logo_Illustration" class="illustration">
            <img src="<?=SROOT?>assets/img/150monoLogoOnlyKamu.png">
        </div>
        <div class="form-group" id="Login_Email_FormGroup">
            <input class="form-control TextInput" type="email" name="email" placeholder="Email" id="Login_Email_TextInput">
        </div>
        <div class="form-group" id="Login_Password_FormGroup">
            <input class="form-control TextInput" type="password" name="password" placeholder="Password" id="Login_Password_TextInput">
        </div>
        <div class="form-group" id="Login_Button_FormGroup">
            <button class="btn btn-primary btn-block Button" type="submit" id="Login_Button">Log In as Admin</button>
        </div>
        <a href="#" id="Login_ForgotEmail_TextLabel" class="TextLabel">Forgot your email or password?</a>
    </form>
</div>

<?php $this->end(); ?> 