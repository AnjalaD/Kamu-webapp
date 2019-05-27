<?php
use core\H;
use core\FH;

$this->token = FH::generate_token();
?>

<?php $this->set_title('items'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/order.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="card-header py-2 mx-4 mb-3 d-flex justify-content-between align-items-center" style="background:#9d2525; color:white; font-family:Aclonica;">
            <div></div>    
            <h3>My Current Order</h3>
            <div></div>
</div>
<div class="container">
    <?php if (isset($this->items) && !empty($this->items)) : ?>
        <h2> Resataurant : <a href="<?= SROOT . 'restaurant/details/' . $this->restaurant->id ?>"> <?= $this->restaurant->restaurant_name ?> </a> </h2>
        <div>
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width:50%">Product</th>
                        <th style="width:10%">Price</th>
                        <th style="width:8%">Quantity</th>
                        <th style="width:22%" class="text-center">Subtotal</th>
                        <th style="width:10%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $this->total = 0 ?>
                    <?php foreach ($this->items as $item) : ?>
                        <tr>
                            <td data-th="Item"><?= $item->item_name ?></td>
                            <td data-th="Price"><?= $item->price . " LKR" ?></td>
                            <td data-th="Quantity">
                                <input type="number" class="form-control text-center" id=<?= $item->id ?> min=1 max=20 name="quantity" value=<?= $item->quantity ?>>
                            </td>
                            <td data-th="Subtotal" class="text-center"><?= ($item->price * $item->quantity) . " LKR" ?></td>
                            <?php $this->total += $item->price * $item->quantity ?>
                            <td class="actions" data-th="">
                                <!-- <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button> -->
                                <a href="<?= SROOT . 'order/remove_from_order/' . $item->id ?>"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <!-- <tr class="visible-xs">
                                                                    <td class="text-center"><strong>Total 1.99</strong></td>
                                                                </tr> -->
                    <tr>
                        <td><a href="javascript:history.go(-1)" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                        <td colspan="2" class="hidden-xs"></td>
                        <td class="hidden-xs text-center" id="total"><strong>Total <?= ($this->total) . " LKR" ?></strong></td>
                        <td><a data-toggle="modal" data-target="#order_submit_form" class="btn btn-success btn-block">Submit Order <i class="fa fa-angle-right"></i></a></td>
                    </tr>

                </tfoot>


            </table>
            <a class="btn btn-info" data-toggle="modal" data-target="#save_order_form">Save Order</a>
            <a class="btn btn-danger" href="<?= SROOT ?>order/cancel_order">Cancel Order</a>

            <div id="modals">
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

                <div id="save_order_form" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title bg-dark">Save your order</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <?php $this->partial('order', 'save'); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else : ?>
            <h2>No items selected for current order</h2>
        <?php endif ?>
        <div class="row" style="margin:2%;">
            <div class="col">
                <h3>Saved Orders</h3>
                <?php if (isset($this->drafts) && !empty($this->drafts)) : ?>
                    <div style="height:20rem; overflow-y:auto; overflow-x:hidden;">
                    <?php foreach ($this->drafts as $order) : ?>
                        <div class="row">
                            <div class="dropdown" style="width:80%; margin:2%;">
                                <button class="btn btn-secondary dropdown-toggle order" type="button" id="<?= $order->id ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%;"> <?= $order->order_name ?> </button>
                                <div class="dropdown-menu" aria-labelledby="<?= $order->id ?>" role="menu">
                                    <img src="" alt="loading...">
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>
                <?php else : ?>
                    <p> No saved drafts </p>
                <?php endif ?>
            </div>
            <div class="col">
                <h3>Submitted Orders</h3>
                <?php if (isset($this->submitted) && !empty($this->submitted)) : ?>
                <div style="height:20rem; overflow-y:auto;overflow-x:hidden;">
                    <?php foreach ($this->submitted as $order) : ?>
                        <div class="row" >
                            <div class="dropdown" style="width:80%; margin:2%;">
                                <button class="btn btn-secondary dropdown-toggle order" type="button" id="<?= $order->id ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%;"> <?= $order->time_stamp ?> </button>
                                <div class="dropdown-menu" aria-labelledby="<?= $order->id ?>" role="menu">
                                    <img src="" alt="loading...">
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <?php else : ?>
                    <p> No Orders </p>
                <?php endif ?>
            </div>
        </div>

    </div>
    <?php $this->end(); ?>

    <?php $this->start('script'); ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="<?= SROOT ?>js/submitorder.js"></script>
    <script>
        $('[name=quantity]').change(function() {
            var block = $(this);
            var val = $(this).val();
            var id = $(this).attr('id');
            var total_block = $('#total');
            $.post(
                `${SROOT}order/change_item_quantity/${id}/${val}`, {
                    csrf_token: '<?= $this->token ?>'
                },
                function(resp) {
                    if (resp) {
                        console.log(resp);
                        block.parent().siblings('[data-th=Subtotal]').html(resp[0] + ' LKR');
                        total_block.html('<strong>Total ' + resp[1] + ' LKR</strong>');
                        $("#receipt-date").html('<?= date("Y/m/d") ?>');
                        $(`#receipt-subtotal-${id}`).html(resp[0] + ' LKR');
                        $("#receipt-total").html(resp[1] + ' LKR');

                    }



                }
            );

        });

        $('.order').click(function() {
            var orderId = $(this).attr('id');
            var $head = $(this);
            $.post(
                `${SROOT}order/get_order_items/${orderId}`, {
                    csrf_token: '<?= $this->token ?>'
                },
                function(resp) {
                    $head.next('.dropdown-menu').html(resp);
                }
            );
        });
    </script>
    <?php $this->end(); ?>