<?php $this->set_title('Add New Items'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=SROOT?>/css/croppie.css">
<script src="<?= SROOT ?>js/croppie.js"></script>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2">
    <h3 class="center">Add New Restaurant</h3>
    <?php $this->partial('restaurant', 'form'); ?>
</div>
<div id="uploaded_image"></div>

<div id="uploadimageModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Upload & Crop Image</h4>
      		</div>
      		<div class="modal-body">
        		<div class="row">
  					<div class="col-md-8 text-center">
						  <div id="image_demo" style="width:350px; margin-top:30px"></div>
  					</div>
  					<div class="col-md-4" style="padding-top:30px;">
  						<br />
  						<br />
  						<br/>
						  <button class="btn btn-success crop_image">Crop & Upload Image</button>
					</div>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
    </div>
</div>

<script>  
    $(document).ready(function(){
    
        $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
          width:400,
          height:400,
          type:'square' //circle
        },
        boundary:{
          width:450,
          height:450
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
          $('#uploaded_image').html(data);
        })
      });
    
    });  
    </script>
<?php $this->end(); ?>