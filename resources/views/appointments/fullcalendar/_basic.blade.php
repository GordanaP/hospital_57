header: {
    left: doctorExists ? 'month, agendaWeek, list' : 'month, list',
    center: 'title',
    right: 'prev,next, newEvent',
},
defaultView: defaultView,
handleWindowResize: true,
showNonCurrentDates: false,
timeFormat: timeFormat,
slotLabelFormat: timeFormat,
eventLimit: true,
firstDay: firstDay,
navLinks: true,
selectable: true,
slotDuration: slotDuration,
// businessHours: doctorExists ? drBusinessHoursArray : [
businessHours: [
    {
        dow: standardDays,
        start: standardOpen,
        end: standardClose
    },
    {
        dow: saturday,
        start: saturdayOpen,
        end: saturdayClose
    }
],
minTime: standardOpen,
maxTime: standardClose,
timezone: timezone,
events:  {
    url: appIndexUrl,
    textColor: eventTextColor,
},
eventDataTransform: function(event) {

    event.title = doctorExists ? event.patient.full_name : event.patient.full_name +' - '+ event.doctor.title_last_name;
    event.description = event.doctor.title_last_name;
    event.start = event.start_at;
    event.end = event.end_at;
    event.color = event.doctor.color;

    return event;
}