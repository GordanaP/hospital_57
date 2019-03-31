/**
 * Get multi-years holidays.
 *
 * @param  {integer} number
 * @return {array}
 */
function getMultiYearsHolidays(number)
{
    var  holidays = [];

    for (var i = 0; i < number; i++) {

        var date = moment(new Date()).add(i, 'years').toDate();

        holidays[i] = getHolidaysAsJsDate (date)
    }

    return mergeMultipleArrays(holidays);
}

/**
 * Absence start date is not holiday.
 *
 * @param  {js date} date
 * @return {boolean}
 */
function absenceStartIsNotHoliday(date) {

    var startDate = formatJsDate(date)
    var holidays = getHolidaysAsString(date)

    var intersection = $.map(holidays,function(a) {
         return $.inArray(a, [startDate]) < 0 ? null : a;
     });

    return intersection.length == 0;
}

/**
 * Determine if the selected dates range is not alredy booked.
 *
 * @param  {array}  absences
 * @param  {array}  range
 * @param  {integer}  year
 * @return {Boolean}
 */
function isValidAbsenceDatesRange(absences, range, year) {

    var currAbsences = filterAbsencesByYear(absences, year);
    var filtered = [];

    for (i = 0; i < currAbsences.length ; i++) {

       filtered[i] = getDatesArray(currAbsences[i].start_at, currAbsences[i].end_at)
    }

    var merged = mergeMultipleArrays(filtered)

    var intersection = $.map(merged,function(a) {
         return $.inArray(a, range) < 0 ? null : a;
     });

    return intersection.length == 0
}

function calculateAnnualLeaveAllowed(doctorAnnualLeavesAllowed, doctorJoinYear, year)
{
    var currentYear = new Date().getFullYear();

    if(getAnnualLeaveAllowed(doctorAnnualLeavesAllowed, year))
    {
            var annualLeaveAllowed = getAnnualLeaveAllowed(doctorAnnualLeavesAllowed, year);
    }
    else
    {
        if(year < doctorJoinYear)
        {
            var annualLeaveAllowed = 0
        }

        if( year > currentYear) {
            annualLeaveAllowed = getAnnualLeaveAllowed(doctorAnnualLeavesAllowed, currentYear);
        }
    }

    return annualLeaveAllowed;
}

/**
 * Get annual leave allowed.
 *
 * @param  {array} absences
 * @param  {integer} year
 * @return {integer}
 */
function getAnnualLeaveAllowed(doctorAnnualLeavesAllowed, year)
{
    var allowed;

    if(doctorAnnualLeavesAllowed)
    {
        $.each(doctorAnnualLeavesAllowed, function(index, leave) {
             if(leave.pivot.year == year)
             {
                allowed = leave.pivot.total;
             }

        });

        return allowed;
    }
}

/**
 * Filtere absences by year.
 *
 * @param  {array} absences
 * @param  {integer} year
 * @return {array}
 */
function filterAbsencesByYear(absences, year)
{
    var filtered = [];

    $.each(absences, function(index, absence) {
         if(new Date(absence.end_at).getFullYear() == year)
         {
            filtered.push(absence);
         }
    });

    return filtered;
}

/**
 * Determine if the absence is allowed to start on a specific day.
 *
 * @param  {js date}  date [description]
 * @return {Boolean}      [description]
 */
function isValidAbsenceStartDate(date)
{
    return formatJsDate(date) >= formatJsDate(new Date()) &&
            ! isInArray(formatJsDate(date), getHolidaysAsString(date));
}

/**
 * Count total days for a specific absence type.
 *
 * @param  {array} absences
 * @param  {string} type
 * @return {integer}
 */
function countAbsenceTypeDays(absences, type)
{
    var countAbsenceDays = 0;

    $.each(absences, function(index, absence) {
        if(absence.type == type)
        {
            countAbsenceDays += calculateAbsenceDays(absence.start_at, absence.end_at)
        }
    });

    return countAbsenceDays;
}

/**
 * Calculate # of absence days.
 *
 * @param  {string} from
 * @param  {string} to
 * @return {integer}
 */
function calculateAbsenceDays(from, to, mouseOnDate)
{
    // var absenceCount = getAbsenceWeekDays(from, to).length;
    // var holidaysCount = getAbsenceHolidays(from, to).length;

    // return absenceCount - holidaysCount;

    var fromYear = new Date(from).getFullYear();
    var fromMonth = new Date(from).getMonth();
    var toYear = new Date(to).getFullYear();
    var toMonth = new Date(to).getMonth();
    var Dec31 = fromYear+'-12-31';
    var Jan1 = toYear+'-01-01';
    var dec = 11;
    var jan = 0;

    if(fromYear !== toYear)
    {
        if(mouseOnDate.getMonth() == jan)
        {
            var count = getAbsenceWeekDays(Jan1, to).length
            var holidaysCount = getAbsenceHolidays(Jan1, to).length;

            var absenceCount = count - holidaysCount
        }
        else if(mouseOnDate.getMonth() == dec)
        {
            var count = getAbsenceWeekDays(from, Dec31).length
            var holidaysCount = getAbsenceHolidays(from, Dec31).length;

            var absenceCount = count - holidaysCount
        }
    }
    else
    {
        var count = getAbsenceWeekDays(from, to).length
        var holidaysCount = getAbsenceHolidays(from, to).length;

        var absenceCount = count - holidaysCount;
    }

    return absenceCount;
}

/**
 * Get absence weekdays only.
 *
 * @param  {string} from
 * @param  {string} to
 * @return {array}
 */
function getAbsenceWeekDays(from, to)
{
    var allDays = getDatesArray(from,to);
    var weekDays = [];

    $.each(allDays, function(index, date) {
         if (! isWeekend(new Date(date))) {
            weekDays.push(date)
         }
    });

    return weekDays;
}

/**
 * Filter absence for holidays.
 *
 * @param  {string} from
 * @param  {string} to
 * @return {array}
 */
function getAbsenceHolidays(from, to)
{
    var absence = getAbsenceWeekDays(from, to);
    var holidays = getAllHolidays(from, to);

    var filtered = absence.filter(function(el) {
        return holidays.indexOf(el) != -1
    });

    return filtered;
}

/**
 * Get all holidays.
 *
 * @param  {string} from
 * @param  {string} to
 * @return {array}
 */
function getAllHolidays(from, to)
{
    var yearFrom = new Date(from).getFullYear();
    var yearTo = new Date(to).getFullYear();
    var currentYearHolidays = getHolidaysAsString(new Date(to));
    var previousYearHolidays = getHolidaysAsString(new Date(from));

    if(yearFrom == yearTo)
    {
        var holidays = currentYearHolidays
    }
    else
    {
        var holidays = $.merge(currentYearHolidays, previousYearHolidays);
    }

    return holidays;
}

/**
 * Get holidays as string.
 *
 * @param  {JS object} date
 * @return {string}
 */
function getHolidaysAsString(date)
{
    var holidaysAsJsDate = getHolidaysAsJsDate (date);
    var holidaysAsString = [];

    $.each(holidaysAsJsDate, function(index, day) {
         holidaysAsString.push(formatJsDate(day));
    });

    return holidaysAsString;
}

/**
 * Mark holidays on bs-year-calendar.
 *
 * @param  {bs object} element
 * @param  {Js object} date
 * @param  {String} color
 * @return {mixed}
 */
function markHolidays(element, date, color = '#ef5350')
{
    var holidays = getHolidaysAsJsDate (date);

    $.each(holidays, function(index, holiday) {
         if(formatJsDate(holiday) == formatJsDate(date))
         {
            $(element).css('background-color', color);
            $(element).css('color', 'white');
            $(element).css('border-radius', '50%');
         }
    });
}

/**
 * Get public holidays.
 *
 * @param  Javascript date
 * @param  {string} dateFormat
 * @return {array}
 */
function getHolidaysAsJsDate (date)
{
    var year = date.getFullYear();

    var january = 0;
    var february = 1;
    var may = 4;
    var november = 10;

    var January1 = new Date(year, january, 1);
    var January2 = new Date(year, january, 2);
    January3 = new Date(year, january, 3);

    var February15 = new Date(year, february, 15);
    var February16 = new Date(year, february, 16);
    February17 = new Date(year, february, 17);

    var May1 = new Date(year, may, 1);
    var May2 = new Date(year, may, 2);
    May3 = new Date(year, may, 3);

    var November11 = new Date(year, november, 11);
    November12 = new Date(year, november, 12);

    var ChristmasDay = new Date(year, january, 7);
    var Sunday = orthEasterSunday(year);
    var EasterSunday = orthEasterSunday(year)
    var EasterMonday = moment(orthEasterSunday(year)).add(1, 'days').toDate();
    var GoodFriday = moment(orthEasterSunday(year)).subtract(2, 'days').toDate();

    var holidays = [ January1, January2, February15, February16, May1, May2, November11,
        ChristmasDay, GoodFriday, EasterSunday, EasterMonday];

    if (dateIsSunday(January1) || dateIsSunday(January2))
    {
        holidays.push(January3);
    }

    if (dateIsSunday(February15) || dateIsSunday(February16))
    {
        holidays.push(February17);
    }

    if (dateIsSunday(May1) || dateIsSunday(May2))
    {
        holidays.push(May3);
    }

    if (dateIsSunday(November11))
    {
        holidays.push(November12);
    }

    return holidays;
}

/**
 * Get orthodox Easter Sunday
 *
 * @param  {string} year
 * @return JS object
 */
function orthEasterSunday(year)
{
    d = (year%19*19+15)%30;

    e = (year%4*2+year%7*4-d+34)%7+d+127;

    month = Math.floor(e/31);

    a = e%31 + 1 + (month > 4);

    return new Date(year, (month-1), a);
}

/**
 * Format JS date to string
 *
 * @param  JS date
 * @return {string}
 */
function formatJsDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return createDateString(year, month, day);
}

/**
 * Create date as string.
 *
 * @param  {string} year
 * @param  {string} month
 * @param  {string} day
 * @return {string}
 */
function createDateString(year, month, day)
{
    return [year, month, day].join('-');
}

/**
 * Determine if day is Sunday.
 *
 * @param  {JS object} date
 * @return {boolean}
 */
function dateIsSunday(date)
{
    return date.getDay() == 0;
}

/**
 * Determine if the selected day is weekend.
 *
 * @param  {js date}  date
 * @return {Boolean}
 */
function isWeekend(date)
{
    return date.getDay() == 0 || date.getDay() == 6;
}

function getFullYear(date)
{
    return new Date(date).getFullYear();
}

function totalAnnualLeaveTaken(absences, doctorJoinYear, year)
{
    var years = getYearsArray(doctorJoinYear, year);
    var taken = 0;

    for (var i = 0; i < years.length; i++) {

        taken += countAbsencesTaken(absences, "Annual leave", years[i]);
    }

    return taken;
}

function totalAnnualLeaveAllowed(doctorAnnualLeavesAllowed, doctorJoinYear, year)
{
    var years = getYearsArray(doctorJoinYear, year);
    var totalAllowed = 0;

    for (var i = 0; i < years.length; i++) {

        totalAllowed += calculateAnnualLeaveAllowed(doctorAnnualLeavesAllowed, doctorJoinYear, years[i]);
    }

    return totalAllowed;
}

function getYearsArray(first, last)
{
    var years = [];

    for(i = first; i <= last; i++) {
        years.push(i);
    }

    return years;
}

function countAbsencesTaken(absences, type, year)
{
    var filtered = getFilteredAbsences(absences, type, year);

    var count = 0;
    var Jan1 = year+'-01-01';
    var Dec31 = year+'-12-31';

    $.each(filtered, function(index, absence) {
        if(completeAbsenceIsInCurrentYear(absence))
        {
             count += countAbsenceDays(absence);
        }
        else if(absenceEndsInCurrentYear(absence, year))
        {
            count += countSplittedAbsenceDaysFromJan1(absence, year);
        }
        else if(absenceStartsInCurrentYear(absence, year))
        {
            count += countSplittedAbsenceDaysUntilDec31(absence, year);
        }
    });

    return count;
}

function countSplittedAbsenceDaysUntilDec31(absence, year)
{
    var Dec31 = year+'-12-31';

    var weekdays = getAbsenceWeekDays(absence.start_at, Dec31).length;
    var holidays = getAbsenceHolidays(absence.start_at, Dec31).length;

    return weekdays - holidays;
}

function countSplittedAbsenceDaysFromJan1(absence, year)
{
    var Jan1 = year+'-01-01';

    var weekdays = getAbsenceWeekDays(Jan1, absence.end_at).length;
    var holidays = getAbsenceHolidays(Jan1, absence.end_at).length;

    return weekdays - holidays;
}

function countAbsenceDays(absence)
{
    var weekdays = getAbsenceWeekDays(absence.start_at, absence.end_at).length;
    var holidays = getAbsenceHolidays(absence.start_at, absence.end_at).length;

    return weekdays - holidays;
}

function completeAbsenceIsInCurrentYear(absence)
{
    return getFullYear(absence.start_at) == getFullYear(absence.end_at)
}

function absenceEndsInCurrentYear(absence, year)
{
    return getFullYear(absence.end_at) == year
}

function absenceStartsInCurrentYear(absence, year)
{
    return getFullYear(absence.start_at) == year
}

function getFilteredAbsences(absences, type, year)
{
    var filtered = [];

    $.each(absences, function(index, absence) {
        if(absence.type == type && (absenceStartsInCurrentYear(absence, year) || absenceEndsInCurrentYear(absence, year)))
        {
            filtered.push(absence)
        }
    });

    return filtered;
}