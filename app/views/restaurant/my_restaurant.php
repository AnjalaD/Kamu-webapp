<?php
use core\FH;

$token = FH::generate_token();
?>

<?php $this->set_title($this->restaurant->restaurant_name); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">

<!-- styles for map -->
<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.0/mapsjs-ui.css?dp-version=1542186754" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


<link rel="stylesheet" href="<?= SROOT ?>css/restaurant-view.css">

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="row pull-right" style="margin-top:10px;padding:15px;margin-right:20px;">
    <a href="<?= SROOT . 'order/view_orders' ?>" >
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
    <div class="col-md-7" >

        <div class="row" style="width: 100%; height: auto; background-color: #f0efe3; border-bottom: 6px solid #9d2525;padding:10px; padding-bottom: 0px;">
            <div class="row" style="padding-right: 0px; padding-bottom: 0; margin-bottom: 0;">
                <div class="col-md-6" >
                    <div id="carousel1" class="carousel slide" data-ride="carousel" >
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
                <div class="col-md-6 contact-information-row" style="padding-right: 0;">
                    <div class="row contact-information-row">
                        <div class="contact-info-icon-col text-center col-md-3">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="col-md-8"> <?= $this->restaurant->restaurant_name ?>
                        </div>
                    </div>
                    <div class="row contact-information-row">
                        <div class="contact-info-icon-col text-center col-md-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="col-md-8"> <?= $this->restaurant->address ?>
                        </div>
                    </div>
                    <div class="row contact-information-row">
                        <div class="contact-info-icon-col text-center col-md-3">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="col-md-8"> <?= $this->restaurant->telephone ?>
                        </div>
                    </div>
                    <div class="row contact-information-row">
                        <div class="contact-info-icon-col text-center col-md-3">
                            <i class="fas fa-at"></i>
                        </div>
                        <div class="col-md-8"> <?= $this->restaurant->email ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h1>Item cards here</h1>
        </div>

    </div>
    <div class="col-md-3">
        <div id="restaurant-location-map" style="width:100%;height:16rem;"></div>
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

<!-- order notification -->
<script>
    var auto_refresh = setInterval(
        function() {
            $.post(
                `${SROOT}restaurant/no_of_orders`, {
                    'csrf_token': '<?= $token ?>'
                },
                function(resp) {
                    console.log(resp);
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


<?php $this->end(); ?>