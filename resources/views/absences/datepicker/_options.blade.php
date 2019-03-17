firstDay: 1,
dateFormat: dateFormat,
minDate: minDate,
maxDate: "+1y",
changeMonth: true,
changeYear: true,
beforeShowDay: function(date)
{
    return editAbsenceUrl ? highlightEditableAbsence(absences, absenceId, date)
                          : disableUnvailableDates(absences, date)
}