customButtons:
{
    newEvent:
    {
        text: 'Schedule an appointment',
        click: function(event, jsEvent, view) {
            doctorExists ? '' : $('.collapse').collapse('toggle')
        },
    }
}