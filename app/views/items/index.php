<?php
use core\H;
?>

<?php $this->set_title('items'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/foodstyles.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="Profile_body" style="background-image: url(&quot;<?= SROOT ?>assets/img/profile_background.jpg&quot;); background-position: center; background-repeat: no-repeat; background-size: cover; height: 100%; font-family:Aclonica; min-width:60rem;">
    <div class="card card-cascade narrower m-3" style="background:rgb(255,255,255,.7);">
        <div class="card-header py-2 mx-4 mb-3 d-flex justify-content-between align-items-center" style="background:#9d2525; color:white;">
            <div></div>
            <h3>My Restaurant Menu</h3>
            <div></div>
        </div>
        <div class="px-4">
            <?php if(!empty($this->items)):?>
            <div class="table-wrapper" style="height:30rem; overflow-y:auto;">
                <table class="table table-hover table-small mb-0" style="table-layout:fixed;">
                    <thead>
                        <tr>
                            <th class="font-weight-bold" style="width:20%; font-size:1.25rem;">Food Item</th>
                            <th class="font-weight-bold" style="width:15%; font-size:1.25rem;">Image</th>
                            <th class="font-weight-bold" style="width:30%; font-size:1.25rem;">Description</th>
                            <th class="font-weight-bold" style="width:15%; font-size:1.25rem;">Price</th>
                            <th style="width:20%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->items as $item) : ?>
                            <tr>
                                <td><button class="btn btn-primary item " data-toggle="modal" data-target="#item_preview" id="<?= $item->id ?>"><?= $item->item_name ?></button></td>
                                <td><img src="<?= $item->image_url ?>" style="object-fit:contain; width:100%;"></td>
                                <td style="font-size:1.05rem;"><?= $item->description ?></td>
                                <td class="font-weight-bold" style="font-size:1.05rem;"><?= number_format((float)round($item->price, 2), 2, '.', '') ?> LKR</td>
                                <td class="text-right">
                                    <a href="<?= SROOT ?>items/edit/<?= $item->id ?>" class="btn btn-warning mt-1" style="color:black;" onclick="if(!confirm('Are you sure?')){return false;}">Edit</a>
                                    <a href="<?= SROOT ?>items/hide_unhide/<?= $item->id ?>" class="btn btn-dark mt-1" onclick="if(!confirm('Are you sure?')){return false;}"><?= $item->hidden ? "Unhide" : "Hide" ?></a>
                                    <a href="<?= SROOT ?>items/delete/<?= $item->id ?>" class="btn btn-danger mt-1" onclick="if(!confirm('Are you sure?')){return false;}">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <h4 style="color:black; height:30rem;">No items to display...</h4>
            <?php endif ?>
        </div>
    </div>

    <div id="item_preview" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width:60%;">

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
                    var food_item_display_card = document.getElementById("food_item_display_card");
                    food_item_display_card.classList.remove("grid-item");
                    var food_item_image = document.getElementById("food_item_image");
                    food_item_image.setAttribute('style', "max-height:250px; object-fit:contain;");
                    var food_item_description = document.getElementById("food_item_description");
                    food_item_description.setAttribute('style', "height:6rem;")

                }
            }
        );
    });
</script>

<?php $this->end();
