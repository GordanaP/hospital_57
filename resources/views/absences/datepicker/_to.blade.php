var to = endAt.datepicker({

    @include('absences.datepicker._options')

}).on("change", function() {

    startAt.datepicker("option", "maxDate", getDate(this));

    clearError('end_at')
});