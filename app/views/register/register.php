<?php
use core\FH;

$token = FH::generate_token();
?>

<?php $this->set_title('Register'); ?>

<?php $this->start('head'); ?>
<!-- <script src="<?= SROOT ?>js/register_form_validate.js"></script> -->
<link rel="stylesheet" href="<?= SROOT ?>css/styles.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div id="Register_LoginDark_Background" class="login-dark">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#user" role="tab" aria-controls="nav-home" aria-selected="true">Register as User</a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#owner" role="tab" aria-controls="nav-profile" aria-selected="false">Register as Owner</a>
    </div>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="nav-home-tab">

            <form method="post" id="Register_Main_LoginBox" class="LoginBox" action="<?= SROOT ?>register/register/user">
                <h2 class="sr-only">User-Register Form</h2>
                <?= FH::csrf_input($token) ?>
                <?= FH::display_errors($this->display_errors) ?>
                <div id="Logo_Illustration" class="illustration">
                    <img src="<?= SROOT ?>assets/img/150monoLogoOnlyKamu.png">
                </div>
                <div class="form-group" id="Register_Email_FormGroup">
                    <input class="form-control TextInput" type="email" name="email" placeholder="Email" id="Register_Email_TextInput">
                </div>
                <div class="form-group" id="Register_FirstName_FormGroup">
                    <!-- Start: #FirstName_TextInput --><input type="string" name="first_name" placeholder="First Name" class="form-control TextInput" id="Register_Firstname_TextInput" />
                    <!-- End: #FirstName_TextInput -->
                </div>
                <div class="form-group" id="Register_LastName_FormGroup">
                    <!-- Start: #LastName_TextInput --><input type="string" name="last_name" placeholder="Last Name" class="form-control TextInput" id="Register_LastName_TextInput" />
                    <!-- End: #LastName_TextInput -->
                </div>
                <div class="form-group" id="Register_Password_FormGroup">
                    <input class="form-control TextInput" type="password" name="password" placeholder="Password" id="Register_Password_TextInput">
                </div>
                <div class="form-group" id="Register_ConfirmPassword_FormGroup">
                    <!-- Start: #ConfirmPassword_TexInput --><input type="password" name="confirm" placeholder="Confirm Password" class="form-control TextInput" id="Register_ConfirmPassword_TextInput" />
                    <!-- End: #ConfirmPassword_TexInput -->
                </div>
                <div class="form-group" id="Button_FormGroup">
                    <!-- Start: #RegisterButton --><button class="btn btn-primary btn-block Button" type="submit" name="submit" value="submit" id="Register_Button">Register as User</button>
                    <!-- End: #RegisterButton -->
                </div>
            </form>

        </div>
        <div class="tab-pane fade" id="owner" role="tabpanel" aria-labelledby="nav-profile-tab">

            <form method="post" id="Register_Main_LoginBox" class="LoginBox" action="<?= SROOT ?>register/register/owner">
                <h2 class="sr-only">Owner-Register Form</h2>
                <?= FH::csrf_input($token) ?>
                <?= FH::display_errors($this->display_errors) ?>
                <div id="Logo_Illustration" class="illustration">
                    <img src="<?= SROOT ?>assets/img/150monoLogoOnlyKamu.png">
                </div>
                <div class="form-group" id="Register_Email_FormGroup">
                    <input class="form-control TextInput" type="email" name="email" placeholder="Email" id="Register_Email_TextInput">
                </div>
                <div class="form-group" id="Register_FirstName_FormGroup">
                    <!-- Start: #FirstName_TextInput --><input type="string" name="first_name" placeholder="First Name" class="form-control TextInput" id="Register_Firstname_TextInput" />
                    <!-- End: #FirstName_TextInput -->
                </div>
                <div class="form-group" id="Register_LastName_FormGroup">
                    <!-- Start: #LastName_TextInput --><input type="string" name="last_name" placeholder="Last Name" class="form-control TextInput" id="Register_LastName_TextInput" />
                    <!-- End: #LastName_TextInput -->
                </div>
                <div class="form-group" id="Register_Password_FormGroup">
                    <input class="form-control TextInput" type="password" name="password" placeholder="Password" id="Register_Password_TextInput">
                </div>
                <div class="form-group" id="Register_ConfirmPassword_FormGroup">
                    <!-- Start: #ConfirmPassword_TexInput --><input type="password" name="confirm" placeholder="Confirm Password" class="form-control TextInput" id="Register_ConfirmPassword_TextInput" />
                    <!-- End: #ConfirmPassword_TexInput -->
                </div>
                <div class="form-group" id="Button_FormGroup">
                    <!-- Start: #RegisterButton --><button class="btn btn-primary btn-block Button" type="submit" name="submit" value="submit" id="Register_Button">Register as Owner</button>
                    <!-- End: #RegisterButton -->
                </div>
            </form>

        </div>
    </div>
</div>

<?php $this->end(); ?> 