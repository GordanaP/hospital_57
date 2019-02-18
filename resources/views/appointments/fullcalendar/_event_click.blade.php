eventClick: function(event, jsEvent, view)
{
    // Open modal
    appModal.open();

    // Modal title
    titleIcon.addClass('fa-calendar');
    titleSpan.text('Edit appointment');

    // Form buttons
    appButton.addClass('bg-purple-darker hover:bg-purple-darkest text-white')
        .text('Reschedule').attr('id', 'updateApp').val(event.id)
        .attr('data-doctor', event.doctor.id);
    deleteButton.show().val(event.id);

    // Form disabled fields
    disableFields(disabledOnUpdate);

    // Event attributes
    var patient = event.patient;
    var birthday = patient.birthday;
    var start = event.start;

    // Persistent event attributes
    patientFirstName.val(patient.first_name);
    patientLastName.val(patient.last_name);

    // Time-related attributes must be formatted properly
    var formattedDate = fromMoment(start, dateFormat);
    var formattedTime = fromMoment(start, timeFormat);
    var formattedBirthday = toMoment(birthday, dateFormat);

    appDate.val(formattedDate);
    appTime.val(formattedTime);
    patientBirthday.val(formattedBirthday);

    // Changeable attributes
    var appEditUrl = '/api/appointments/' + event.id + '/edit';

    $.ajax({
        url: appEditUrl,
        type: "GET",
        success: function(response)
        {
            var patient = response.app.patient;
            var doctor = response.app.doctor;

            doctorId.val(doctor.id);
            patientPhone.val(patient.phone);
        }
    });
}