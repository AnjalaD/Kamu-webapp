<?php
use core\FH;
?>

<?php $this->set_title('Food'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/foodstyles.min.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="container-fluid">
    <form method="POST" action="<?= SROOT ?>search">
        <div class="input-group">
            <input type="text" autocomplete="off" class="form-control" list="food" name="search_string" id="search" value="<?= $this->post_data ?>" placeholder="Enter what you want">
            <div class="input-group-append">
                <input type="submit" class="btn btn-outline-secondary" value="Search" name="food" id="search">
            </div>
        </div>
        <datalist id="food"></datalist>
    </form>

    <div class="row p-2">
        <div class="col-md-2 card bg-light m-1 p-1">
            <?php $this->partial('search', 'filters'); ?>
        </div>
        <div class="col-md-8 card m-1 p-1" id="items">
            <?= $this->results ?>
        </div>
        <div class="col-md-2 card bg-light m-1 p-1">
        </div>
    </div>
</div>

<?php $this->end(); ?>

<?php $this->start('script') ?>
<script src="<?= SROOT ?>js/autocomplete.js"></script>
<script src="<?=SROOT?>js/addtoorder.js"></script>
<script src="<?=SROOT?>js/sortandfilter.js"></script>
<script>
    $('#filters').submit(function(e) {
        e.preventDefault();
        inputs = $('#filters :input');
        data = {};

        inputs.each(function() {
        data[this.name] = $(this).val();
        });
        console.log(data);
        getItemCards(data, 'items');
    });

    var search = document.getElementById('search');
    search.onkeyup = function(){autoComplete(search, 'food')};
    
</script>
<?php $this->end(); ?> 