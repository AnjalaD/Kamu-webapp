<?php
use core\FH;
?>
<?php $this->set_title('Home'); ?>
<?php $this->start('head'); ?>
<!-- <script src="<?= SROOT ?>js/jquery.typeahead.min.js"></script> -->
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container-fluid">
    <form method="POST">
        <div class="input-group">
                <input type="text" autocomplete="off" class="form-control" list="food" name="search" id="search" placeholder="Enter what you want">
                <div class="input-group-append">
                    <input type="submit" class="btn btn-outline-secondary" value="Search" name="search" id="search">
                </div>
            <datalist id="food"></datalist>
        </div>
    </form>
</div>

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