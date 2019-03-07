var from = startAt.datepicker({

    @include('absences.datepicker._options')

}).on('change', function(){

    endAt.datepicker("option", "minDate", getDate(this));

    clearError('start_at')
});