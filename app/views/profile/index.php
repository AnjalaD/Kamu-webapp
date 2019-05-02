<?php
use app\models\UserModel;

$this->set_title($this->user->first_name); ?>

<?php $this->start('head'); ?>
<!-- <link rel="stylesheet" href="<?= SROOT ?>/css/croppie.css"> -->
<link rel="stylesheet" href="<?= SROOT ?>css/Profile-Edit-Form-1.css">
<link rel="stylesheet" href="<?= SROOT ?>css/Profile.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="Profile_body" style="background-image: url(&quot;<?=SROOT?>assets/img/profile_background.jpg&quot;);">
    <div class="container profile profile-view" id="profile">
        <div class="row">
            <div class="col-md-12 alert-col relative">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
            </div>
        </div>
        <form id="Profile_form" style="background-color: rgba(255,255,255,0.39);">
            <div class="form-row profile-row" id="Profile_row">
                <div class="col-md-4 relative" id="Profile_coloumndp">
                    <div class="avatar">
                        <div class="avatar-bg center"></div>
                    </div><input type="file" id="Profile_fileInput" class="form-control" name="avatar-file">
                </div>
                <div class="col-md-8" id="Profile_coloumninfo">
                    <h1 id="Profile_Heading">Profile </h1>
                    <hr class="Profile_hr">
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6 Profile" id="Profile_colFirstName">
                            <div class="form-group">
                                <label class="Profile_Label">Firstname </label>
                                <div class="input-group m-0">
                                    <input class="form-control" type="text" name="firstname" value="<?= $this->user->first_name ?>" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text edit">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 Profile" id="Profile_colLastName">
                            <div class="form-group">
                                <label class="Profile_Label">Lastname </label>
                                <div class="input-group m-0">
                                    <input class="form-control" type="text" name="lastname" value="<?= $this->user->last_name ?>" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text edit">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="Profile_Label">Email </label>
                        <input class="form-control" type="email" autocomplete="off" required name="email" value="<?= $this->user->email ?>" disabled>
                    </div>

                    <hr class="Profile_hr">

                    <div>
                        <button class="btn btn-primary form-btn m-0" id="changePass">Change Password</button>
                    </div>
                    
                    <div class="form-row" id="reset_pass" hidden>
                        <div class="col-sm-12 col-md-12 Profile" id="Profile_colCurntPassword">
                            <div class="form-group">
                                <label class="Profile_Label">Current Password</label>
                                <input class="form-control" type="password" name="current_password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 Profile" id="Profile_colPassword">
                            <div class="form-group">
                                <label class="Profile_Label">New Password </label>
                                <input class="form-control" type="password" name="password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 Profile" id="Profile_colCnfmPassword">
                            <div class="form-group"><label class="Profile_Label">Confirm Password</label>
                                <input class="form-control" type="password" name="confirm" autocomplete="off" required></div>
                        </div>
                    </div>
                    <hr class="Profile_hr">
                    <div class="form-row" id="buttons" hidden>
                        <div class="col-md-12 content-right">
                            <button class="btn btn-primary form-btn" type="submit" id="save">SAVE </button>
                            <button class="btn btn-danger form-btn" type="reset" id="cancel" style="color: #ffffff;background-color: #dc3545;filter: blur(0px) brightness(104%) invert(0%) sepia(0%);">CANCEL </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php if (UserModel::current_user()->verified == 0) : ?>
            <a href="register/send_verify_email">Send Account Verification Email</a>
        <?php endif ?>
    </div>
</div>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<!-- <script src="<?= SROOT ?>js/croppie.js"></script>
<script src="<?= SROOT ?>js/croppie-function.js"></script> -->
<script src="<?= SROOT ?>js/Profile-Edit-Form.js"></script>
<script>
    var changePass = false;

    $('.edit').click(function() {
        $(this).parent().siblings('input').prop('disabled', false);
        $('#buttons').prop('hidden', false);
    });

    $('#changePass').click(function(e) {
        e.preventDefault();
        $('#buttons').prop('hidden', false);
        $(this).prop('hidden', true);
        $('#reset_pass').prop('hidden', false);
        changePass = true;
    });

    $('#profile_form').submit(function(e) {
        e.preventDefault();
        var data = {
            first_name: $('input[name=first_name]').val(),
            last_name: $('input[name=last_name]').val()
        }

        if (changePass) {
            data.password = $('input[name=password]').val();
            data.current_password = $('input[name=current_password]').val();
        };

        $.post(
            `${SROOT}profile/edit`,
            data,
            function(resp) {
                if (resp.task) {} else {
                    $('#errors').html(resp.errors)
                }
            }
        );
        return;
    });
</script>
<?php $this->end(); ?>