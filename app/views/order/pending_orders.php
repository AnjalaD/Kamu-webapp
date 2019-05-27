<?php 
use core\H;
?>

<?php $this->set_title('Pending Orders'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="Profile_body" style="background-image: url(&quot;<?=SROOT?>assets/img/profile_background.jpg&quot;); background-position: center; background-repeat: no-repeat; background-size: cover; height: 100%; font-family:Aclonica;">
    <div class="card card-cascade narrower m-3" style="background:rgb(255,255,255,.7);">
        <div class="card-header py-2 mx-4 mb-3 d-flex justify-content-between align-items-center" style="background:#9d2525; color:white;">
            <div></div>    
            <h3>My Pending Orders</h3>
            <div></div>
        </div>
<?php if(empty($this->orders)) :?>
    <h3>No pending orders</h3>
<?php else :?>
    <div style="height:30rem; overflow-y:scroll;" id="accepted_orders_container">
        <?php foreach ($this->orders as $order) : ?>
            <?= H::create_pending_order_card_for_customer($order) ?>
        <?php endforeach ?>
    </div>
    
    <!-- <div class="table-wrapper">
        <table class="table-hover table-small mb-0" style="table-layout:fixed;">
            <thead>
                <th>Order Code</th>
                <th>Delivery time</th>
                <th></th>
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
    </div> -->

</div>
</div>
<?php endif ?>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<?php $this->end(); ?>