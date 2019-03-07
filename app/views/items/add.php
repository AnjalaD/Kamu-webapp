<?php $this->set_title('Add New Items'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2">
    <h3 class="center">Add new item</h3>
    <div><?=$this->display_errors ?></div>
    <?php $this->partial('items', 'form'); ?>
</div>
<?php $this->end(); ?>