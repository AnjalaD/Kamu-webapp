<?php $this->set_title('Submit Restautant Details'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=SROOT?>css/styles.min.css">
<link rel="stylesheet" href="<?= SROOT ?>css/croppie.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="row">
    <div class="col-md-5 col-md-offset-2">
        <h3 class="center">Add New Restaurant</h3>
        <?php $this->partial('restaurant', 'form'); ?>
    
        <div id="uploaded_image"></div>
    </div>
    <div class="col-md-4">
        <div class="static-map" style="width:auto; height:20rem; " id='map-input-container'></div>
    </div>
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
    mymap.showDraggablePoint({latitude: 7.162,longitude: 80.7}, 'map-input-container', 'lat', 'lng');
</script>

<?php $this->end(); ?>