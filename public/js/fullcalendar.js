/**
 * Get moment date.
 *
 * @param  {moment} date
 * @param  {string} format
 * @return {moment}
 */
function fromMoment(date, format)
{
    return date.format(format);
}

/**
 * Transform date to moment.
 *
 * @param  {string} date
 * @param  {string} format
 * @return {moment}
 */
function toMoment(date, format)
{
    return moment(date).format(format);
}

/**
 * Create a moment date.
 *
 * @param  {integer} year
 * @param  {integer} month
 * @param  {integer} day
 * @return {moment}
 */
function createMoment(year, month, day)
{
    return moment(new Date(year, month, day));
}

/**
 * Highlight holidays on fullcalendar.
 *
 * @param  {moment} date
 * @param  {fullcalendar} cell
 * @param  {string} color
 * @param  {string} dateFormat
 * @return void
 */
function highlightHolidays(date, cell, color="#FFED4A", dateFormat = "YYYY-MM-DD")
{
    var holidays = getHolidays(date);
    var fcDay = fromMoment(date, dateFormat);

    $.each(holidays, function(index, holiday) {
        $.each(holiday, function(index, day) {
            if (fcDay === day) {
                cell.css("background-color", color);
            }
        });
    });
}

/**
 * Get all holidays.
 *
 * @param  {moment} date
 * @param  {string} dateFormat
 * @return {array}
 */
function getHolidays(date, dateFormat = "YYYY-MM-DD")
{
    var publicHolidays = getPublicHolidays(date, dateFormat);
    var religiousHolidays = getReligiousHolidays(date, dateFormat);

    return $.merge(publicHolidays, religiousHolidays);
}

/**
 * Get public holidays.
 *
 * @param  {moment} date
 * @param  {string} dateFormat
 * @return {array}
 */
function getPublicHolidays (date, dateFormat = "YYYY-MM-DD")
{
    var year = date.year();
    var january = 0;
    var february = 1;
    var may = 4;
    var november = 10;

    var January1 = createMoment(year, january, 1);
    var January2 = createMoment(year, january, 2);
    var February15 = createMoment(year, february, 15);
    var February16 = createMoment(year, february, 16);
    var May1 = createMoment(year, may, 1);
    var May2 = createMoment(year, may, 2);
    var November11 = createMoment(year, november, 11);

    var NewYear = formatPublicHoliday([January1, January2], dateFormat);
    var SovereigntyDay = formatPublicHoliday([February15, February16], dateFormat);
    var LabourDay = formatPublicHoliday([May1, May2], dateFormat);
    var ArmisticeDay = formatPublicHoliday([November11], dateFormat);

    return [ NewYear, SovereigntyDay, LabourDay, ArmisticeDay ];
}

/**
 * Get religious holidays.
 *
 * @param  {moment} date
 * @return {array}
 */
function getReligiousHolidays(date)
{
    var year = date.year();

    var January7 = createMoment(year, 0, 7);
    var EasterDay = orthodoxEasterSunday(year);
    var GoodFriday = orthodoxEasterSunday(year).subtract(2, 'd');
    var EasterMonday = orthodoxEasterSunday(year).add(1, 'd');

    var ChristmasDay = formatHoliday([January7], dateFormat);
    var Easter = formatHoliday([EasterDay, GoodFriday, EasterMonday], dateFormat);

    return [ChristmasDay, Easter];
}

/**
 * Add bonus day when a public holiday falls on Sunday.
 *
 * @param  {array}  days
 * @param  {string} dateFormat
 * @return {array}
 */
function formatPublicHoliday(days = [], dateFormat = "YYYY-MM-DD")
{
    var holidays = formatHoliday(days, dateFormat)

    if (holidayFallsOnSunday(days))
    {
        var lastDay = days[days.length - 1];

        var bonusDay = lastDay.add(1, 'd');

        holidays.push(bonusDay.format(dateFormat))
    }

    return holidays;
}

/**
 * Format holiday date.
 *
 * @param  {array}  days
 * @param  {string} dateFormat
 * @return {array}
 */
function formatHoliday(days = [], dateFormat = 'YYYY-MM-DD')
{
    var holidays = [];

    $.each(days, function(index, day) {
         holidays.push(day.format(dateFormat))
    });

    return holidays;
}

/**
 * Get Orthodox Easter Sunday.
 *
 * @param  {integer} year
 * @return {moment}
 */
function orthodoxEasterSunday(year)
{
    d = (year%19*19+15)%30;

    e = (year%4*2+year%7*4-d+34)%7+d+127;

    month = Math.floor(e/31);

    a = e%31 + 1 + (month > 4);

    return createMoment(year, (month-1), a);
}

/**
 * Determine if the holiday falls on Sunday.
 *
 * @param  {array}
 * @return {boolean}
 */
function holidayFallsOnSunday(days = [])
{
    for (var i = 0; i < days.length; i++) {
        if(isSunday(days[i])) {
            return true;
        }
    }
}

/**
 * Determine if a day is Sunday.
 *
 * @param  {moment}  date
 * @return {boolean}
 */
function isSunday(date)
{
    return date.day() == 0;
}

/**
 * Get the view-specific fullcalendar event start.
 *
 * @param  {moment} date
 * @param  {fullcalendar} view
 * @param  {integer} weekOpen
 * @param  {integer} weekendOpen
 * @param  {string} timeFormat
 * @return {moment}
 */
function getAgendaViewTime(date, view, weekOpen, weekendOpen, timeFormat = "HH:mm")
{
    if(view.name == "month" && ! isSaturday(date))
    {
        return fromMoment(date.set('hour', weekOpen), timeFormat)
    }
    else if(view.name == "month" && isSaturday(date))
    {
        return fromMoment(date.set('hour', weekendOpen), timeFormat)
    }
    else
    {
        return fromMoment(date, timeFormat);
    }
}
