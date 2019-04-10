<?php 
use core\H;
?>

<?php $this->set_title('items'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<h3 class="center">Menu items</h3>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <th>Name</th>
        <th>Image</th> 
        <th>Description</th>
        <th>Price</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach($this->items as $item): ?>
            <tr>
                <td><a href="<?=SROOT . 'items/details/' .$item->id?>"><?=$item->item_name?></td>
                <td><img src="<?=$item->image_url?>" ></td>
                <td><?=$item->description?></td>
                <td><?=$item->price?></td>
                <td class="text-right">
                    <a href="<?=SROOT?>items/edit/<?=$item->id?>" class="btn btn-primary" onclick= "if(!confirm('Are you sure?')){return false;}">Edit</a>
                    <?php if ($item->deleted) : ?>
                    <a href="<?=SROOT?>items/unhide/<?=$item->id?>" class="btn btn-secondary" onclick= "if(!confirm('Are you sure?')){return false;}">Unhide</a>
                    <?php else :?>
                    <a href="<?=SROOT?>items/hide/<?=$item->id?>" class="btn btn-secondary" onclick= "if(!confirm('Are you sure?')){return false;}">Hide</a>
                    <?php endif ?>
                    <a href="<?=SROOT?>items/delete/<?=$item->id?>" class="btn btn-danger" onclick= "if(!confirm('Are you sure?')){return false;}">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php $this->end(); ?>
