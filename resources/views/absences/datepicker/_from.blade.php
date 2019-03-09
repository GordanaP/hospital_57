var from = startAt.datepicker({
    @include('absences.datepicker._options'),
    onClose: function(selectedDate)
    {
        endAt.datepicker("option", "minDate", selectedDate);

        clearError('start_at')
    },
});
