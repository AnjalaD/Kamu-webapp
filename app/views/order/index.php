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
    <table class="table table-bordered">
        <thead class="bg-secondary">
            <th>Item</th>
            <th>Quatity</th>
            <th>Price</th>
        </thead>
        <tbody>
            <?php foreach($this->items as $item ) :?>
            <tr>
                <td><?= $item->name ?></td>
                <td></td>
                <td><?= $item->price ?></td>
            </tr>
            <?php endforeach ?> 
        </tbody>
    </table>
    <a class="btn btn-danger" href="<?=SROOT?>order/cancel_order">Cancel Order</a>
    <?php else: ?>
    <h5>No items selected</h>
    <?php endif ?>
</div>
<?php $this->end(); ?>
