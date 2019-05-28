<?php
use app\models\UserModel;
use core\FH;

$token = FH::generate_token();

$this->set_title($this->user->first_name); ?>

<?php $this->start('head'); ?>
<!-- <link rel="stylesheet" href="<?= SROOT ?>/css/croppie.css"> -->
<link rel="stylesheet" href="<?= SROOT ?>css/Profile-Edit-Form-1.css">
<link rel="stylesheet" href="<?= SROOT ?>css/Profile.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="Profile_body" style="background-image: url(&quot;<?=SROOT?>assets/img/profile_background.jpg&quot;);background-size:cover; background-repeat:no-repeat; padding-bottom:2rem; ">
    <div class="container profile profile-view" id="profile" style="margin:0px auto auto auto;">
        <form id="Profile_form" style="background-color: rgba(255,255,255,0);">
            <div class="form-row profile-row" id="Profile_row">
                <div class="col-md-4 relative" id="Profile_coloumndp" style="border-width:0px 0px 9px 0px; border-color:#9d2525; border-style:ridge;">
                    <div class="avatar">
                        <div class="avatar-bg center"></div>
                    </div><input type="file" id="Profile_fileInput" class="form-control" name="avatar-file">
                    <?php if (UserModel::current_user()->verified == 0) : ?>
            <a href="register/send_verify_email" style="position:relative; bottom:-100px; left:0.5rem;"><button style="color:#9d2525; background-color:rgba(0,0,0,0); border:none; font-family:Aclonica"> Account Verification E Email</button></a>
        <?php endif ?>
                </div>
                <div class="col-md-8" id="Profile_coloumninfo" style="border-width:0px 5px 9px 0px; border-color:#9d2525; border-style:ridge;">
                    <h1 id="Profile_Heading">Profile </h1>
                    <hr class="Profile_hr">
                    <div id="errors"></div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6 Profile" id="Profile_colFirstName">
                            <div class="form-group" >
                                <label class="Profile_Label">Firstname </label>
                                <div class="input-group m-0">
                                    <input class="form-control" type="text" name="first_name" value="<?= $this->user->first_name ?>" disabled>
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
                                    <input class="form-control" type="text" name="last_name" value="<?= $this->user->last_name ?>" disabled>
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
                        <button class="btn btn-primary form-btn m-0" id="changePass" style="font-family:Aclonica;">Change Password</button>
                    </div>
                    
                    <div class="form-row" id="reset_pass" hidden>
                        <div class="col-sm-12 col-md-12 Profile" id="Profile_colCurntPassword" style="background-color:rgba(255,255,255,0);">
                            <div class="form-group">
                                <label class="Profile_Label">Current Password</label>
                                <input class="form-control" type="password" name="current_password" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 Profile" id="Profile_colPassword" style="background-color:rgba(255,255,255,0);">
                            <div class="form-group">
                                <label class="Profile_Label">New Password </label>
                                <input class="form-control" type="password" name="password" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 Profile" id="Profile_colCnfmPassword" style="background-color:rgba(255,255,255,0);">
                            <div class="form-group"><label class="Profile_Label">Confirm Password</label>
                                <input class="form-control" type="password" name="confirm" autocomplete="off"></div>
                        </div>
                    </div>
                    <hr class="Profile_hr">
                    <div class="form-row" id="buttons" hidden >
                        <div class="col-md-12 content-right" style="background-color:rgba(255,255,255,0);">
                            <button class="btn btn-primary form-btn" type="submit" id="save" style="font-family:Aclonica;">SAVE </button>
                            <button class="btn btn-danger form-btn" type="reset" id="cancel" style=" font-family:Aclonica; color: #ffffff;background-color: #dc3545;filter: blur(0px) brightness(104%) invert(0%) sepia(0%);" onclick="location.reload()" >CANCEL </button>
                        </div>
                    </div>
                   
                </div>
                
            </div>
            
        </form>
        
    </div>
</div>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<!-- <script src="<?= SROOT ?>js/croppie.js"></script>
<script src="<?= SROOT ?>js/croppie-function.js"></script> -->
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
        $('#reset_pass').find('input').each(function(i, block) {
            // console.log(block);
            $(block).attr('required', '');
        });
    });

    $('#Profile_form').submit(function(e) {
        e.preventDefault();
        var data = {
            csrf_token: '<?=$token?>',
            first_name: $('input[name=first_name]').val(),
            last_name: $('input[name=last_name]').val(),
            change_pass: changePass
        }
        
        if (changePass) {
            data.password = $('input[name=password]').val();
            data.confirm = $('input[name=confirm]').val();
            data.current_password = $('input[name=current_password]').val();
        };

        $.post(
            `${SROOT}profile/edit`,
            data,
            function(resp) {
                if (resp.task) {
                    location.reload();
                } else {
                    $('#errors').html(resp.errors)
                }
            }
        );
        return;
    });
</script>
<?php $this->end(); ?>