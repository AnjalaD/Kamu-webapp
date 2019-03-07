<?php $this->set_title('items'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<h3 class="center">Items</h3>
<table class="table table-striped border">
    <thead>
        <th>Name</th>
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
                <td></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php $this->end(); ?>