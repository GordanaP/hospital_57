$.ajax({
    url: absencesIndexUrl,
    type: 'GET',
    success: function(response)
    {
        var absences = response.data

        for (var i = 0; i < absences.length; i++)
        {
            absences[i].startDate = new Date(absences[i].start_at);
            absences[i].endDate = new Date(absences[i].end_at);
            absences[i].name = absences[i].description;
            absences[i].color = absences[i].color;
        }

        calendar.data('calendar').setDataSource(absences);
    }
});