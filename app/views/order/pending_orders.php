<?php
use core\H;
use core\FH;

$token = FH::generate_token();
?>

<?php $this->set_title('Pending Orders'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/order_restaurant.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div style="background-image:url(<?= SROOT ?>assets/img/profile_background.jpg); background-size:cover; background-attachment:fixed; font-family:Aclonica; min-width:1395px;">


    <div class="card-header py-2 mx-4 mb-3 d-flex justify-content-between align-items-center"
        style="background:#9d2525; color:white;">
        <div></div>
        <h3>My Pending Orders</h3>
        <div></div>
    </div>

    <div class="container pb-5">
        <div class="card card-cascade narrower mt-0 mx-3" style="background:rgb(255,255,255,.7);">
            <?php if (empty($this->orders)) : ?>
            <h3>No pending orders</h3>
            <?php else : ?>
            <div style="height:auto; overflow-y:auto;" id="pending_orders_container">
                <div class="pl-0 pr-3">
                    <?php $i = 0; ?>
                    <?php foreach ($this->orders as $order) : ?>
                    <?php if ($i % 3 == 0) : ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?= H::create_pending_order_card_for_customer($order) ?>
                        </div>
                        <?php elseif ($i % 3 == 1) : ?>
                        <div class="col-md-4">
                            <?= H::create_pending_order_card_for_customer($order) ?>
                        </div>
                        <?php else : ?>
                        <div class="col-md-4">
                            <?= H::create_pending_order_card_for_customer($order) ?>
                        </div>
                    </div>
                    <?php endif ?>
                    <?php $i += 1; ?>
                    <?php endforeach ?>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>

<div id="order-receipt" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background:#ef3030;">
                <h4 class="modal-title ">Order Receipt<?= ' ' ?> </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div id="modal-body"
                            class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3"
                            style="max-width:100%;flex-basis:100%;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

    <?php $this->end(); ?>

    <?php $this->start('script'); ?>
    <script>
        function viewOrderReceipt(orderId) {

            $('.modal').modal();
            $.post(
                `${SROOT}/order/get_order_receipt/${orderId}`
                , { 'csrf_token': '<?=$token?>' },
                function (data) {
                    $('#modal-body').html(data);
                }
            );
        };
    </script>
    <script>
        $('body').on('touchmove', function (event) {
            event.preventDefault();
        });
    </script>

    <?php $this->end(); ?>