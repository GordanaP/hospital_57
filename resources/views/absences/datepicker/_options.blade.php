firstDay: 1,
dateFormat: "yy-mm-dd",
minDate: 0,
changeMonth: true,
changeYear: true,
beforeShowDay: function(date)
{
    return markDoctorAbsences(absences, date);
}