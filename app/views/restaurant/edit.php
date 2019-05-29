<?php $this->set_title('Edit Restaurant'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=SROOT?>css/styles.min.css">
<link rel="stylesheet" href="<?=SROOT?>css/croppie.css">
<link rel="stylesheet" href="<?= SROOT ?>css/add_restaurant.css">

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<?php $this->partial('restaurant', 'form'); ?>


<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="<?= SROOT ?>js/croppie.js"></script>
<script src="<?= SROOT ?>js/croppie-function.js"></script>
<?php $this->end(); ?>