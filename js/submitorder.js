// $(function () {
//     $('#datepicker').datetimepicker({
//         format: 'L',
//         minDate: moment(),
//         maxDate: moment().add(3, 'd').toDate()

//     });
// });

// $(function () {
//     $('#timepicker').datetimepicker({
//         format: 'LT',
//         minDate: moment(),
//         maxDate: moment().add(3, 'd').toDate()
//     });
// });

$(function () {
    $('#datetimepicker1').datetimepicker({
        minDate: moment(),
        maxDate: moment().add(7, 'd').toDate(),
        sideBySide: true
    });
});