<?php
use core\FH;
?>
<div id="AddItem_LoginDark_Background" class="login-dark">
    <form method="post" id="AddItem_Main_LoginBox" class="LoginBox" action="<?= $this->post_action ?>">
        <h2 class="sr-only">Create Item</h2>
        <?= FH::display_errors($this->display_errors) ?>
        <?= FH::csrf_input() ?>
        <div id="AddItem_Logo_Illustration" class="illustration">
            <img src="<?= SROOT ?>assets/img/150YelloLogoOnlyKamu.png" id="AddItem_Logo">
        </div>
        <div class="form-group" id="AddItem_ItemName_FormGroup">
            <input class="form-control TextInput" name="item_name" type="text" placeholder="Item Name" id="AddItem_NameInput" value="<?= $this->item->item_name ?>" onchange="automaticallyAddNameTag()">
        </div>
        <div class="form-group" id="AddItem_Description_FormGroup">
            <input class="form-control" type="text" name="description" id="Additem_DescriptionInput" placeholder="Brief Description" value="<?= $this->item->description ?>">
        </div>
        <div class="form-group" id="AddItem_Price_FormGroup">
            <input class="form-control Number Input" type="number" name="price" id="AddItem_PriceInput" placeholder="Price (Rs.)" step="0.01" min="1.00" value="<?= $this->item->price ?>">
        </div>
        <div class="form-group" id="AddItem_Image_FormGroup">
            <input type="file" name="upload_image" id="upload_image" class="FileInput">
            <small class="form-text text-muted" id="AddItem_ImageInput_Help">Choose an image for the Item (300x200 pixels)</small>
        </div>
        <input class="form-control" type="text" name="image" id="image" hidden>
        <div class="form-group" id="tags">
            <div id="added_tags">

            </div>

            <input hidden id="added_tags_array" name="tag_array" value="<?=json_encode($this->item->tags, true)?>">
            <!-- change text area to something else -->
            <textarea class="form-control" type="text" name="tags" id="AddItem_TagsInput" placeholder="tag" value=""></textarea>
            <button class="btn btn-primary" type="button" id="AddItem_AddTagButton" onclick="addCustomTag()">Add Tag</button>
        </div>
        <div class="form-group" id="AddItem_Button_FormGroup">
            <button class="btn btn-primary" type="submit" id="AddItem_Button">Save</button>
        </div>
    </form>
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
                        <br/>
                        <br/>
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