<?php
use core\FH;

$token = FH::generate_token();
?>

<?php $this->set_title('Login'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/styles.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div id="Register_LoginDark_Background" class="login-dark">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#user" role="tab" aria-controls="nav-home" aria-selected="true">Login as User</a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#owner" role="tab" aria-controls="nav-profile" aria-selected="false">Login as Owner</a>
    </div>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="nav-home-tab">

        <form method="post" id="Login_Main_LoginBox" class="LoginBox" action="<?=SROOT?>register/login/user">
        <h2 class="sr-only">User-Login Form</h2>
        <?= FH::csrf_input($token) ?>
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
        <div>
            <label for="remember_me">Remember Me</label>
            <input type="checkbox" name="remember_me" id="remember_me" value="true">
        </diV>
        <div class="form-group" id="Login_Button_FormGroup">
            <button class="btn btn-primary btn-block Button" type="submit" name="submit" id="Login_Button">Log In as User</button>
        </div>
        <a href="<?=SROOT?>register/forgot/customer" id="Login_ForgotEmail_TextLabel" class="TextLabel">Forgot your email or password?</a>
    </form>

        </div>
        <div class="tab-pane fade" id="owner" role="tabpanel" aria-labelledby="nav-profile-tab">

        <form method="post" id="Login_Main_LoginBox" class="LoginBox" action="<?=SROOT?>register/login/owner">
        <h2 class="sr-only">Owner-Login Form</h2>
        <?= FH::csrf_input($token) ?>
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
        <div>
            <label for="remember_me">Remember Me</label>
            <input type="checkbox" name="remember_me" id="remember_me" value="true">
        </diV>
        <div class="form-group" id="Login_Button_FormGroup">
            <button class="btn btn-primary btn-block Button" type="submit" name="submit" id="Login_Button">Log In as Owner</button>
        </div>
        <a href="<?=SROOT?>register/forgot/owner" id="Login_ForgotEmail_TextLabel" class="TextLabel">Forgot your email or password?</a>
    </form>

        </div>
    </div>
</div>

<?php $this->end(); ?> 