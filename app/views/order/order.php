<?php
use core\Session;
use core\H;
?>

<?php $this->set_title('items'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/order.css" />
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container">
    <?php if (isset($this->items) && !empty($this->items)) : ?>
        <!-- <table class="table table-bordered table-striped">
            <thead class="bg-secondary">
                <th>Item</th>
                <th>Quatity</th>
                <th>Price</th>
                <th></th>
            </thead>
            <tbody>
                <?php foreach ($this->items as $item) : ?>
                    <tr>
                        <td><?= $item->item_name ?></td>
                        <td><?= $item->quantity ?></td>
                        <td><?= $item->price ?></td>
                        <td><a class="btn btn-danger" href="<?= SROOT . 'order/remove_from_order/' . $item->id ?>">Remove Item</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#order_submit_form">Submit Order</a>
        <a type="button" class="btn btn-secondray" href="<?= SROOT ?>order/save_draft">Save and Cancel</a>
        <a type="button" class="btn btn-danger" href="<?= SROOT ?>order/cancel_order">Cancel Order</a> -->



        <div class="container">
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
                    <?php $this->total=0 ?>
                    <?php foreach ($this->items as $item) : ?>
                    <tr>
                        <td data-th="Item"><?= $item->item_name ?></td>
                        <td data-th="Price"><?= $item->price." LKR" ?></td>
                        <td data-th="Quantity">
                            <input type="number" class="form-control text-center" value=<?= $item->quantity ?>>
                        </td>
                        <td data-th="Subtotal" class="text-center"><?= ($item->price*$item->quantity)." LKR" ?></td>
                        <?php $this->total+=$item->price*$item->quantity?>
                        <td class="actions" data-th="">
                            <!-- <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button> -->
                            <a href="<?= SROOT . 'order/remove_from_order/' . $item->id ?>" ><button class="btn btn-danger btn-sm" ><i class="fa fa-trash-o"></i></button></a>
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
                        <td class="hidden-xs text-center"><strong>Total <?= ($this->total)." LKR" ?></strong></td>
                        <td><a data-toggle="modal" data-target="#order_submit_form" class="btn btn-success btn-block">Submit Order <i class="fa fa-angle-right"></i></a></td>
                    </tr>
                        
                </tfoot>
                
            </table>
            <a  class="btn btn-info" href="<?= SROOT ?>order/save_draft">Save for later</a>
            <a  class="btn btn-danger" href="<?= SROOT ?>order/cancel_order">Cancel Order</a>
        </div>

        <div id="order_submit_form" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title bg-dark">Modal Header</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>

                        <?php $this->partial('order', 'form'); ?>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    <?php else : ?>
        <h5>No items selected</h>
    <?php endif ?>

    <div>
        <div>
            <h1>Drafts</h1>
            <?php if( isset($this->drafts) && !empty($this->drafts) ) :?>
                <?php foreach($this->drafts as $draft) :?>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link draft" id="<?=$draft->id?>" data-toggle="dropdown" aria-expanded="false" href="#"><?=$draft->time_stamp?></a>
                        <div class="dropdown-menu" role="menu">
                            <img src="" alt="loading...">
                        </div>
                    </li>
                <?php endforeach ?>
            <?php else :?>
                <p> No saved drafts </p>
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
    $('.draft').click(function(){
        var draftId = $(this).attr('id');
        var $head = $(this);
        console.log(draftId);
        $.post(
            `${SROOT}order/get_draft_items/${draftId}`,
            {},
            function(resp){
                $head.next('.dropdown-menu').html(resp);
            }
        );
    });
</script>
<?php $this->end(); ?>