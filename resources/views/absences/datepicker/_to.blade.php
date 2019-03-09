var to = endAt.datepicker({
    @include('absences.datepicker._options'),
    onClose: function(selectedDate)
    {
        startAt.datepicker("option", "maxDate", selectedDate);

        clearError('end_at')
    }
});
