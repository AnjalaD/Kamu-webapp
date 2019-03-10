<?php
use core\FH;
?>
<?php $this->set_title('Home'); ?>
<script src="<?=SROOT?>js/jquery.typeahead.min.js">
</script>
<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container-fluid">
    <form>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" id="search" placeholder="Enter what you want" aria-label="search_text" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <input type="submit" class="btn btn-outline-secondary" value="Search" name="search" id="search">
            </div>
    </form>
</div>
<div class="row">
    <div class="col-md-3">
        <form class="form-group">
            <div class="card card-body">

                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
                        Choice1
                    </label>
                </div>
            </div>
            <div class="card card-body">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
                        Choice1
                    </label>
                </div>
            </div>
            <div class="card card-body">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
                        Choice1
                    </label>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-9">
        <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">Text</p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">Text</p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">Text</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('input.search').typeahead({
            name: 'search',
            remote: '<?=SROOT?>search/%QUERY',
            limit: 10
        });
    });
</script>
<?php $this->end(); ?> 