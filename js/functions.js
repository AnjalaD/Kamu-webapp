function autoComplete(searchInput, searchType = false) {
    $.ajax({
        type: 'POST',
        url: '/mvc/search/auto_complete/' + searchInput.value,
        data: {
            type: searchType
        },
        success: function(resp) {
            temp = '';
            for (i = 0; i < resp.length; i++) {
                temp += '<option value="' + resp[i] + '">' + resp[i] + '</option>';
            }
            document.getElementById('food').innerHTML = (temp);
        }
    });
}