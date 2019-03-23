function isValidAbsenceStartDate(date)
{
    return formatJsDate(date) >= formatJsDate(new Date()) &&
            ! isInArray(formatJsDate(date), getHolidaysAsString(date));
}

function calculateAbsenceTypeDays(yearAbsences, type)
{
    var countLeave = 0;

    $.each(yearAbsences, function(index, absences) {
        $.each(absences, function(index, absence) {
            if(absence.description == type)
            {
                countLeave += calculateAbsenceDays(absence.start_at, absence.end_at)
            }
        });
    });

    return countLeave;
}

/**
 * Calculate # of absence days.
 *
 * @param  {string} from
 * @param  {string} to
 * @return {integer}
 */
function calculateAbsenceDays(from, to)
{
    var absenceCount = getAbsenceWeekDays(from, to).length;
    var holidaysCount = getAbsenceHolidays(from, to).length;

    return absenceCount - holidaysCount;
}

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
    var EasterSunday = Sunday.setDate(Sunday.getDate())
    var EasterMonday = Sunday.setDate(Sunday.getDate() + 1);
    var GoodFriday = Sunday.setDate(Sunday.getDate() -3);

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

function isWeekend(date)
{
    return date.getDay() == 0 || date.getDay() == 6;
}
