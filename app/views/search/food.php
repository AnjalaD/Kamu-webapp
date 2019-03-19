<?php
use core\FH;
?>
<?php $this->set_title('Home'); ?>
<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=SROOT?>css/foodstyles.min.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container-fluid">
    <form method="POST" action="<?=SROOT?>search">
        <div class="input-group">
                <input type="text" autocomplete="off" class="form-control" list="food" name="search_string" id="search" value="<?=$this->post_data?>" placeholder="Enter what you want">
                <div class="input-group-append">
                    <input type="submit" class="btn btn-outline-secondary" value="Search" name="food" id="search">
                </div>
            <datalist id="food"></datalist>
        </div>
    </form>
</div>

<?=$this->results?>

<?php $this->end(); ?>

<?php $this->start('script')?>
<script>
    var search = document.getElementById('search');
    search.onkeyup = function () {
        $.ajax({
            type: "POST",
            url: '<?= SROOT ?>search/auto_complete/' + search.value,
            data: {
                model_id: 45
            },
            success: function (resp) {
                temp = '';
                for (i = 0; i < resp.length; i++) {
                    temp += '<option class="list-group-item" value="'+resp[i]+ '">' + resp[i] + '</option>';
                }
                document.getElementById('food').innerHTML = (temp);
                // console.log(resp);
            }
        });
    }
</script>
<?php $this->end(); ?>