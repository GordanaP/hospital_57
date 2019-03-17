appDate.datepicker({
    onSelect: function(date) {

        appTime.timepicker('remove');
        appTime.val('')

        $.ajax({
            type: "POST",
            url: availableAppSlotsUrl,
            data: {
                appointment_date: date,
                appointment_time: appTime.val()
            },
            success: function(response)
            {
                var slots = response.bookedSlots;
                var minTime = response.minTime;
                var maxTime = response.maxTime;

                appTime.timepicker({
                    'timeFormat': 'H:i',
                    'step': appSlot,
                    'minTime': minTime,
                    'maxTime': maxTime,
                    'disableTimeRanges': getBookedSlots(slots),
                    'forceRoundTime': true,
                });
            }
        });
    },
    firstDay: 1,
    dateFormat: "yy-mm-dd",
    minDate: 0,
    changeMonth: true,
    changeYear: true,
    maxDate: datepickerMaxDate(),
    beforeShowDay: function(date)
    {
        return highlightDoctorWorkdays(drWorkDaysIds, absences, date);
    }
});

patientBirthday.datepicker({
    firstDay: 1,
    dateFormat: "yy-mm-dd",
    maxDate: 0,
    changeMonth: true,
    changeYear: true
});
