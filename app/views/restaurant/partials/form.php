<?php
use core\FH;
?>

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
                            <input type="text" class="form-control rest_reg_form_input"  name='address' placeholder="Address" value="<?= $this->restaurant->address ?>" required> 
                        </div>
                        <div class="form-group rest_reg_form_input"> 
                            <input type="text" pattern="[0-9]{10}"" class="form-control rest_reg_form_input"  name="telephone" placeholder="telephone" value="<?= $this->restaurant->telephone ?>" required> 
                        </div>
                        <div class="form-group rest_reg_form_input"> 
                            <input type="email" class="form-control rest_reg_form_input"  name="email" placeholder="Email" value="<?= $this->restaurant->email ?>" required> 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group rest_reg_form_input">                                      

                                    <input type="text" class="form-control rest_reg_form_input"  name='lat' id="lat" placeholder="Lat." value="<?= $this->restaurant->lat ?>" style="color:black;" readonly> 
									
								</div>                                                                  
                            </div>
                            <div class="col-md-4">
                                <div class="form-group rest_reg_form_input">                                      

                                    <input type="text" class="form-control rest_reg_form_input"  name='lng' id="lng" placeholder="Lng." value="<?= $this->restaurant->lng ?>" style="color:black;" readonly> 
                                </div>                                                                  
                            </div>
                        </div>                         
                        <div class="form-group"> 
                            <label for="exampleInputFile">Upload Cover Photo</label>                             
                            <input type="file" class="btn btn-default" name="upload_image" id="upload_image" style="color:white;" required>                              
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
                    <button type="submit" form="restaurant_register_form" class="btn btn-primary" style="width: auto;font-family:Aclonica;background-color:#f9a825;border:none;">Register My Restaurant</button>                                          
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