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
businessHours: doctorExists ? drWorkHoursArray : [
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
timezone: timezone