<?php 
use core\Session;
use core\H;
?>

<?php $this->set_title('Orders'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/order_restaurant.css" />
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container">
    <?php if(isset($this->pending_orders) && !empty($this->pending_orders)): ?>
    <h3> New Orders... </h3>

    <div>
        <?php foreach($this->pending_orders as $order ) :?>
        <?= H::create_order_card($order)?>
        <?php endforeach ?> 
    </div>

    
    <?php else: ?>
    <h5>No Orders</h5>
    <?php endif ?>
</div>


<?php $this->end(); ?>
