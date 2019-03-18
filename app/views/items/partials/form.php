<?php
use core\FH;
?>

<form class="form-group" method="post" action=<?=$this->post_action?> >
    <?=FH::display_errors($this->display_errors)?>
    <?=FH::csrf_input()?>
    <?= FH::input_block('text', 'Name', 'name', $this->item->name, ['class' => 'form-control'], ['class' => 'form-group']); ?>
    <?= FH::input_block('text', 'Description', 'description', $this->item->description, ['class' => 'form-control'], ['class' => 'form-group']); ?>
    <?= FH::input_block('text', 'Price', 'price', $this->item->price, ['class' => 'form-control'], ['class' => 'form-group']); ?>
    <input type="file" name="upload_image" id="upload_image">
    <input type="text" hidden name="image" id="image">
    <hr>
    <div class="text-right">
        <a href="<?=SROOT?>items" class="btn btn-default">Cancel</a>
        <?= FH::submit_tag('Save', ['class' => 'btn btn-primary'])?>
    </div>

    <!-- <?= FH::input_block('submit', '', 'add', 'Add', ['class' => 'btn btn-primary'], ['class' => 'form-group col-md-6']); ?> -->
</form>