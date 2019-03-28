function addToOrder(rid, id) {
    $.ajax({
        type: 'POST',
        url: '/mvc/order/add_to_order/' + rid + '/' + id ,
        data: {
        },
        success: function(resp) {
            console.log(resp);
            if(!resp) window.alert('Please select food from one restaurant');
        }
    });
}