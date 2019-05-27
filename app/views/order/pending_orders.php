<?php
use core\H;
?>

<?php $this->set_title('Pending Orders'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/order_restaurant.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="Profile_body" style="background-image: url(&quot;<?= SROOT ?>assets/img/profile_background.jpg&quot;); background-position: center; background-repeat: no-repeat; background-size: cover; height: 100%; font-family:Aclonica;">
    <div class="card card-cascade narrower mt-0 mb-5 mx-3" style="background:rgb(255,255,255,.7);">
        <div class="card-header py-2 mx-4 mb-3 d-flex justify-content-between align-items-center" style="background:#9d2525; color:white;">
            <div></div>
            <h3>My Pending Orders</h3>
            <div></div>
        </div>
        <?php if (empty($this->orders)) : ?>
            <h3>No pending orders</h3>
        <?php else : ?>
            <div style="height:30rem; overflow-y:auto;" id="pending_orders_container">
                <div class="p-5">
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

<div id="order_submit_form" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background:#ef3030;">
                <h4 class="modal-title ">Submit Order<?= ' ' ?> </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3" style="max-width:100%;flex-basis:100%;">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <address>
                                        <strong><?= $this->restaurant->restaurant_name ?></strong>
                                        <br>
                                        <?= $this->restaurant->address ?>
                                        <br>
                                        <?= $this->restaurant->telephone ?>
                                    </address>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                    <p>
                                        <em id="receipt-date">Date: <?= date("Y/m/d") ?> </em>
                                    </p>

                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <h1>Receipt</h1>
                                </div>
                                </span>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:50%;">Item</th>
                                            <th style="width:10%;">Qty</th>
                                            <th class="text-center" style="width:30%;">Price</th>
                                            <th class="text-center" style="width:30%;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $this->total = 0 ?>

                                        <?php foreach ($this->items as $item) : ?>
                                            <?php $this->total += ($item->quantity * $item->price) ?>
                                            <tr>
                                                <td><em><?= $item->item_name ?></em></h4>
                                                </td>
                                                <td style="text-align: center"> <?= $item->quantity ?> </td>
                                                <td class=" text-center"><?= $item->price . " LKR" ?></td>
                                                <td class=" text-center" id="receipt-subtotal-<?= $item->id ?>"><?= ($item->quantity * $item->price) . ' LKR' ?></td>
                                            </tr>

                                        <?php endforeach ?>

                                        <tr>
                                            <td>   </td>
                                            <td>   </td>
                                            <td class="text-right">
                                                <h5 style="color:black"><strong>Total: </strong></h4>
                                            </td>
                                            <td class="text-center text-danger">
                                                <h5 style="color:red"><strong id="receipt-total"><?= $this->total . ' LKR' ?></strong></h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center font-weight-bold">
                                    <h3>Your Order Code is : <b>JHGIUG.98</b></h3>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->partial('order', 'form'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>

<?php $this->start('script'); ?>
<?php $this->end(); ?>