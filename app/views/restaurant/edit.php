<?php $this->set_title('Add New Items'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=SROOT?>/css/croppie.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2">
    <h3 class="center">Add New Restaurant</h3>
    <?php $this->partial('restaurant', 'form'); ?>
</div>


<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="<?= SROOT ?>js/croppie.js"></script>
<script src="<?= SROOT ?>js/croppie-function.js"></script>
<?php $this->end(); ?>