function markHolidays(element, date, color = '#ef5350')
{
    var holidays = getHolidays (date);

    $.each(holidays, function(index, holiday) {
         if(formatJsDate(holiday) == formatJsDate(date))
         {
            $(element).css('background-color', color);
            $(element).css('color', 'white');
            $(element).css('border-radius', '3px');
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
function getHolidays (date)
{
    var year = date.getFullYear();

    var january = 0;
    var february = 1;
    var may = 4;
    var november = 10;

    var January1 = new Date(year, january, 1);
    var January2 = new Date(year, january, 2);
    January3 = dateIsSunday(January1) || dateIsSunday(January2) ? new Date(year, january, 3) : '';

    var February15 = new Date(year, february, 15);
    var February16 = new Date(year, february, 16);
    February17 = dateIsSunday(February15) || dateIsSunday(February16) ? new Date(year, february, 17) : '';

    var May1 = new Date(year, may, 1);
    var May2 = new Date(year, may, 2);
    May3 = dateIsSunday(May1) || dateIsSunday(May2) ? new Date(year, may, 3) : '';

    var November11 = new Date(year, november, 11);
    November12 = dateIsSunday(November11) ? new Date(year, november, 12) : '';

    var ChristmasDay = new Date(year, january, 7);
    var Sunday = orthEasterSunday(year);
    var EasterSunday = Sunday.setDate(Sunday.getDate())
    var EasterMonday = Sunday.setDate(Sunday.getDate() + 1);
    var GoodFriday = Sunday.setDate(Sunday.getDate() -3);

    var holidays = [ January1, January2, February15, February16, May1, May2, November11,
        ChristmasDay, GoodFriday, EasterSunday, EasterMonday, ];

    January3 !== null ? holidays.push(January3) : '';
    February17 !== null ? holidays.push(February17) : '';
    May3 !== null ? holidays.push(May3) : '';
    November12 !== null ? holidays.push(November12) : '';

    return holidays;
}

/**
 * Get orthodox Easter Sunday
 *
 * @param  {string} year [description]
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

