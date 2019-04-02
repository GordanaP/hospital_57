selectRange: function(e) {

    var startDate = formatJsDate(e.startDate);
    var endDate = formatJsDate(e.endDate);
    var year = e.startDate.getFullYear();
    var today = formatJsDate(new Date());
    var currentYear = new Date().getFullYear()
    var maxDate = formatJsDate(new Date((currentYear+2), 11, 31));

    var range = getDatesArray(startDate, endDate)

    $.ajax({
        url: absencesIndexUrl,
        type: "GET",
        success: function(response)
        {
            var absences = response.data;

            if(startDate >= today && startDate <= maxDate)
            {
                if ((range.length > 1 && isValidAbsenceDatesRange(absences, range, year)) ||
                    (range.length == 1 && absenceStartIsNotHoliday(e.startDate))) {

                        javascript:location.href = doctorAbsencesCreateUrl+"?start_at="+startDate+"&end_at="+endDate
                }
                else {

                    alert('Invalid date!')
                }
            }
            else
            {
                alert('Selected dates are outside the allowed dates range!')
            }
        }
    });
}