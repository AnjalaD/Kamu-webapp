<?php
use app\models\UserModel;

$this->set_title($this->user->first_name); ?>

<?php $this->start('head'); ?>
<!-- <link rel="stylesheet" href="<?= SROOT ?>/css/croppie.css"> -->
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card bg-light p-5">
            <form id="profile_form" action="<?= SROOT ?>profile/index" method="post">
                <div id="errors"></div>
                <div>
                    <span>
                        <label for="first_name" id="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="<?= $this->user->first_name ?>" disabled>
                        <a class="btn edit">Edit</a>
                    </span>
                </div>
                <div>
                    <span>
                        <label for="last_name" id="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="<?= $this->user->last_name ?>" disabled>
                        <a class="btn edit">Edit</a>
                    </span>
                </div>
                <div>
                    <span>
                        <label for="email" id="email">Email</label>
                        <input type="text" name="email" id="email" value="<?= $this->user->email ?>" disabled>
                    </span>
                </div>
                <div>
                    <span>
                        <a class="btn" id="changePass">Change Password</a>
                    </span>
                </div>
                <div id="reset_pass" hidden>
                    <div>
                        <span>
                            <label for="current_password" id="current_password">Current Password</label>
                            <input type="text" name="current_password" id="current_password">
                        </span>
                        <div>
                            <span>
                                <label for="new_password" id="password">New Password</label>
                                <input type="text" name="password" id="new_password">
                            </span>
                        </div>
                        <div>
                            <span>
                                <label for="confirm_password" id="confirm_password">Confirm Password</label>
                                <input type="text" name="confirm_password" id="confirm_password">
                            </span>
                        </div>
                    </div>
                </div>
                <div>
                    <input id="save" type="submit" value="Save your changes" hidden>
                </div>
                <?php if (UserModel::current_user()->verified == 0) : ?>
                    <a href="register/send_verify_email">Send Account Verification Email</a>
                <?php endif ?>
            </form>
        </div>
    </div>
</div>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<!-- <script src="<?= SROOT ?>js/croppie.js"></script>
<script src="<?= SROOT ?>js/croppie-function.js"></script> -->
<script>
    var changePass = false;

    $('.edit').click(function() {
        $(this).prev('input').prop('disabled', false);
        $('#save').prop('hidden', false);
    });

    $('#changePass').click(function() {
        $('#save').prop('hidden', false);
        $(this).prop('hidden', true);
        $('#reset_pass').prop('hidden', false);
        changePass = true;
    });

    $('#profile_form').submit(function(e){
        e.preventDefault();
        var data = {
            first_name : $('input[name=first_name]').val(),
            last_name : $('input[name=last_name]').val()
        }

        if(changePass){
            data.password = $('input[name=password]').val();
            data.current_password = $('input[name=current_password]').val();
        };

        $.post(
            `${SROOT}profile/edit`,
            data,
            function(resp){
                if(resp.task){}
                else{$('#errors').html(resp.errors)}
            }
        );
        return;
    });
</script>
<?php $this->end(); ?>