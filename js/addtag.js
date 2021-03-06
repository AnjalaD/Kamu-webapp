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

    addTag(name_tag_value);
}

function addCustomTag(){
    var tag = document.getElementById("AddItem_TagsInput");
    var tag_value = tag.value;

    tag.value = "";

    addTag(tag_value);
}

function addTag(tag_value){
    tag_value = tag_value.trim().toLowerCase();

    if(tag_value != ""){
        if(added_tags.indexOf(tag_value) == -1){
            added_tags.push(tag_value);
    
            var tag_card = document.createElement("div");
            tag_card.setAttribute('class', "card px-1 pb-1 mt-1 ml-1");
            tag_card.setAttribute('style', "display : inline-block; background : transparent;");

            var item_name = document.getElementById("AddItem_NameInput").value.toLowerCase();

            if(tag_value == item_name){
                tag_card.setAttribute('id',"item_name_tag");
            } else {
                tag_card.setAttribute('id',tag_value.concat("_tag"));
            }
    
            var tag_card_name = document.createElement("div");
            tag_card_name.setAttribute('name', "tag_card_name");
            tag_card_name.setAttribute('class', "badge badge-light pt-1");
            tag_card_name.innerHTML = tag_value;
                
            var tag_cancel_button = document.createElement("button");
            tag_cancel_button.setAttribute('type', "button");
            tag_cancel_button.setAttribute('onclick', "deleteTagByButton(this)");
            tag_cancel_button.setAttribute('class', "close pl-1");
            tag_cancel_button.setAttribute('aria-label', "Close");

            var tag_cancel_button_span = document.createElement("span");
            tag_cancel_button_span.setAttribute('aria-hidden', "true");
            tag_cancel_button_span.setAttribute('style', "color : white;");
            tag_cancel_button_span.innerHTML = "&times";

            tag_cancel_button.appendChild(tag_cancel_button_span);
            
            if(tag_value == item_name){
                tag_cancel_button.disabled = true;
                tag_card.setAttribute('data-toggle', "tooltip");
                tag_card.setAttribute('title', "Item name is required as a tag");
            }
    
            tag_card.appendChild(tag_cancel_button);

            tag_card.appendChild(tag_card_name);
    
            var div_added_tags = document.getElementById("added_tags");
    
            div_added_tags.appendChild(tag_card);
    
            updateInput();
        } else {
            //tag already exists
        }

    } else {
        //empty tags cannot be added
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
}

function updateInput(){
    var hidden_input = document.getElementById("added_tags_array");
    hidden_input.value = added_tags.join(',');
}

function loadPreviousTags(previous_tag_array){
     for(var i = 0; i < previous_tag_array.length; i++){
        addTag(previous_tag_array[i]);
    }
}

//returns a new array after removing all elements with the given value in the given array  
function arrayRemove(arr, value) {

    return arr.filter(function(ele){
        return ele != value;
    });
 
}