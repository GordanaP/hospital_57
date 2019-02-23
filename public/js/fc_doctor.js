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
function highlightDoctorAbsences(drAbsences, date, cell, color="red", dateFormat = "YYYY-MM-DD")
{
    var fcDay = fromMoment(date, dateFormat);
    var dates = []

    for (var i = 0; i < drAbsences.length; i++) {
        if (fcDay >= drAbsences[i].start_at && fcDay <= drAbsences[i].end_at ) {
            cell.css("background-color", color);
        }
    }
}

/**
 * Get the doctor's business hours.
 *
 * @param  {array} drBusinessDays
 * @return {array}
 */
function drWorkHoursArray(drWorkDays)
{
    var hours = [];

    for (var i = 0; i < drWorkDays.length; i++) {

        hours.push(drWorkDays[i].id, drWorkDays[i].hour.start_at, drWorkDays[i].hour.end_at);
    }

    var chunks = chunkArray(hours, 3);

    var hoursArray = [];

    for (var i = 0; i < chunks.length; i++) {

        hoursArray[i] = {
            'dow': [chunks[i][0]],
            'start': chunks[i][1],
            'end': chunks[i][2],
        }
    }

    return hoursArray;
}

/**
 * Determine if the date is the doctor's working day.
 *
 * @param  {array}  doctorWorkingDays
 * @param  {moment}  date
 * @return {boolean}
 */
function isDoctorWorkDay(drWorkDays, date)
{
    var day = date.day();

    return isInArray(day, drWorkDays);
}

/**
 * Determine if the selected hour is inside the doctor's working hours.
 *
 * @param  {array}  drBusinessHoursArray
 * @param  {moment}  date
 * @param  {string}  dateFormat
 * @param  {string}  timeFormat
 * @return {boolean}
 */
function isDoctorWorkHour(drWorkHoursArray, date, dateFormat="YYYY-MM-DD", timeFormat="HH:mm")
{
    var validDate = ! isPastDate(date, dateFormat);
    var day = date.day();
    var time = date.format(timeFormat);

    for (var i = 0; i < drWorkHoursArray.length; i++) {

        var dow = drWorkHoursArray[i].dow;
        var validHour = dow.indexOf(day) == 0 && time >= drWorkHoursArray[i].start && time < drWorkHoursArray[i].end;

        if(validHour)
        {
            return validDate ? true : '';
        }
    }
}

/**
 * Determine if the date is not during the doctor's absence.
 *
 * @param  {array}  drAbsences
 * @param  {moment}  date
 * @param  {string}  dateFormat
 * @return {boolean}
 */
function isNotDoctorAbsence(absences, date, dateFormat="YYYY-MM-DD")
{
    var absenceDays = [];

    var fcDay = fromMoment(date, dateFormat);

    $.each(absences, function(index, absence) {
        if (fcDay >= absence.start_at && fcDay <= absence.end_at ) {

            absenceDays.push(fcDay)
        }
    });

    return absenceDays.length < 1;
}

/**
 * Determine if the selected date and/or time is within the business standard operating time.
 *
 * @param  {moment}  date
 * @param  {string}  view
 * @param  {string}  open
 * @param  {string}  close
 * @param  {string}  dateFormat
 * @param  {string}  timeFormat
 * @return {boolean}
 */
function isBusinessOperatingTime(date, view, weekendOpen, weekendClose, dateFormat = "YYYY-MM-DD", timeFormat = "HH:mm")
{
    return isStandardOperatingTime(date, dateFormat)
           && isWeekendOperatingTime(date, view, weekendOpen, weekendClose, timeFormat);
}

/**
 * Chunk an array
 *
 * @param  {array} myArray
 * @param  {int} chunkSize
 * @return {array}
 */
function chunkArray(myArray, chunkSize)
{
    var index = 0;
    var arrayLength = myArray.length;
    var tempArray = [];

    for (index = 0; index < arrayLength; index += chunkSize) {

        myChunk = myArray.slice(index, index+chunkSize);

        tempArray.push(myChunk);
    }

    return tempArray;
}

/**
 * Determine if a value is in array.
 *
 * @param  mixed  value
 * @param  array  array
 * @return boolean
 */
function isInArray(value, array)
{
    return $.inArray(value, array) !== -1;
}

/**
 * Determine if the selected date is in the past.
 *
 * @param  {moment}  date
 * @param  {string}  dateFormat
 * @return {Boolean}
 */
function isPastDate(date, dateFormat = "YYYY-MM-DD")
{
    var selectedDate = date.format(dateFormat);
    var today = moment().format(dateFormat);

    return selectedDate < today;
}

/**
 * Determine if the business operates on a selected date/day.
 *
 * @param  {moment}  date
 * @param  {string}  dateFormat
 * @return {boolean}
 */
function isStandardOperatingTime(date, dateFormat = "YYYY-MM-DD")
{
    if(isPastDate(date, dateFormat))
    {
        return swalMessage('The appointment cannot be scheduled in the past!');
    }
    else if (isSunday(date))
    {
        return swalMessage('The business does not operate on Sunday.');
    }
    else
    {
        return true;
    }
}

/**
 * Determine if the selected time is within the business weekend operating time.
 *
 * @param  {moment}  date
 * @param  {string}  view
 * @param  {string}  open
 * @param  {string}  close
 * @param  {string}  timeFormat
 * @return {boolean}
 */
function isWeekendOperatingTime(date, view, open, close, timeFormat = "HH:mm")
{
    if(isSaturday(date) && view.name !== 'month' && ! isBusinessHour(date, open, close, timeFormat))
    {
        return swalMessage('The business operates between ' + open + ' and' + close + ' on Saturday');
    }
    else
    {
        return true;
    }
}

/**
 * Get the sweetAlert customized message.
 *
 * @param  {string} text
 * @param  {string} type
 * @return {mixed}
 */
function swalMessage(text, type='warning')
{
    swal({
        type: type,
        text: text,
    });
}

/**
 * Determine if a day is Saturday.
 *
 * @param  {moment}  date
 * @return {boolean}
 */
function isSaturday(date)
{
    return date.day() == 6;
}

/**
 * Determine if the business is open.
 *
 * @param  {moment} date
 * @param  {string}  businessOpen
 * @param  {string}  businessClose
 * @param  {string}  timeFormat
 * @return {boolean}
 */
function isBusinessHour(date, businessOpen, businessClose, timeFormat = "HH:mm")
{
    var time = fromMoment(date, timeFormat);

    return time >= businessOpen && time < businessClose;
}

/**
 * Determine if the selected date is not a holiday.
 *
 * @param  {moment}  date
 * @param  {string}  dateFormat
 * @return {boolean}
 */
function isBusinessDay(date, dateFormat = "YYYY-MM-DD")
{
    var holidays = getHolidayDays(date, dateFormat);
    var dateFormatted = fromMoment(date, dateFormat);

    return isNotHoliday(dateFormatted, holidays)
        ? true : swalMessage('The business does not operate on public holiday.')
}

/**
 * Get holiday days.
 *
 * @param  {moment} date
 * @param  {string} dateFormat
 * @return {array}
 */
function getHolidayDays(date, dateFormat = "YYYY-MM-DD")
{
    var holidays = []
    var allHolidays = getAllHolidays(date, dateFormat)

    $.each(allHolidays, function(index, holiday) {
         $.each(holiday, function(index, day) {
              holidays.push(day)
         });
    });

    return holidays;
}

/**
 * Determine if a date is not holiday.
 *
 * @param  {moment}  date
 * @param  {array}  holidayDates
 * @return {boolean}
 */
function isNotHoliday(date, holidayDates)
{
    return $.inArray(date, holidayDates) == -1;
}
