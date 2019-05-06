<?php
use core\FH;
?>

<form method="post" action=<?=$this->post_action_save?> >
    <div class="form-group">
        <?=FH::csrf_input($this->token)?>
        <div class="input-group">
            <input type="text" name="order_name" class="form-control" placeholder="Order Name"/>
            </div>
        </div>
    </div>

    <input type="submit" class="btn btn-primary" name="" value="Submit">
</form> 