<?php
use core\FH;

$token = FH::generate_token();
?>

<?php $this->set_title($this->restaurant->restaurant_name); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<link rel="stylesheet" href="<?= SROOT ?>css/foodstyles.min.css">
<!-- styles for map -->
<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.0/mapsjs-ui.css?dp-version=1542186754" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


<link rel="stylesheet" href="<?= SROOT ?>css/restaurant-view.css">

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div style="background-image:url(<?= SROOT ?>assets/img/Vienna_House_Easy_Bad_Oeyenhausen-423.jpg); background-attachment:fixed; background-size: cover;">
<div class="row pull-right" style="margin-top:10px;padding:15px;margin-right:20px;">
    <a href="<?= SROOT . 'order/view_orders' ?>">
        <button type="button" class="btn btn-danger">
            <strong> New Orders</strong> <span class="badge badge-light" id="nooforders"><?= $this->nooforders ?></span>
        </button>
    </a>
</div>

<div class="row" style="width:100%;margin-top:30px;">
    <div class="col-md-2">
        <div class="card p-2" style="width:90%;margin-left:auto;margin-right:auto; background-color:rgb(157,37,37,.93);  font-family:Aclonica">
            <?php $this->partial('search', 'food_filters'); ?>
        </div>
    </div>
    <div class="col-md-7">

        <div class="row" style="width: 100%; height: auto; background-color: #f0efe3;font-size:0.5rem; border-bottom: 6px solid #9d2525;padding:10px; padding-bottom: 0px;">
            <div class="row" style="padding-right: 0px; padding-bottom: 0; margin-bottom: 0;">
                <div class="col-md-6">
                    <div id="carousel1" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel1" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel1" data-slide-to="1"></li>
                            <li data-target="#carousel1" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" style="height:14rem;">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="http://pinegrow.com/placeholders/img11.jpg" alt="First slide">

                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="http://pinegrow.com/placeholders/img18.jpg" alt="Second slide">

                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="http://pinegrow.com/placeholders/img16.jpg" alt="Third slide">

                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                        <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                    </div>
                </div>
                <div class="col-md-6 contact-information-row" style="padding-right: 0; ">
                    <div class="row contact-information-row">
                        <div class="contact-info-icon-col text-center col-md-3" style="padding-left:0px;">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="col-md-8" style="font-size:1rem;"> <?= $this->restaurant->restaurant_name ?>
                        </div>
                    </div>
                    <div class="row contact-information-row">
                        <div class="contact-info-icon-col text-center col-md-3" style="padding-left:0px;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="col-md-8" style="font-size:0.6rem;"> <?= $this->restaurant->address ?>
                        </div>
                    </div>
                    <div class="row contact-information-row">
                        <div class="contact-info-icon-col text-center col-md-3" style="padding-left:0px;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="col-md-8" style="font-size:0.8rem;"> <?= $this->restaurant->telephone ?>
                        </div>
                    </div>
                    <div class="row contact-information-row">
                        <div class="contact-info-icon-col text-center col-md-3" style="padding-left:0px;">
                            <i class="fas fa-at"></i>
                        </div>
                        <div class="col-md-8" style="font-size:0.8rem;"> <?= $this->restaurant->email ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid" id="items" style="width: 100%; margin-top:30px;"></div>
        
    </div>
    <div class="col-md-3">
        <div id="restaurant-location-map" style="width:100%;height:16rem; border:3px solid black;"></div>
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
</div>




<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="<?= SROOT ?>temp/restaurant_details_assets/js/Contact-Form-v2-Modal--Full-with-Google-Map.js"></script>

<script src="https://js.api.here.com/v3/3.0/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.0/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-ui.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-mapevents.js"></script>
<script src="<?= SROOT ?>js/masonry.pkgd.min.js"></script>
<script src="<?= SROOT ?>js/addtoorder.js"></script>
<script src="<?= SROOT ?>js/rating.js"></script>

<!-- order notification -->
<script>
    var auto_refresh = setInterval(
        function() {
            $.post(
                `${SROOT}restaurant/no_of_orders`, {
                    'csrf_token': '<?= $token ?>'
                },
                function(resp) {
                    // console.log(resp);
                    $('#nooforders').html(resp);

                }
            );
        }, 1000); // refresh every 10000 milliseconds
</script>

<!-- adding map -->
<script src="<?= SROOT ?>js/map.js"></script>
<script>
    mymap = HMap.getInstance();
    mymap.showPointAndCenter({
        latitude: JSON.parse(<?php echo json_encode($this->restaurant->lat) ?>),
        longitude: JSON.parse(<?php echo json_encode($this->restaurant->lng) ?>)
    }, 'restaurant-location-map', JSON.stringify(<?php echo json_encode($this->restaurant->restaurant_name) ?>));
</script>
<script>
    $(document).ready(function() {
        sendFiltersRestaurant();
    });

    $('form').submit(function(e) {
        sendFiltersRestaurant();
        return false;
    });

    $("body").on("click", ".tag", function(e) {
        sendFiltersRestaurant($(this).attr('id'));
    });

    function goToPage(page) {
        sendFiltersRestaurant(null, page);
    }

    function sendFiltersRestaurant(search=null, page = 0) {
        data = {
            search: search,
            csrf_token: '<?= $token ?>',
            sort_by: $('input[name=sort_by]:checked').val(),
            price_filter: $('input[name=price_filter]').val()
        };
        viewResults(data, 'items', page);
    }

    function viewResults(data, divId, pageNo) {
        console.log("ajax");
        $.post(
            `${SROOT}/restaurant/search/<?= $this->restaurant->id ?>/${pageNo}`,
            data,
            function(resp) {
                // console.log(resp);
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

<?php $this->end(); ?>