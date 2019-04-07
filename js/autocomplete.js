function autoComplete(searchInputValue, searchType = false) {
    $.post(
        `${SROOT}search/auto_complete/` + searchInputValue,
        {
            type: searchType
        },
        function(resp) {
            console.log(resp);
            temp = '';
            for (i = 0; i <= resp.length; i++) {
                temp += '<option value="' + resp[i] + '">' + resp[i] + '</option>';
            }
            document.getElementById('food').innerHTML = (temp);
        }
    );
}