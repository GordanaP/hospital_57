clickDay: function(e) {

    var eventId = e.events[0] ? e.events[0].id : '';

    if(eventId)
    {
        javascript:location.href = '/absences/' + eventId + '/edit'
    }
}