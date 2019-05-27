<?php
use core\FH;
?>

<!-- <div id="AddItem_LoginDark_Background" class="login-restaurant-dark">
	<form method="post" id="AddItem_Main_LoginBox" class="LoginBox" action=<?= $this->post_action ?>>
		<?= FH::csrf_input() ?>
		<?= FH::display_errors($this->display_errors) ?>
		<div id="AddItem_Logo_Illustration" class="illustration">
			<img src="<?=SROOT?>assets/img/150YelloLogoOnlyKamu.png" id="AddItem_Logo">
		</div>
		<div class="row AddRes_Row">
			<div class="col-md-6 AddRes_coloumn">
				<div class="form-group" id="AddRes_Name_FormGroup">
					<input class="form-control TextInput" type="text" name="restaurant_name" placeholder="Restaurent Name" id="AddRes_NameInput" value="<?= $this->restaurant->restaurant_name ?>">
				</div>
				<div class="form-group" id="AddRes_Address_FormGroup">
					<input class="form-control TextInput" type="text" name="address" id="AddRes_AddressInput" placeholder="Address" value="<?= $this->restaurant->address ?>">
				</div>
				<div class="form-group" id="AddRes_Tele_FormGroup">
					<input class="form-control TextInput" type="text" name="telephone" id="AddRes_TeleInput" placeholder="Telephone No" value="<?= $this->restaurant->telephone ?>">
				</div>
				<div class="form-group" id="AddRes_Email_FormGroup">
					<input class="form-control TextInput" type="email" name="email" id="AddRes_EmailInput" placeholder="Email" value="<?= $this->restaurant->email ?>">
				</div>
			</div>
			<div class="col-md-6 AddRes_coloumn Column_Map">
				<div class="pg-empty-placeholder AddRes_Map" id="map-input"></div>
				<label class="AddRess_direction Latitude" name="lat"><?= $this->restaurant->lat ?></label>
				<label class="AddRess_direction Longiitude" name="lng"><?= $this->restaurant->lng ?></label>
			</div>
		</div>
		<div class="form-group" id="AddItem_Image_FormGroup">
			<input type="file" id="AddItem_ImageInput" class="FileInput" name="upload_image">
			<small class="form-text text-muted" id="AddItem_ImageInput_Help">Choose an image for the Restaurent (300x200 pixels)</small>
			<div class="AddRes_Thumbnail">
				<div class="col-md-3">
					<a href="#">
						<img class="w-100 img-thumbnail" src="http://pinegrow.com/placeholders/img17.jpg" alt="">
					</a>
				</div>
			</div>
		</div>
		<?= FH::input_block('text', 'image', 'image', '', [], ['hidden' => 'true']); ?>
		<div class="form-group" id="AddItem_Button_FormGroup">
			<button class="btn btn-primary AddRes_Button" type="submit" id="AddRes_Button">Register My Restaurant</button>
		</div>
	</form>
</div> -->



<div class="restaurant_register_box" style="width:80%;margin-left:auto;margin-right:auto;">
			<div class="row" style="margin-bottom: 50px;">
			<div class="col">
				<img src="<?= SROOT.'/assets/img/150YelloLogoOnlyKamu.png' ?>"/>
				</div>
            </div>
            <div class="row" style="margin-top: 10px; margin-bottom: 20px;">
				<div class="col-md-6" style="border-right: 3px solid #f9a825;">
				
                    <form id="restaurant_register_form" method="post" action=<?= $this->post_action ?>> 
					<?= FH::csrf_input() ?>
					<?= FH::display_errors($this->display_errors) ?>
                        <div class="form-group rest_reg_form_input"> 
                            <input type="text" class="form-control rest_reg_form_input"  name="restaurant_name" placeholder="Restaurant name" value="<?= $this->restaurant->restaurant_name ?>" required> 
                        </div>
                        <div class="form-group rest_reg_form_input"> 
                            <input type="email" class="form-control rest_reg_form_input"  name='address' placeholder="Address" value="<?= $this->restaurant->address ?>" required> 
                        </div>
                        <div class="form-group rest_reg_form_input"> 
                            <input type="text" class="form-control rest_reg_form_input"  name="telephone" placeholder="telephone" value="<?= $this->restaurant->telephone ?>" required> 
                        </div>
                        <div class="form-group rest_reg_form_input"> 
                            <input type="text" class="form-control rest_reg_form_input"  name="email" placeholder="Email" value="<?= $this->restaurant->email ?>" required> 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group rest_reg_form_input">                                      

                                    <input type="text" class="form-control rest_reg_form_input"  name='lat' id="lat" placeholder="Lat." value="<?= $this->restaurant->lat ?>" disabled=true style="color:black;" required> 
									
								</div>                                                                  
                            </div>
                            <div class="col-md-4">
                                <div class="form-group rest_reg_form_input">                                      

                                    <input type="text" class="form-control rest_reg_form_input"  name='lng' id="lng" placeholder="Lng." value="<?= $this->restaurant->lng ?>" disabled=true style="color:black;"required> 
                                </div>                                                                  
                            </div>
                        </div>                         
                        <div class="form-group"> 
                            <label for="exampleInputFile">Upload Cover Photo</label>                             
                            <input type="file" class="btn btn-default" name="upload_image" id="upload_image" style="color:white;">                              
							<?= FH::input_block('text', 'image', 'image', '', [], ['hidden' => 'true']); ?>
						</div>                                                  
                    </form>                     
                </div>
                <div class="col-md-6">
                    <div class="pg-empty-placeholder" style="height: 300px;" id="map-input"></div>                     
                </div>
			</div>
			
            <div class="row text-center" style="margin-bottom: 30px;">
                <div class="col-md-12">
                    <button type="submit" form="restaurant_register_form" class="btn btn-primary" style="width: 30%;font-family:Aclonica;background-color:#f9a825;border:none;">Register My Restaurant</button>                                          
                </div>
            </div>
        </div>


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