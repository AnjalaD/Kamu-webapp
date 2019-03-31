function addToOrder(rid, id,element) {
    $.ajax({
        type: 'POST',
        url: '/kamu_1.0/exported/order/add_to_order/' + rid + '/' + id ,
        data: {
        },
        success: function(resp) {
            console.log(resp);
            if(resp=='1'){
                element.innerHTML = 'Remove Item';
            }
            else if(resp=='0'){
                window.alert('Please select food from one restaurant');
            }
            else if(resp=='-1'){
                window.alert('Please Login');
            }
            if(!resp) window.alert('Please select food from one restaurant');
        }
    });
}