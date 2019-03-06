<?php $this->set_title('Add New Contacts'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2">
    <h3 class="center">Add new contact</h3>
    <?php $this->partial('contacts', 'form'); ?>
</div>
<?php $this->end(); ?>