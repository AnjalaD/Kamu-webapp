<?php $this->set_title('items'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<h3 class="center">Items</h3>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <th clas=>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach($this->items as $item): ?>
            <tr>
                <td><a href="<?=SROOT . 'items/details/' .$item->id?>"><?=$item->name?></td>
                <td><?=$item->description?></td>
                <td><?=$item->price?></td>
                <td class="text-right">
                    <a href="<?=SROOT?>items/edit/<?=$item->id?>" class="btn btn-primary" onclick= "if(!confirm('Are you sure?')){return false;}">Edit</a>
                    <a href="<?=SROOT?>items/delete/<?=$item->id?>" class="btn btn-danger" onclick= "if(!confirm('Are you sure?')){return false;}">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php $this->end(); ?>