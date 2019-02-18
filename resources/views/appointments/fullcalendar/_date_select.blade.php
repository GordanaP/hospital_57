select: function(start, end, jsEvent, view)
{
    // Open modal
    doctorExists
        && isBusinessOperatingTime(start, view, saturdayOpen, saturdayClose)
        && isBusinessDay(start)
        && isDoctorWorkDay(drWorkDaysIds, start)
        && isDoctorWorkHour(drWorkHoursArray, start)
        && isNotDoctorAbsence(absences, start)
    ? appModal.open() : '';

    // Modal title
    titleIcon.addClass('fa-calendar');
    titleSpan.text('New appointment');

    // Form buttons
    appButton.addClass('bg-purple-darker hover:bg-purple-darkest text-white')
        .text('Schedule').attr('id', 'storeApp');
    deleteButton.hide();

    // Form date & time fields
    formattedDate = fromMoment(start, dateFormat);
    formattedTime = getAgendaViewTime(start, view, weekOpenAsNumber, weekendOpenAsNumber);

    appDate.val(formattedDate);
    appTime.val(formattedTime);

    // Reset the form disabled fields
    enableFields(disabledOnUpdate);
}