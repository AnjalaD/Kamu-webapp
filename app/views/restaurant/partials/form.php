<?php
use core\FH;
?>

<form class="form-group" method="post" action=<?=$this->post_action?> >
    <?=FH::display_errors($this->display_errors)?>
    <?=FH::csrf_input()?>
    <?= FH::input_block('text', 'Name', 'name', $this->restaurant->name, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= FH::input_block('text', 'Address', 'address', $this->restaurant->address, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= FH::input_block('text', 'Telephone', 'telephone', $this->restaurant->telephone, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= FH::input_block('text', 'Email', 'email', $this->restaurant->email, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= FH::input_block('text', 'Location-lng', 'lng', $this->restaurant->lng, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= FH::input_block('text', 'Location-lat', 'lat', $this->restaurant->lat, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <input type="file" name="upload_image" id="upload_image">
    <input type="text" hidden name="image" id="image">
    <?= FH::input_block('submit', '', 'add', 'Add', ['class' => 'btn btn-primary'], ['class' => 'form-group col-md-6']); ?>
</form>