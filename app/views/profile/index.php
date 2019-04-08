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
            <form action="<?= SROOT ?>profile/index" method="post"></form>
            <div>
                <span>
                    <label for="first_name" id="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="<?= $this->user->first_name ?>" disabled>
                    <button class="btn edit">Edit</button>
                </span>
            </div>
            <div>
                <span>
                    <label for="last_name" id="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="<?= $this->user->last_name ?>" disabled>
                    <button class="btn edit">Edit</button>
                </span>
            </div>
            <div>
                <span>
                    <label for="email" id="email">Email</label>
                    <input type="text" name="email" id="email" value="<?= $this->user->email ?>" disabled>
                    <button class="btn edit">Edit</button>
                </span>
            </div>
            <div>
                <span>
                    <button class="btn" id="changePass">Change Password</button>
                </span>
            </div>
            <div id="reset_pass" hidden>
                <div>
                    <span>
                        <label for="password" id="password">Current Password</label>
                        <input type="text" name="password" id="password">
                    </span>
                    <div>
                        <span>
                            <label for="new_password" id="new_password">New Password</label>
                            <input type="text" name="new_password" id="new_password">
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
            <?php if(UserModel::current_user()->verified==0) :?>
                <a href="">Send Account Verification Email</a>
            <?php endif ?>
        </div>
    </div>
</div>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<!-- <script src="<?= SROOT ?>js/croppie.js"></script>
<script src="<?= SROOT ?>js/croppie-function.js"></script> -->
<script>
    $('.edit').click(function() {
        $(this).prev('input').prop('disabled', false);
        $('#save').prop('hidden', function(i, v) {
            if (v == true) return false;
        })
    });

    $('#changePass').click(function() {
        $('#save').prop('hidden', function(i, v) {
            if (v == true) return false;
        })
        $(this).prop('hidden', true);
        $('#reset_pass').prop('hidden', false);
    });
</script>
<?php $this->end(); ?>