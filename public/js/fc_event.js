/**
 * Render fullcalendar event.
 *
 * @param  {fullcalendar} calendar
 * @param  {array} app
 * @return void
 */
function renderEvent(calendar, app)
{
    var event = getEvent(calendar, app);

    calendar.fullCalendar('renderEvent', event);
    calendar.fullCalendar('refetchEvents');
}

/**
 * Get fullcalendar event.
 *
 * @param  {fullcalendar} calendar
 * @param  {array} app
 * @return {fullcalendar event}
 */
function getEvent(calendar, app)
{
    return calendar.fullCalendar('clientEvents', app);
}