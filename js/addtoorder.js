function addToOrder(rid, id, element) {
    $modal = $('#add_to_order');
    $modalBody = $('.modal-body');
    $(element).attr('disabled');
    // console.log(element);
    $.post(
        `${SROOT}order/add_to_order/` + rid + '/' + id,
        {},
        function(resp) {
            // console.log(resp);
            if(resp=='1'){
                $(element).removeAttr('disabled').removeClass('btn-info').addClass('btn-danger').html('Remove Item');
                $(element).attr("onclick","removeFromOrder("+rid+","+id+","+"this)");
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
}

function removeFromOrder(rid, id, element)
{
    $(element).attr('disabled');
    $.post(
        `${SROOT}order/remove_from_order/` + id,
        {},
        function(resp) {
            $(element).removeAttr('disabled').removeClass('btn-danger').addClass('btn-info').html('Add to Order');
            $(element).attr("onclick","addToOrder("+rid+","+id+","+"this)");
        }
    );
}