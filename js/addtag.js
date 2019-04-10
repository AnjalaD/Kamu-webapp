var added_tags = [];

function addTag(){
    //need to restrict adding multiple tags with the same name

    console.log("add tag called");

    var tag = document.getElementById("AddItem_TagsInput");
    var tag_value = tag.value;

    added_tags.push(tag_value);

    tag.value = "";

    var tag_card = document.createElement("div");
    tag_card.setAttribute('class', "card");
    tag_card.setAttribute('style', "display : inline-block;");

    var tag_card_name = document.createElement("div");
    tag_card_name.setAttribute('name', "tag_card_name");
    tag_card_name.innerHTML = tag_value;

    var tag_cancel_button = document.createElement("button");
    tag_cancel_button.setAttribute('type', "button");
    tag_cancel_button.setAttribute('onclick', "deleteTag(this)");
    tag_cancel_button.setAttribute('class', "btn btn-danger");
    tag_cancel_button.innerHTML = "X";

    tag_card.appendChild(tag_card_name);
    tag_card.appendChild(tag_cancel_button);

    var div_added_tags = document.getElementById("added_tags");

    div_added_tags.appendChild(tag_card);

    updateInput();

    console.log(added_tags);
}

function deleteTag(btn){
    var tag_card = btn.parentNode;

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

//returns a new array after removing all elements with the given value in the given array  
function arrayRemove(arr, value) {

    return arr.filter(function(ele){
        return ele != value;
    });
 
 }