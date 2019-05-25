<?php $this->set_title('Add New Item'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=SROOT?>css/croppie.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="<?=SROOT?>css/styles.min.css">
<link rel="stylesheet" href="<?=SROOT?>css/mdb.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<?php $this->partial('items', 'form'); ?>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="<?= SROOT ?>js/croppie.js"></script>
<script src="<?= SROOT ?>js/croppie-function.js"></script>
<script src="<?= SROOT ?>js/addtag.js"></script>

<script type="text/javascript">
    var tag_array = <?= !empty($this->item->tags) ? json_encode($this->item->tags) : []; ?>;
    console.log("view rendered");
    console.log(tag_array);
    loadPreviousTags(tag_array);
</script>

<?php $this->end(); ?>