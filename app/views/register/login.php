<?php $this->set_title('Login'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-6 col-md-offset-3 well">
    <form class="form" action="<?=SROOT?>register/login" method="post">
        <div><?=$this->display_errors ?></div>
        <div class="form-group">
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="text" name="password" id="password" class="form-control">
            </div>
        </div>
        <div class="form-grup">
            <label for="remember_me">Remember Me<input type="checkbox" name="remember_me" id="remember_me" value="true"></label>
        </div>
        <div class="form-group">
            <input type="submit" value="login" class="btn btn-large btn-primary">
        </div>
        <div class="text-right">
            <a href="<?=SROOT?>register/register" class="text-primary">Register</a>
        </div>
    </form>
</div>
<?php $this->end(); ?>