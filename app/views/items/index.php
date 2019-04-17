<?php 
use core\H;
?>

<?php $this->set_title('items'); ?>

<?php $this->start('head'); ?>
    <link rel="stylesheet" href="<?= SROOT ?>css/foodstyles.min.css">
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
                <td><a type="button" class="btn btn-primary item"  data-toggle="modal" data-target="#item_preview" id="<?=$item->id?>"><?=$item->item_name?></button></td>
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

<div id="item_preview" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="justify-content-center" id="item_details"></div>
            </div>

        </div>
    </div>
<?php $this->end(); ?>

<?php $this->start('script') ?>
<script>
    $('.item').click(function(){
        $.post(
            `${SROOT}items/details/` + $(this).attr('id'),
            {},
            function(resp){
                if(resp){$('#item_details').html(resp)}
            }
        );
    });
</script>
<?php $this->end();
