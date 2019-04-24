// not completed
function addRating(item_id, value) {
    $.post(
        `${SROOT}rating/${item_id}/${value}`,
        {},
        function (data, textStatus, jqXHR) {
            
        }
    );
}