<?php $this->set_title('Verify Restaurant'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=SROOT?>css/croppie.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2">
    <h3 class="center">Verify Restaurant</h3>
    <?php $this->partial('restaurant', 'form'); ?>
</div>
<div id="uploaded_image"></div>
<?php $this->end();?>

<?php $this->start('script');?>
<script src="<?= SROOT ?>js/croppie.js"></script>
<script src="<?= SROOT ?>js/croppie-function.js"></script>
<?php $this->end(); ?>