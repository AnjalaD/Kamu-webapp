<?php $this->set_title('Edit Item'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=SROOT?>css/croppie.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="<?=SROOT?>css/styles.min.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
    <?php $this->partial('items', 'form'); ?>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="<?= SROOT ?>js/croppie.js"></script>
<script>  
    $(document).ready(function(){
    
        $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
          width:200,
          height:200,
          type:'square' //circle
        },
        boundary:{
          width:300,
          height:300
        }
      });
    
      $('#upload_image').on('change', function(){
        var reader = new FileReader();
        reader.onload = function (event) {
          $image_crop.croppie('bind', {
            url: event.target.result
          }).then(function(){
            console.log('jQuery bind complete');
          });
        }
        reader.readAsDataURL(this.files[0]);
        $('#uploadimageModal').modal('show');
      });
    
      $('.crop_image').click(function(event){
        $image_crop.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        }).then(function(response){
          $('#image').attr('value', response);
          $('#uploadimageModal').modal('hide');
        })
      });
    
    });  
    </script>
<?php $this->end(); ?>