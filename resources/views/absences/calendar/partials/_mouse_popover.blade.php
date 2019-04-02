mouseOnDay: function(e) {

    if(e.events.length > 0) {
        var content = '';

        for(var i in e.events) {

            content += '<div class="event-tooltip-content">'
                        + '<div class="event-name text-grey-darkest">' +
                        e.events[i].type + ' '
                        + '(' + calculateAbsenceDays(e.events[i].start_at, e.events[i].end_at, e.date) + ')' +'</div>'
                    + '</div>';
        }

        $(e.element).popover({
            trigger: 'manual',
            container: 'body',
            html:true,
            content: content
        });

        $(e.element).popover('show');
    }
},
mouseOutDay: function(e) {
    if(e.events.length > 0) {
        $(e.element).popover('hide');
    }
},
dayContextMenu: function(e) {
    $(e.element).popover('hide');
}