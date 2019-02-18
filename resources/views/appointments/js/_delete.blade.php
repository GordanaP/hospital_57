$(document).on('click', '#deleteApp', function() {

    var appId = $(this).val()
    var appDeleteUrl = '/appointments/' + appId

    $.ajax({
        url: appDeleteUrl,
        type: 'DELETE',
        success : function(response)
        {
            appModal.close();

            sendSuccessNotification(response.message);

            removeEvent(calendar, appId);
        }
    });
});