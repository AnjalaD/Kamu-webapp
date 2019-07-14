<?php

use core\FH;

$token = FH::generate_token();
?>
<?php $this->set_title('Restaurants'); ?>
<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/restaurant-card.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div style="background-image:url(<?= SROOT ?>assets/img/profile_background.jpg); background-attachment:fixed; background-repeat: repeat-y; background-size: cover; background-position: horizontal-center; font-family:Aclonica; min-width:1395px;">
    <div class="container-fluid pb-5">
        <div class="p-3">
            <form method="POST" id="search">
                <div class="input-group">
                    <input type="text" autocomplete="off" class="form-control" list="food" name="search_string" id="search_string" value="<?= $this->post_data ?>" placeholder="Search for restaurants...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary" value="Search" name="food" id="search"> Search <i class="fa fa-search" aria-hidden="true"></i></button>
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

            <div class="col-md-8" style="background-color:rgba(255,255,255,0);">
                <div class="card p-2 pr-4" id="restaurants" style="background-color:rgba(255,255,255,0); border:none;"></div>
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
    var data;

    $(document).ready(function() {
        sendFilters();
    });

    $('form').submit(function(e) {
        e.preventDefault();
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

        if ($('input[name=sort_by]:checked').val() == 0) {
            data.location_lat = 0.0;
            data.location_lng = 0.0;
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(setValues, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
                return;
            }
        }

        getResults(data, 'restaurants', page);
    }

    function setValues(position) {
        data.location_lat = position.coords.latitude;
        data.location_lng = position.coords.longitude;
    }

    function showError(error) {
        var x = "Error";
        switch (error.code) {
            case error.PERMISSION_DENIED:
                x = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                x = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                x = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                x = "An unknown error occurred."
                break;
        }
        alert(x);
    }
    

    function getResults(data, divId, pageNo) {
        // console.log($('input[name=search_by]:checked').val());
        // console.log(data);
        $.post(
            `${SROOT}search/search/2/${pageNo}`,
            data,
            function(resp) {
                // console.log(resp);
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

<!-- <script>
    document.body.setAttribute('style',"background-image:url(<?= SROOT ?>assets/img/profile_background.jpg); background-position: center; background-repeat: no-repeat; background-size: cover; font-family:Aclonica; min-width:1395px;");
</script> -->

<?php $this->end(); ?>