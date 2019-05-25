function autoComplete(searchInputValue, searchType = false) {
    if(!searchInputValue){
        console.log('error');
        return;
    }
    $.post(
        `${SROOT}search/auto_complete/` + searchInputValue,
        {
            type: searchType
        },
        function(resp) {
            temp = '';
            for (i = 0; i <= resp.length; i++) {
                if(resp[i]==undefined) continue;
                temp += '<option value="' + resp[i] + '">' + resp[i] + '</option>';
            }
            document.getElementById('food').innerHTML = (temp);
        }
    );
}