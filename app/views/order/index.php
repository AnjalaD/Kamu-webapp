<?php 
use core\Session;
use core\H;
?>

<?php $this->set_title('items'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container">
    <?php if(isset($this->items) && !empty($this->items)): ?>
    <table class="table table-bordered table-striped">
        <thead class="bg-secondary">
            <th>Item</th>
            <th>Quatity</th>
            <th>Price</th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach($this->items as $item ) :?>
            <tr>
                <td><?= $item->name ?></td>
                <td><?= $item->quantity ?></td>
                <td><?= $item->price ?></td>
                <td><a class="btn btn-danger" href="<?=SROOT. 'order/remove_from_order/'. $item->id?>">Remove Item</a></td>
            </tr>
            <?php endforeach ?> 
        </tbody>
    </table>
    <a class="btn btn-primary" href="">Submit Order</a>
    <a class="btn btn-danger" href="<?=SROOT?>order/cancel_order">Cancel Order</a>
    <?php else: ?>
    <h5>No items selected</h>
    <?php endif ?>
</div>
<?php $this->end(); ?>
