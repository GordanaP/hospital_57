customButtons:
{
    newEvent:
    {
        text: 'Schedule an appointment',
        click: function(event, jsEvent, view) {
            doctorExists ? appModal.open() : $('.collapse').collapse('toggle')
        },
    }
}