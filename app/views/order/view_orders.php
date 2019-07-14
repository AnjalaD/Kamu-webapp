<?php
use core\Session;
use core\H;
use core\FH;
$token = FH::generate_token();
?>


<?php $this->set_title('Orders'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/order_restaurant.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container" id='all_orders_container'>
    <div class="row">
        <div class="col-md-7" style="font-family:Aclonica;">
            <?php if (isset($this->pending_orders) && !empty($this->pending_orders)) : ?>
                <h3> New Orders... </h3>

                <div style="height:30rem; overflow-y:auto; " id="pending_orders_container">
                    <?php foreach ($this->pending_orders as $order) : ?>
                        <?= H::create_pending_order_card($order, $this->items_model) ?>
                    <?php endforeach ?>
                </div>


            <?php else : ?>
                <h5>No New Orders</h5>
            <?php endif ?>
        </div>
        <div class="col" >
            <?php if (isset($this->accepted_orders) && !empty($this->accepted_orders)) : ?>
                <h3> Accepted Orders... </h3>
                <div style="height:30rem; overflow-y:auto; " id="accepted_orders_container">
                    <?php foreach ($this->accepted_orders as $order) : ?>
                        <?= H::create_accepted_order_card($order, $this->items_model) ?>
                    <?php endforeach ?>
                </div>


            <?php else : ?>
                <h5>No Accepted Orders</h5>
            <?php endif ?>


        </div>
    </div>
</div>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<!-- all orders refresh -->
<script >
var auto_refresh = setInterval(
    function () {
        var pendingScrollPos = $("#pending_orders_container").scrollTop();
        var acceptedScrollPos = $("#accepted_orders_container").scrollTop();
        $.post(
            `${SROOT}order/get_all_orders_to_restaurant_html`,
            { 'csrf_token' : '<?= $token ?>'},
            function (resp) {
                $('#all_orders_container').html(resp);
                $("#pending_orders_container").scrollTop(pendingScrollPos);
                $("#accepted_orders_container").scrollTop(acceptedScrollPos);

            }
        );
    }, 3000); // refresh every 3000 milliseconds
</script>

<?php $this->end(); ?>