<?php 
use core\Session;
use core\H;
?>

<?php $this->set_title('items'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container">
    <?php if (isset($this->items) && !empty($this->items)) : ?>
    <table class="table table-bordered table-striped">
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
    <a type="button" class="btn btn-primary"  data-toggle="modal" data-target="#order_submit_form">Submit Order</a>
    <a type="button" class="btn btn-secondray" href="<?= SROOT ?>order/save_draft">Save and Cancel</a>
    <a type="button" class="btn btn-danger" href="<?= SROOT ?>order/cancel_order">Cancel Order</a>

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
</div>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?= SROOT ?>js/submitorder.js"></script>
<?php $this->end(); ?>
