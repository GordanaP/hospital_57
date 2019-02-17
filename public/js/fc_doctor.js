/**
 * Highlight the days when doctor is absent from work.
 *
 * @param  {array} drAbsences
 * @param  {moment} date
 * @param  {fullcalendar} cell
 * @param  {string} color
 * @param  {string} dateFormat
 * @return void
 */
function highlightDoctorAbsences(absences, date, cell, color="red", dateFormat = "YYYY-MM-DD")
{
    var fcDay = fromMoment(date, dateFormat);

    $.each(absences, function(index, absence) {
        if (fcDay >= absence.start_at && fcDay <= absence.end_at ) {
            cell.css("background-color", color);
        }
    });
}