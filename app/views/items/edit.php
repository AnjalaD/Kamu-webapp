<?php $this->set_title('Edit Item'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=SROOT?>css/croppie.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="<?=SROOT?>css/styles.min.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
    <?php $this->partial('items', 'form'); ?>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="<?= SROOT ?>js/croppie.js"></script>
<script src="<?= SROOT ?>js/croppie-function.js"></script>
<script src="<?= SROOT ?>js/addtag.js"></script>
<?php $this->end(); ?>