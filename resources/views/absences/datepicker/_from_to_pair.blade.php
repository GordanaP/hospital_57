var from = startAt.datepicker({
    @include('absences.datepicker._options'),
}).on('change', function(){
    endAt.datepicker("option", "minDate", getDate(this));
});

var to = endAt.datepicker({
    @include('absences.datepicker._options'),
}).on("change", function(){
    startAt.datepicker("option", "maxDate", getDate(this));
});

function getDate(datepicker) {
    var date;
    var dateFormat = "yy-mm-dd";

    try{
        date = $.datepicker.parseDate(dateFormat, datepicker.value);
    } catch (error) {
        date = null
    }

    return date;
}
