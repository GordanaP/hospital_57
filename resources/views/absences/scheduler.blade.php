@extends('layouts.admin')

@section('title', ' | Absences')

@section('links')
    <style>
        .fc-mon, .fc-tue,.fc-wed,.fc-thu,.fc-fri,.fc-sat,.fc-sun {font-size: 10px !important;}
        th.fc-widget-header {font-size: 16px}
        .fc-sat, .fc-sun { background-color: #F8FAFC !important; }
        .fc-bgevent {opacity: 1; color: #fff; z-index: 1}
    </style>
@endsection

@section('content')

    <header class="flex items-center justify-between mb-4 ">
        <h2>Absences</h2>
        <span>
            <a href="{{ route('absences.create') }}" class="btn button-teal">
                Add Absence
            </a>
        </span>
    </header>

    <main>
        <div class="card card-body">
            <div id="absencesTracker" class="bg-white"></div>
        </div>
    </main>

@endsection

@section('scripts')
    <script>

        var schedulerEl = document.getElementById('absencesTracker');
        var doctorsIndexUrl = "{{ route('api.scheduler.doctors.index') }}"
        var absencesIndexUrl = "{{ route('api.scheduler.absences.index') }}"

        var absencesTracker = new FullCalendar.Calendar(schedulerEl, {
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            plugins: [ 'resourceTimeline' ],
            defaultView: 'resourceTimelineMonth',
            aspectRatio: 1,
            header: {
              right: 'prev,next',
            },
            resourceLabelText: 'Doctors',
            resourceAreaWidth: '20%',
            resourceEditable: true,
            slotWidth: '10px',
            resources: {
                url: doctorsIndexUrl,
                method: 'GET',
            },
            resourceOrder: 'last_name',
            resourceText: function(resource)
            {
                 return resource._resource.extendedProps.title_last_name + ' ' + resource._resource.extendedProps.first_name;
            },
            resourceRender: function(renderInfo) {

                var resourceObj = renderInfo.resource._resource;
                var resourceEl = renderInfo.el;

                resourceEl.style.color = resourceObj.extendedProps.color;
                resourceEl.id = resourceObj.id

                var resourceCell = $('.fc-widget-content #'+resourceEl.id)

                resourceCell.css({'cursor': 'pointer'}).click(function() {

                    var doctorId = this.id

                    javascript:location.href = 'doctors/' + doctorId + '/absences'
                });
            },
            events:  {
                url: absencesIndexUrl,
            },
            eventDataTransform: function(event) {
                event.resourceId = event.doctor_id
                event.title = event.leave_type.name;
                event.start = event.start_at;
                event.end = moment(event.end_at).add(1, 'days').format('YYYY-MM-DD');
                event.backgroundColor = event.leave_type.color;
                event.textColor = '#000';
                event.rendering = 'background';

                return event;
            },
            eventRender: function (renderInfo)
            {
                var from = renderInfo.event._def.extendedProps.start_at
                var to = renderInfo.event._def.extendedProps.end_at
                var countDays = getDatesArray(from, to).length;

                eventTitle = renderInfo.event._def.title;

                if(eventTitle == "Annual leave") {
                    renderInfo.el.innerHTML = "Annual";
                }
                else
                {
                    renderInfo.el.innerHTML = eventTitle
                }

                renderInfo.el.setAttribute('title', eventTitle + " (" + countDays + ")");
            },
        });

        absencesTracker.render();

    </script>
@endsection
