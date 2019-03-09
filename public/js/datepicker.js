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

/**
 * Highlight the doctor workdays on datepicker.
 *
 * @param  {array} drWorkDaysIds
 * @param  {array} absences
 * @param  {string} date
 * @param  {string} className
 * @param  {string} dateFormat
 * @return {mixed}
 */
function highlightDoctorWorkdays(drWorkDaysIds, absences, date, className = "doctor-work-day", dateFormat = "YYYY-MM-DD")
{
    return isNotAbsentFromWork(drWorkDaysIds, absences, date, dateFormat)
        ? [true, className, "Tooltip text"]
        : [false, "", ""];
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

function disableDoctorAbsences(absences, date)
{
    var formattedDate = formattedDatepickerDate(date);
    var datesArray = makeAbsenceDatesArray(absences)
    var absencesArray = [];

    $.each(datesArray, function(index, dates) {
         $.each(dates, function(index, value) {
              absencesArray.push(value)
         });
    });

    return isInArray(formattedDate, absencesArray)
        ? [false, 'absent', ''] : [true, '', '']
}

function highlightAbsenceToEdit(absences, absenceToEditId, date)
{
    var formattedDate = formattedDatepickerDate(date);
    var datesToEdit;
    var disabledDates = [];

    $.each(absences, function(index, absence) {
        if(absence.id == absenceToEditId)
        {
            datesToEdit = getDatesArray(absence.start_at, absence.end_at)
        }
        else
        {
            var absenceDates = getDatesArray(absence.start_at, absence.end_at);

            disabledDates.push(absenceDates);
        }
    });

    var mergedDisabledDates = mergeMultipleArrays(disabledDates);

    if (isInArray(formattedDate, datesToEdit)) {
        return [true, 'to-edit', ''];
    }
    else if(isInArray(formattedDate, mergedDisabledDates))
    {
        return [false, 'absent', ''];
    }
    else
    {
        return [true, '', ''];
    }
}

function ajaxCallDoctor(doctorId)
{
    var showDoctorUrl = '/api/doctors/'+doctorId;

    return $.ajax({
        url: showDoctorUrl,
        type: "POST"
    });
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
    var dt1 = new Date(end);

    while (dt <= dt1) {
        dates.push(new Date(dt));
        dt.setDate(dt.getDate() + 1);
    }

    var datesArray = [];

    $.each(dates, function(index, date) {
         datesArray.push(formattedDatepickerDate(date))
    });

    return datesArray;
}

function getBookedSlots(slots)
{
    var bookedSlots = [];

    for (var i = 0; i < slots.length; i++) {
       bookedSlots.push([slots[i].start, slots[i].end]);
    }

    return bookedSlots;
}

/**
 * The doctor is not absent from work.
 *
 * @param  {array}  drWorkDaysIds
 * @param  {array}  absences
 * @param  {string}  date
 * @param  {string}  dateFormat
 * @return {boolean}
 */
function isNotAbsentFromWork(drWorkDaysIds, absences, date, dateFormat)
{
    var formattedDate = formattedDatepickerDate(date)
    var formattedDay = date.getDay()

    return isInArray(formattedDay, drWorkDaysIds)
            && ! isInArray(formattedDate, getHolidayWorkdays(drWorkDaysIds, date, dateFormat))
            && ! isInArray(formattedDate, getAbsencesWorkdays(drWorkDaysIds, absences, date))
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

function getStartWorkTime(day)
{
    return '13:00';
}

function getEndWorkTime(day)
{
    return '18:00';
}

function getDate(datepicker) {

    var date;
    var dateFormat = "yy-mm-dd";

    try {
        date = $.datepicker.parseDate(dateFormat, datepicker.value);
    } catch (error) {
        date = null
    }

    return date;
}