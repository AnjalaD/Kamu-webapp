function addToOrder(rid, id, element) {
    $modal = $('#add_to_order');
    $modalBody = $('.modal-body');

    $.post(
        `${SROOT}order/add_to_order/` + rid + '/' + id,
        {},
        function(resp) {
            console.log(resp);
            if(resp=='1'){
                element.innerHTML = 'Item Added';
                element.setAttribute("onclick","");
            }
            else if(resp=='0'){
                $modalBody.html('Please select food from one restaurant!');
                $modal.modal();
                
            }
            else if(resp=='-1'){
                $modalBody.html('Please login as customer!');
                $modal.modal();
            }
        }
    );
}``