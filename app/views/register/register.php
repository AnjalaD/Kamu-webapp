<?php
use core\FH;
?>

<?php $this->set_title('Register'); ?>

<?php $this->start('head'); ?>
<script src="<?=SROOT?>js/register_form_validate.js"></script>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-6 col-md-offset-3 well">
    <form class="form" action="<?=SROOT?>register/register" method="post">
        <?=FH::csrf_input()?>
        <?=FH::display_errors($this->display_errors)?>
        <div class="form-group">
            <div>
                <label for="first_name">First name</label>
                <input 
                type="text" 
                name="first_name" 
                id="first_name" 
                class="form-control"
                required
                pattern="\w+" 
                title="must not be blank and contain only letters, numbers and underscores"
                value="<?=$this->new_user->first_name ?>">
            </div>
            <div>
                <label for="last_name">Last name</label>
                <input 
                type="text" 
                name="last_name" 
                id="last_name" 
                class="form-control" 
                required
                pattern="\w+" 
                title="must not be blank and contain only letters, numbers and underscores"
                value="<?=$this->new_user->last_name ?>">
            </div>
            <div>
                <label for="email">Email</label>
                <input 
                type="text" 
                name="email" 
                id="email" 
                class="form-control" 
                required
                pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$"
                title="must be a valid email address"
                value="<?=$this->new_user->email ?>">
            </div>
            <div>
                <label for="sel1">Select list (select one):</label>
                <select class="form-control" name="acl" id="acl">
                    <option value="User">User</option>
                    <option value="Provider">Provider</option>
                </select>
            </div>
            <div>
                <label for="password">Password</label>
                <input 
                type="password" 
                name="password" 
                id="password" 
                class="form-control" 
                required
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                title="must contain at least 6 characters, including UPPER/lowercase and numbers"
                value="<?=$this->new_user->password ?>">
            </div>
            <div>
                <label for="confirm">Confirm Password</label>
                <input 
                type="tex" 
                name="confirm" 
                id="confirm" 
                class="form-control" 
                required
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                title="should match with the password entered above"
                value="<?=$this->new_user->get_confirm() ?>">
            </div>
        </div>
        <div class="form-group">
            <input type="submit" value="register" class="btn btn-large btn-primary">
        </div>
        <div class="text-right">
            <a href="<?=SROOT?>register/login" class="text-primary">login</a>
        </div>
    </form>
</div>
<?php $this->end(); ?>