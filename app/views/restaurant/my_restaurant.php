<?php $this->set_title($this->restaurant->restaurant_name); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
<!-- styles for map -->
<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.0/mapsjs-ui.css?dp-version=1542186754" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    

<link rel="stylesheet" href="<?= SROOT ?>temp/restaurant_details_assets/css/Contact-Form-v2-Modal--Full-with-Google-Map.css">
<link rel="stylesheet" href="<?= SROOT ?>temp/restaurant_details_assets/css/dh-row-text-image-right-responsive.css">
<link rel="stylesheet" href="<?= SROOT ?>temp/restaurant_details_assets/css/OcOrato---Contact-Information-bar-line-with-e-mail-link-1.css">
<link rel="stylesheet" href="<?= SROOT ?>temp/restaurant_details_assets/css/styles.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div>
    <div class="container-fluid">
        <hr>
        <div  id="contactForm">
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <h2 class="h4"><i class="fa fa-location-arrow"></i> Locate Us</h2>
                    <div class="form-row">
                        <div class="col-12">
                            <div class="static-map" id="restaurant_map_container" style="height:20rem; ">

                            </div>
                        </div>
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <h2 class="h4"><i class="fa fa-user"></i> Our Info</h2>
                            <div><span id="restaurant_name"><strong><?= $this->restaurant->restaurant_name ?></strong></span></div>
                            <div><span id="email"><?= $this->restaurant->email ?></span></div>
                            <div><span id="url">www.awebsite.com</span></div>
                            <hr class="d-sm-none d-md-block d-lg-none">
                        </div>
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <h2 class="h4"><i class="fa fa-location-arrow"></i> Our Address</h2>
                            <div><span id="address"><?= $this->restaurant->address ?></span></div>
                            <div><i class="fa fa-phone"></i><span id="telephone"><?= $this->restaurant->telephone ?></span></div>
                            <hr class="d-sm-none">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <section>
                        <div class="jumbotron" style="margin:0px;padding:0px;">
                            <p class="text-center" style="margin:0px;font-size:39px;font-family:Quicksand, sans-serif;color:rgb(228,21,21);">Call now: <strong><?= $this->restaurant->telephone ?></strong> or <a href="#">leave a reply</a></p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<div><small class="form-text text-muted" style="color:rgb(241,206,19);font-size:22px;">Item cards here</small></div>




<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="<?= SROOT ?>temp/restaurant_details_assets/js/Contact-Form-v2-Modal--Full-with-Google-Map.js"></script>
<script src="https://js.api.here.com/v3/3.0/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.0/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-ui.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-mapevents.js"></script>

<!-- adding map -->
<script src="<?=SROOT ?>js/map.js"></script>
<script>
    mymap = HMap.getInstance();
    mymap.showPointAndCenter({latitude:JSON.parse(<?php echo json_encode($this->restaurant->lat) ?>),longitude:JSON.parse(<?php echo json_encode($this->restaurant->lng) ?>)},'restaurant_map_container',JSON.stringify(<?php echo json_encode($this->restaurant->restaurant_name) ?>));
</script>


<?php $this->end(); ?>