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

<div id="Login_LoginDark_Background" class="login-dark">
<div id="Login_Main_LoginBox" class="LoginBox">


    <!-- <form id="Login_Main_LoginBox" class="LoginBox" method="post" action="<?= SROOT ?>register/login_owner">
        <h2 class="sr-only">Login Form</h2>
        <?= FH::csrf_input($token) ?>
        <?= FH::display_errors($this->display_errors) ?>
        <div id="Logo_Illustration" class="illustration">
            <img src="<?= SROOT ?>assets/img/150monoLogoOnlyKamu.png">
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
        <a href="<?= SROOT ?>register/forgot/admin" id="Login_ForgotEmail_TextLabel" class="TextLabel">Forgot your email or password?</a>
    </form> -->

    <form id="Login_Main_LoginBox" class="LoginBox" method="post" action="<?= SROOT ?>register/login_owner/owner">
        <h2 class="sr-only">Login Form</h2>
        <?= FH::csrf_input($token) ?>
        <?= FH::display_errors($this->display_errors) ?>
        <div id="Logo_Illustration" class="illustration">
            <img src="<?= SROOT ?>assets/img/150monoLogoOnlyKamu.png">
        </div>
        <div class="row d-flex justify-content-center" style="margin-bottom:3%;">
            <div class="custom-control custom-switch ">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked="true">
                <label class="custom-control-label" for="customSwitch1" id="switch-label" style="color:#9D2525; font-family:Aclonica;">Owner</label>
            </div>
        </div>
        <div class="form-group" id="Login_Email_FormGroup">
            <input class="form-control TextInput" type="email" name="email" placeholder="Email" id="Login_Email_TextInput">
        </div>
        <div class="form-group" id="Login_Password_FormGroup">
            <input class="form-control TextInput" type="password" name="password" placeholder="Password" id="Login_Password_TextInput">
        </div>
        <div>
            <label for="remember_me" style="color:black">Remember Me</label>
            <input type="checkbox" name="remember_me" id="remember_me" value="true">
        </diV>
        <div class="form-group" id="Login_Button_FormGroup">
            <button class="btn btn-primary btn-block Button" type="submit" name="submit" id="Login_Button">Log In as Owner</button>
        </div>
        <a href="<?= SROOT ?>register/forgot/owner" id="Login_ForgotEmail_TextLabel" class="TextLabel">Forgot your email or password?</a>
    </form>


</div>



</div>
</div>

<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script type="text/javascript">
$('input[id=customSwitch1]').change(function(){
    var value = (this).checked;
    console.log(value);
    if(value==true){
        $("#Login_Button").html("Login as Owner");
        $("#Login_Main_LoginBox").attr('action', "<?= SROOT ?>register/login_owner/owner");
        $("#Login_ForgotEmail_TextLabel").attr('href',"<?= SROOT ?>register/forgot/owner");
        $("#switch-label").attr('style','color: #9D2525; font-family:Aclonica;');

    }else{
        $("#Login_Button").html("Login as Cashier");
        $("#Login_Main_LoginBox").attr('action', "<?= SROOT ?>register/login_owner/cashier");
        $("#Login_ForgotEmail_TextLabel").attr('href',"<?= SROOT ?>register/forgot/cashier");
        $("#switch-label").attr('style','color: #888888; font-family:Aclonica;');
    }
    
});
</script>
<?php $this->end(); ?>
