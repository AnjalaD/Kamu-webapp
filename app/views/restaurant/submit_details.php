<?php $this->set_title('Submit Restautant Details'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>css/croppie.css">
<link rel="stylesheet" href="<?= SROOT ?>css/add_restaurant.css">
<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.0/mapsjs-ui.css?dp-version=1542186754" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div style="background-image:url('<?= SROOT ?>assets/img/54-Verbazingwekkend-Restaurant-Nederlandse-Keuken.jpg'); width:100%;height:1000px;">
    <div style="padding-top:100px;" class="text-center">
    <?php $this->partial('restaurant', 'form'); ?>
    </div>
    <div id="uploaded_image"></div>
</div>

<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="<?= SROOT ?>js/croppie.js"></script>
<script src="<?= SROOT ?>js/croppie-function.js"></script>

<!-- adding map -->
<script src="https://js.api.here.com/v3/3.0/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.0/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-ui.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-mapevents.js"></script>
<script src="<?= SROOT ?>js/map.js"></script>
<script>
    mymap = HMap.getInstance();
    mymap.showDraggablePoint({
        latitude: 7.162,
        longitude: 80.7
    }, 'map-input', 'lat', 'lng');
</script>

<?php $this->end(); ?>