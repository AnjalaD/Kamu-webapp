<?php
use core\FH;
?>

<?php $this->set_title('Login'); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-6 col-md-offset-3 well">

    <div id="owner">
        <form class="form" action="<?= SROOT ?>register/login_admin" method="post">
            <?= FH::csrf_input() ?>
            <?= FH::display_errors($this->display_errors) ?>
            <div class="form-group">
                <div>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email_owner" class="form-control">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password_owner" class="form-control">
                </div>
            </div>
            <div class="form-grup">
                <label for="remember_me">Remember Me<input type="checkbox" name="remember_me" id="remember_me_owner" value="true"></label>
            </div>
            <div class="form-group">
                <input type="submit" value="Login as Admin" class="btn btn-large btn-primary">
            </div>
        </form>
    </div>
</div>





<script>
    function open_login_view(evt, view) {
        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            console.log("12");
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        document.getElementById(view).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
<?php $this->end(); ?> 