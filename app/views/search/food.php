<?php
use core\FH;

$token = FH::generate_token();
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

    <div class="row p-1">
        <div class="col-md-2">
            <div class="card bg-light p-1">
                <?php $this->partial('search', 'food_filters'); ?>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card bg-light p-1" id="items"></div>
        </div>

        <div class="col-md-2">
            <div class="card bg-light p-1"></div>
        </div>
    </div>
</div>

<div id="add_to_order" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background:#ef3030;">
                <h4 class="modal-title">Info</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>

<?php $this->start('script') ?>
<script src="<?= SROOT ?>js/masonry.pkgd.min.js"></script>
<script src="<?= SROOT ?>js/autocomplete.js"></script>
<script src="<?= SROOT ?>js/addtoorder.js"></script>
<script src="<?= SROOT ?>js/rating.js"></script>
<script>
    $(document).ready(function() {
        sendFilters();
    });

    $('form').submit(function(e) {
        sendFilters();
        return false;
    });

    $("body").on("click", ".tag", function(e) {
        sendFilters($(this).attr('id'));
    });

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
            'sort_by': $('input[name=sort_by]:checked').val(),
            'price_filter': $('input[name=price_filter]').val()
        };
        viewResults(data, 'items', page);
    }

    function viewResults(data, divId, pageNo) {
        console.log("ajax");
        $.post(
            `${SROOT}search/search/1/${pageNo}`,
            data,
            function(resp) {
                console.log(resp);
                if (!resp) {
                    if (pageNo > 0) $('#' + divId).html("<p>End of Results</p>");
                    else $('#' + divId).html("<p>No items found</p>");
                } else {
                    $('#' + divId).html(resp);
                    $('.grid').masonry({
                        // options
                        itemSelector: '.grid-item',
                        columnWidth: 0
                    });
                }
            }
        );
    }

    $('#search_string').keyup(function() {
        autoComplete($(this).val(), 1)
    });
</script>


<script>
    // not completed
    $("body").on("click", ".star", function() {
        var value = $(this).attr('id');
        var itemId = $(this).parent().attr('id');
        addRating(itemId, value, '<?= $token ?>');
    });
</script>

<?php $this->end(); ?>