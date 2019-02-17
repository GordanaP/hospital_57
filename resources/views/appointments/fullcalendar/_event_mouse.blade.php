eventMouseover: function (event, jsEvent, view)
{
    var tooltip = '<div class="event-tooltip absolute bg-purple-lightest p-2 rounded-sm z-10">'+ event.patient.full_name + '</br> Record: #hardcode</br> Time: ' + fromMoment(event.start, timeFormat) + ' - ' + fromMoment(event.end, timeFormat) + '</div>';

    $("body").append(tooltip);

    $(this).mouseover(function (e) {
        $(this).css('z-index', 10000);
        $('.event-tooltip').fadeIn('500');
        $('.event-tooltip').fadeTo('10', 1.9);
    })
    .mousemove(function (e)
    {
        $('.event-tooltip').css('top', e.pageY + 10);
        $('.event-tooltip').css('left', e.pageX + 20);
    });
},
eventMouseout: function (event, jsEvent, view)
{
    $(this).css('z-index', 8);

    $('.event-tooltip').remove();
}