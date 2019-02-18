$(document).on('click', '#storeApp', function() {

    var data = {
        doctor_id: doctorId.val(),
        app_date: appDate.val(),
        app_start: appTime.val(),
        first_name: patientFirstName.val(),
        last_name: patientLastName.val(),
        birthday: patientBirthday.val(),
        phone: patientPhone.val()
    }

    $.ajax({
        url: appStoreUrl,
        type: 'POST',
        data: data,
        success: function(response)
        {
            appModal.close();

            sendSuccessNotification(response.message);

            renderEvent(calendar, response.appointment);
        },
        error: function(response)
        {
            var errors = response.responseJSON.errors

            errorResponse(errors, appModal)
        }
    });
});