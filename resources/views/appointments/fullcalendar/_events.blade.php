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