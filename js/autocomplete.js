function autoComplete(searchInput, searchType = false) {
    $.post(
        '/mvc/search/auto_complete/' + searchInput.value,
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