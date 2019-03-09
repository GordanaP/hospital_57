firstDay: 1,
dateFormat: "yy-mm-dd",
minDate: minDate,
maxDate: "+1y",
changeMonth: true,
changeYear: true,
beforeShowDay: function(selectedDate)
{
    @if (request()->route()->named('absences.edit'))
        return highlightAbsenceToEdit(absences, absenceId, selectedDate)
    @else
        return disableDoctorAbsences(absences, selectedDate)
    @endif
}