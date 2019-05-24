<?php 
use core\Session;
use core\H;
?>

<?php $this->set_title('Orders'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container">
    <?php if(isset($this->pending_orders) && !empty($this->pending_orders)): ?>
    <table class="table table-bordered table-striped">
        <thead class="bg-secondary">
            <th>Order ID</th>
            <th>Order Code</th>
            <th>Due Time</th>
            <th>Price</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach($this->pending_orders as $order ) :?>
            <tr>
                <td><?= $order->id ?></td>
                <td><?= $order->order_code ?></td>
                <td><?= $order->delivery_time ?></td>
                <td><a class="btn btn-primary" href="<?=SROOT. 'order/accept_order/'. $order->id?>">Accept Order</a></td>
                <td><a class="btn btn-danger" href="<?=SROOT. 'order/reject_order/'. $order->id?>">Reject Order</a></td>
            </tr>
            <?php endforeach ?> 
        </tbody>
    </table>
    <?php else: ?>
    <h5>No Orders</h5>
    <?php endif ?>
</div>
<?php $this->end(); ?>
