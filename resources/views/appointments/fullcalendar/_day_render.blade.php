dayRender: function (date, cell) {

    highlightHolidays(date, cell)

    doctorExists ? highlightDoctorAbsences(absences, date, cell) : ''
}