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

/**
 * Update fullcalendar event.
 *
 * @param  {fullcalendar} calendar
 * @param  {array} app
 * @return void
 */
function updateEvent(calendar, app)
{
    var event = getEvent(calendar, app.id);

    // Event is an array, event[0] -> the first one
    // Update only changeable event attributes
    event[0].title = app.patient.full_name;
    event[0].start = app.start_at;
    event[0].end = app.end_at;
    event[0].color = app.doctor.color;

    calendar.fullCalendar('updateEvent', event[0]);
}

/**
 * Remove an event from fullcalendar.
 *
 * @param  {fullcalendar} calendar
 * @param  {integer} appId
 * @return void
 */
function removeEvent(calendar, appId)
{
    calendar.fullCalendar('removeEvents', appId)
}
