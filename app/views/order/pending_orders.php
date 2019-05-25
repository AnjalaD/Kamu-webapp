<?php 
use core\H;
?>

<?php $this->set_title('Pending Orders'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<?php if(empty($this->orders)) :?>
    <h3>No pending orders</h3>
<?php else :?>
    <table>
        <thead>
            <th>Order Code</th>
            <th>Delivery time</th>
            <th>...</th>
        </thead>
        <tbody>
        <?php foreach($this->orders as $order) :?>
        <tr>
            <td><?=$order->order_code?></td>
            <td><?=$order->delivery_time?></td>
            <td><a href="<?=SROOT?>order/cancel_pending_order/<?=$order->id?>" >Cancel</a></td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<?php $this->end(); ?>