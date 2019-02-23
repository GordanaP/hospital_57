/**
 * Highlight datepicker max date.
 *
 * @return js object
 */
function datepickerMaxDate()
{
    var today = new Date();
    var currYear = today.getFullYear();
    var nextYear = currYear + 1;
    var currMonth = today.getMonth();

    var year = currMonth >=8 && currMonth <=11 ? nextYear : currYear;
    var month = 7;
    var day = 31;

    return new Date(year, month, day);
}

function highlightDoctorWorkdays(drWorkDaysIds, absences, date, className = "doctor-work-day", dateFormat = "YYYY-MM-DD")
{
    return isNotAbsentFromWork(drWorkDaysIds, absences, date, dateFormat)
        ? [true, className, "Tooltip text"]
        : [false, "", ""];
}

function isNotAbsentFromWork(drWorkDaysIds, absences, date, dateFormat)
{
    var formattedDate = formattedDatepickerDate(date)
    var formattedDay = date.getDay()

    return isInArray(formattedDay, drWorkDaysIds)
            && ! isInArray(formattedDate, getHolidayWorkdays(drWorkDaysIds, date, dateFormat))
            && ! isInArray(formattedDate, getAbsencesWorkdays(drWorkDaysIds, absences, date))
}

function getAbsencesWorkdays(drWorkDaysIds, absences, date)
{
    var absenceDates = makeAbsenceDatesArray(absences)
    var absenceWorkdays = [];

    $.each(drWorkDaysIds, function(index, day) {
        $.each(absenceDates, function(index, dates) {
            $.each(dates, function(index, date) {
                if (day == getDay(date)) {
                 absenceWorkdays.push(date)
                }
            });
        });
    });

    return absenceWorkdays;
}

function makeAbsenceDatesArray(absences)
{
    var absenceDates = [];

    for (var i = 0; i < absences.length; i++) {

        absenceDates.push(getDatesArray(new Date(absences[i].start_at), new Date(absences[i].end_at)))
    }

    return  absenceDates;
}

var getDatesArray = function(start, end) {

    var dates = new Array();
    var dt = new Date(start);

    while (dt <= end) {
        dates.push(new Date(dt));
        dt.setDate(dt.getDate() + 1);
    }

    var datesArray = [];

    $.each(dates, function(index, date) {
         datesArray.push(formattedDatepickerDate(date))
    });

    return datesArray;
}


function getHolidayWorkdays(drWorkDaysIds, date, dateFormat = "YYYY-MM-DD")
{
    var holidays = datepickerHolidays(date, dateFormat)

    var holidayWorkdays = [];

    $.each(drWorkDaysIds, function(index, day) {
         $.each(holidays, function(index, holiday) {
              if (day == getDay(holiday)) {
                holidayWorkdays.push(holiday)
              }
         });
    });

    return holidayWorkdays;
}

function highlightDatepickerHolidays(date)
{
    var formattedDate = jQuery.datepicker.formatDate('yy-mm-dd', date);
    var holidays = datepickerHolidays(date);

    if (date.getDay() == 0 )
    {
        return [false, "markholiday"];
    }
    else
    {
        return ! isInArray(formattedDate, holidays) ? [true] : [false, "markholiday"];
    }
}

function datepickerHolidays(date, dateFormat = "YYYY-MM-DD")
{
    var NewYearDay = datepickerNewYearDay(date);
    var OrthodoxChristmasDay = datepickerOrthodoxChristmasDay(date);
    var SovereigntyDay = datepickerSovereigntyDay(date);
    var OrthodoxEasterHoliday = datepickerOrthodoxEasterHoliday(date, dateFormat);
    var LaborDay = datepickerLaborDay(date);
    var ArmisticeDay = datepickerArmisticeDay(date);

    var multipleArrays = [NewYearDay, OrthodoxChristmasDay, SovereigntyDay, OrthodoxEasterHoliday, LaborDay, ArmisticeDay];

    return mergeMultipleArrays(multipleArrays);
}

function datepickerNewYearDay(date, drWorkDaysIds)
{
    year = date.getFullYear();

    var January1 = year + "-01-01";
    var January2 = year + "-01-02";
    var January3 = year + "-01-03";

    var NewYearDay = [January1, January2];

    if (isDatepickerSunday(January1) || isDatepickerSunday(January2)) {
        addBonusDay(NewYearDay, January3)
    }

    return NewYearDay;
}

function datepickerSovereigntyDay(date)
{
    year = date.getFullYear();

    var February15 = year + "-02-15";
    var February16 = year + "-02-16";
    var February17 = year + "-02-17";

    var SovereigntyDay = [February15, February16];

    if (isDatepickerSunday(February15) || isDatepickerSunday(February16)) {
        addBonusDay(SovereigntyDay, February17);
    }

    return SovereigntyDay;
}

function datepickerLaborDay(date)
{
    year = date.getFullYear();

    var May1 = year + "-05-01";
    var May2 = year + "-05-02";
    var May3 = year + "-05-03";

    var LaborDay = [May1, May2];

    if (isDatepickerSunday(May1) || isDatepickerSunday(May2)) {
        addBonusDay(LaborDay, May3);
    }

    return LaborDay;
}

function datepickerArmisticeDay(date)
{
    year = date.getFullYear();

    var November11 = year + "-11-11";
    var November12 = year + "-11-12";

    var ArmisticeDay = [November11];

    if (isDatepickerSunday(November11)) {
        addBonusDay(ArmisticeDay, November12);
    }

    return ArmisticeDay;
}

function datepickerOrthodoxChristmasDay(date)
{
    year = date.getFullYear();

    January7 = year + "-01-07";

    var ChristmasDay = [January7];

    return ChristmasDay;
}

function datepickerOrthodoxEasterHoliday(date, dateFormat)
{
    var GoodFriday = orthodoxEasterSunday(year).subtract(2, 'd').format(dateFormat);
    var EasterMonday = orthodoxEasterSunday(year).add(1, 'd').format(dateFormat);

    var EasterHoliday = [GoodFriday, EasterMonday];

    return EasterHoliday;
}


function addBonusDay(holidays, date)
{
    return holidays.push(date);
}

function isDatepickerSunday(date)
{
    return new Date(date).getDay() == 0;
}

function mergeMultipleArrays(arrays)
{
    return [].concat.apply([], arrays);
}

function formattedDatepickerDate(date)
{
    return jQuery.datepicker.formatDate('yy-mm-dd', date);
}

function getDay(date)
{
    return new Date(date).getDay();
}