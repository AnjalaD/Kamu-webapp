<?php $this->set_title($this->contact->name); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2">
<a href="<?=SROOT. 'contacts'?>" class="btn btn-xs btn-primary">Back</a>
<h2 class="text-center"><?=$this->contact->name?></h2>
<?php $this->end(); ?>