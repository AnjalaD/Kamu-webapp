function getItemCards(data, divId){
    $.post(
        '/mvc/search/filter/1', 
        data,
        function (resp) {
            if(!resp){
                $('#'+divId).html("<p>No items found</p>");
            }else{
                $('#'+divId).html(resp);
            }
        }
    );
}