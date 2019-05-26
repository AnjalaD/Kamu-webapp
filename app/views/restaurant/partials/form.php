<?php
use core\FH;
?>







<form class="form-group" method="post" action=<?= $this->post_action ?>>
	<?= FH::display_errors($this->display_errors) ?>
	<?= FH::csrf_input() ?>
	<?= FH::input_block('text', 'Name', 'restaurant_name', $this->restaurant->restaurant_name, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
	<?= FH::input_block('text', 'Address', 'address', $this->restaurant->address, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
	<?= FH::input_block('text', 'Telephone', 'telephone', $this->restaurant->telephone, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
	<?= FH::input_block('text', 'Email', 'email', $this->restaurant->email, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
	<?= FH::input_block('text', 'Location-lng', 'lng', $this->restaurant->lng, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
	<?= FH::input_block('text', 'Location-lat', 'lat', $this->restaurant->lat, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
	<?= FH::input_block('file', 'Upload Image', 'upload_image', '', ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>

	<?= FH::input_block('text', 'image', 'image', '', [], ['hidden' => 'true']); ?>
	<?= FH::input_block('submit', '', 'submit', 'submit', ['class' => 'btn btn-primary'], ['class' => 'form-group col-md-6']); ?>
</form>



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
						<br />
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
