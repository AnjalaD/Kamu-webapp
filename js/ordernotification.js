var auto_refresh = setInterval(
    function () {

        $.post(
            `${SROOT}restaurant/no_of_orders`,
            function (resp) {
                console.log(resp);
                $('#nooforders').html(resp);

            }
        );
    }, 1000); // refresh every 10000 milliseconds