$(document).on('click', '#updateApp', function() {

    var appId = $(this).val();
    var appUpdateUrl = '/appointments/' + appId;

    var data = {
        doctor_id: doctorId.val(),
        app_date: appDate.val(),
        app_start: appTime.val(),
        phone: patientPhone.val()
    }

    $.ajax({
        url: appUpdateUrl,
        type: "PUT",
        data: data,
        success: function(response)
        {
            appModal.close();

            sendSuccessNotification(response.message);

            updateEvent(calendar, response.appointment);

            console.log(response.patient)
        },
        error: function(response)
        {
            var errors = response.responseJSON.errors

            errorResponse(errors, appModal)
        }
    });
});