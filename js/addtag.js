var added_tags = [];
//var previous_name_tag_value = "";

document.getElementById("AddItem_TagsInput")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("AddItem_AddTagButton").click();
    }
});

function automaticallyAddNameTag() {
    var name_tag = document.getElementById("AddItem_NameInput");
    var name_tag_value = name_tag.value;

    var previous_name_tag = document.getElementById("item_name_tag");
    if(previous_name_tag != null){
        deleteTag(previous_name_tag);
    }
        
    //previous_name_tag_value = name_tag_value;

    addTag(name_tag_value);
}

function addCustomTag(){
    console.log("add tag called");

    var tag = document.getElementById("AddItem_TagsInput");
    var tag_value = tag.value;

    tag.value = "";

    addTag(tag_value);
}

function addTag(tag_value){
    //need to restrict the max length of a tag

    console.log("add custom tag called");

    tag_value = tag_value.trim().toLowerCase();

    if(tag_value != ""){
        if(added_tags.indexOf(tag_value) == -1){
            added_tags.push(tag_value);
    
            var tag_card = document.createElement("div");
            tag_card.setAttribute('class', "card");
            tag_card.setAttribute('style', "display : inline-block;");

            var item_name = document.getElementById("AddItem_NameInput").value.toLowerCase();

            if(tag_value == item_name){
                tag_card.setAttribute('id',"item_name_tag");
            } else {
                tag_card.setAttribute('id',tag_value.concat("_tag"));
            }
    
            var tag_card_name = document.createElement("div");
            tag_card_name.setAttribute('name', "tag_card_name");
            tag_card_name.innerHTML = tag_value;
                
            var tag_cancel_button = document.createElement("button");
            tag_cancel_button.setAttribute('type', "button");
            tag_cancel_button.setAttribute('onclick', "deleteTagByButton(this)");
            tag_cancel_button.setAttribute('class', "btn btn-danger");
            tag_cancel_button.innerHTML = "X";
            if(tag_value == item_name){
                tag_cancel_button.disabled = true;
                tag_cancel_button.setAttribute('data-toggle', "tooltip");
                tag_cancel_button.setAttribute('title', "Item name is required as a tag");
            }
    
            tag_card.appendChild(tag_card_name);
            tag_card.appendChild(tag_cancel_button);
    
            var div_added_tags = document.getElementById("added_tags");
    
            div_added_tags.appendChild(tag_card);
    
            updateInput();
    
            console.log(added_tags);
        } else {
            //message to say that tag already exists
        }

    } else {
        //message to say that empty tags cannot be added
    }
}

function deleteTagByButton(btn){
    var tag_card = btn.parentNode;

    deleteTag(tag_card);
}

function deleteTag(tag_card){
    
    var tag_card_name = tag_card.querySelectorAll('[name=tag_card_name]')[0];
    var tag_value = tag_card_name.innerHTML;

    added_tags = arrayRemove(added_tags, tag_value);

    tag_card.parentNode.removeChild(tag_card);

    updateInput();

    console.log(added_tags);
}

function updateInput(){
    var hidden_input = document.getElementById("added_tags_array");
    hidden_input.value = added_tags.join(',');

    console.log(hidden_input.value);
}

function loadPreviousTags(previous_tag_array){
    console.log(previous_tag_array);

    for(var i = 0; i < previous_tag_array.length; i++){
        console.log("inside loop");
        addTag(previous_tag_array[i]);
    }
}

//returns a new array after removing all elements with the given value in the given array  
function arrayRemove(arr, value) {

    return arr.filter(function(ele){
        return ele != value;
    });
 
}