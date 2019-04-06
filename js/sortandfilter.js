function getItemCards(data, divId){
    $.post(
        'mvc/search/fiters/food', 
        data,
        function (resp) {
            console.log(resp);
            if(!resp){
                $('#'+divId).html("<p>No items found</p>");
            }else{
                $('#'+divId).html(resp);
            }
        }
    );
}