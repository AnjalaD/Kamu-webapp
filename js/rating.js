function addRating(item_id, value) {
    $.post(
        `${SROOT}items/update_rating/${item_id}/${value}`,
        {'csrf_token': '<?= $token ?>'},
        function (data, textStatus, jqXHR) {
            //somthing
        }
    );
}