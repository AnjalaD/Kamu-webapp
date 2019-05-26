<?php
use core\H;
?>

<?php $this->set_title('items'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/foodstyles.min.css">
<link rel="stylesheet" href="<?=SROOT?>css/mdb.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="Profile_body" style="background-image: url(&quot;<?=SROOT?>assets/img/profile_background.jpg&quot;); background-position: center; background-repeat: no-repeat; background-size: cover; height: 100%;">
    <div class="card card-cascade narrower m-3" style="background:rgb(225,225,225,.8);">
        <div class="view view-cascade gradient-card-header peach-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <div></div>    
            <h3 class="white-text mx-3">My Restaurant Menu</h3>
            <div></div>
        </div>
        <div class="px-4">
            <div class="table-wrapper">
                <table class="table table-hover table-small mb-0" style="table-layout:fixed;">
                    <thead>
                        <tr>
                            <th class="font-weight-bold" style="width:20%; font-size:1.25rem;">Food Item</th>
                            <th class="font-weight-bold" style="width:15%; font-size:1.25rem;">Image</th>
                            <th class="font-weight-bold" style="font-size:1.25rem;">Description</th>
                            <th class="font-weight-bold" style="width:10%;font-size:1.25rem;">Price</th>
                            <th style="width:25%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->items as $item) : ?>
                            <tr>
                                <td><a type="button" class="btn btn-primary item" data-toggle="modal" data-target="#item_preview" id="<?= $item->id ?>"><?= $item->item_name ?></button></td>
                                <td><img src="<?= $item->image_url ?>"></td>
                                <td style="font-size:1.05rem;"><?= $item->description ?></td>
                                <td class="font-weight-bold" style="font-size:1.05rem;">Rs.<?= number_format((float)round($item->price,2), 2, '.', '') ?></td>
                                <td class="text-right">
                                    <a href="<?= SROOT ?>items/edit/<?= $item->id ?>" class="btn btn-warning" style="color:black;" onclick="if(!confirm('Are you sure?')){return false;}">Edit</a>
                                    <a href="<?= SROOT ?>items/hide_unhide/<?= $item->id ?>" class="btn btn-dark" onclick="if(!confirm('Are you sure?')){return false;}"><?= $item->hidden ? "Unhide" : "Hide"?></a>
                                    <a href="<?= SROOT ?>items/delete/<?= $item->id ?>" class="btn btn-danger" onclick="if(!confirm('Are you sure?')){return false;}">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="item_preview" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="justify-content-center" id="item_details"></div>
            </div>

        </div>
    </div>
</div>
<?php $this->end(); ?>

<?php $this->start('script') ?>
<script>
    $('.item').click(function() {
        $.post(
            `${SROOT}items/details/` + $(this).attr('id'), {},
            function(resp) {
                if (resp) {
                    $('#item_details').html(resp)
                }
            }
        );
    });
</script>
<?php $this->end();
