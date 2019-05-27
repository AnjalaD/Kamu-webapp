<?php
use core\FH;

$token = FH::generate_token();
?>
<?php $this->set_title('Restaurants'); ?>
<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/restaurant-card.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div style="background-image: url(&quot;<?= SROOT ?>assets/img/profile_background.jpg&quot;); background-position: center; background-repeat: no-repeat; background-size: cover; height: 100%; font-family:Aclonica; min-width:1395px;">
    <div class="container-fluid">
        <div class="p-3">
            <form method="POST" id="search">
                <div class="input-group">
                    <input class="input-group" type="text" autocomplete="off" class="form-control" list="food" name="search_string" id="search_string" value="<?= $this->post_data ?>" placeholder="Enter what you want">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary" value="Search" name="food" id="search">Search <i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </div>
                <datalist id="food"></datalist>
            </form>
        </div>

        <div class="row p-1 my-3">
            <div class="col-md-2">
                <div class="card p-2" style="background-color: rgb(157,37,37,.93);">
                    <?php $this->partial('search', 'restaurant_filters'); ?>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card bg-light p-2 pr-4" id="restaurants"></div>
            </div>

            <div class="col-md-2">
                <div class="card bg-light p-1"></div>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>

<?php $this->start('script') ?>
<script src="<?= SROOT ?>js/masonry.pkgd.min.js"></script>
<script src="<?= SROOT ?>js/autocomplete.js"></script>
<script>
    $(document).ready(function() {
        sendFilters();
    });

    $('form').submit(function(e) {
        sendFilters();
        return false;
    });

    // $("body").on("click", ".tag", function(e) {
    //     sendFilters($(this).attr('id'));
    // });

    function goToPage(page) {
        sendFilters(null, page);
    }

    function sendFilters(search = null, page = 0) {
        if (search == null) {
            search = $('input[name=search_string]').val();
        } else {
            $('input[name=search_string]').val(search);
        }
        data = {
            'csrf_token': '<?= $token ?>',
            'search': search,
            'search_by': $('input[name=search_by]:checked').val(),
            'sort_by': $('input[name=sort_by]:checked').val()
        };
        getResults(data, 'restaurants', page);
    }

    function getResults(data, divId, pageNo) {
        console.log($('input[name=search_by]:checked').val());
        $.post(
            `${SROOT}search/search/2/${pageNo}`,
            data,
            function(resp) {
                console.log(resp);
                if (!resp) {
                    if (pageNo > 0) $('#' + divId).html("<p>End of Results</p>");
                    else $('#' + divId).html("<p>No items found</p>");
                } else {
                    $('#' + divId).html(resp);
                    // $('.grid').masonry({
                    // // options
                    //     itemSelector: '.grid-item',
                    //     columnWidth: 0
                    // });
                }
            }
        );
    }

    $('#search_string').keyup(function() {
        autoComplete($(this).val(), 2)
    });

    $("body").on("click", ".star", function() {
        var value = $(this).attr('id');
        var itemId = $(this).parent().attr('id');
        addRating(itemId, value, '<?= $token ?>');
    });
</script>

<?php $this->end(); ?>