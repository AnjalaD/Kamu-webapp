<?php $this->set_title($this->item->name); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2">
    
    <h2><?=$this->item->name?></h2>
    <div class="col-md-6">
        <p><span>Description: </span><?=$this->item->description?></p>
        <p><span>Price: </span><?=$this->item->price?></p>
        <p><img src="<?=$this->item->image_url?>"></P>
    </div>
    <a href="<?=SROOT. 'items'?>" class="btn btn-xs btn-primary">Back</a>
</div>
<?php $this->end(); ?>