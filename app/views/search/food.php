<?php
use core\FH;
?>

<?php $this->set_title('Food'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/foodstyles.min.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="container-fluid">
    <form method="POST" id="search">
        <div class="input-group">
            <input type="text" autocomplete="off" class="form-control" list="food" name="search_string" id="search_string" value="<?= $this->post_data ?>" placeholder="Enter what you want">
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

    $('form').submit(function(e) {
        sendFilters();
        return false;
    });

    function sendFilters(){
        
        data = {
            'search' : $('input[name=search_string]').val(),
            'sort_by' : $('input[name=sort_by]:checked').val(),
            'price_filter' : $('input[name=price_filter]').val()
        };
        console.log(data);
        getItemCards(data, 'items');
    }

    var search = document.getElementById('search_string');
    search.onkeyup = function(){autoComplete(search.value, 'food')};
    
</script>
<?php $this->end(); ?> 