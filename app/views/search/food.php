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
            <datalist id="food"></datalist>
        </div>
    </form>
</div>

<?= $this->results ?>
<?php $this->end(); ?>

<?php $this->start('script') ?>
<script src="<?= SROOT ?>js/functions.js"></script>
<script>
    var search = document.getElementById('search');
    search.onkeyup = function() {
        autoComplete(search, 'food');
    };
</script>
<?php $this->end(); ?> 