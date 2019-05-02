function addRating(item_id, value) {
    $.post(
        `${SROOT}items/update_rating/${item_id}/${value}`,
        {},
        function (data, textStatus, jqXHR) {
            //somthing
        }
    );
}