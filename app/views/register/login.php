<?php
use core\FH;
$token = FH::generate_token();
?>

<?php $this->set_title('Login'); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-6 col-md-offset-3 well">
    <ul class="nav nav-tabs">
        <li class="nav-link active"><a class="tablink active" onclick="open_login_view(event, 'user')">Login as User</a></li>
        <li class="nav-link"><a class="tablink" onclick="open_login_view(event,'owner')">Login as Owner</button></li>
    </ul>

    <div id="user" class="tabcontent">
        <form class="form" action="<?=SROOT?>register/login_user" method="post">
            <?=FH::csrf_input($token)?>
            <?=FH::display_errors($this->display_errors)?>
            <div class="form-group">
                <div>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email_user" class="form-control">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password_user" class="form-control">
                </div>
            </div>
            <div class="form-grup">
                <label for="remember_me">Remember Me<input type="checkbox" name="remember_me" id="remember_me_user"
                        value="true"></label>
            </div>
            <div class="form-group">
                <input type="submit" value="Login as User" class="btn btn-large btn-primary">
            </div>
            <div class="text-right">
                <a href="<?=SROOT?>register/register" class="text-primary">Register</a>
            </div>
        </form>
    </div>

    <div id="owner" class="tabcontent" style="display:none">
        <form class="form" action="<?=SROOT?>register/login_owner" method="post">
            <?=FH::csrf_input($token)?>
            <?=FH::display_errors($this->display_errors)?>
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
                <label for="remember_me">Remember Me<input type="checkbox" name="remember_me" id="remember_me_owner"
                        value="true"></label>
            </div>
            <div class="form-group">
                <input type="submit" value="Login as Owner" class="btn btn-large btn-primary">
            </div>
            <div class="text-right">
                <a href="<?=SROOT?>register/register" class="text-primary">Register</a>
            </div>
        </form>
    </div>
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