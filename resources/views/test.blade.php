@extends('layouts.admin')

@section('title', ' | Test Page')

@section('links')
    <style>

        .event-tooltip  + .tooltip > .tooltip-inner {background-color: #f00;}

        .calendar .calendar-header table th.next span {
          display: block;
          background-image: url("../images/chevron-sign-right.svg");
          width: 30px;
          height: 30px;
          background-size: cover;
        }

        .calendar .calendar-header table th.next span:before {
          display: none;
        }

        .calendar .calendar-header table th.prev {}

        .calendar .calendar-header table th.prev span {
          display: block;
          background-image: url("../images/chevron-sign-left.svg");
          width: 30px;
          height: 30px;
          background-size: cover;
        }

        .calendar .calendar-header table th.prev span:before {
          display: none;
        }

        .absence-summary-table tr td { border-top: none; padding: 2px 0px;}

        .vertical-text {
            /*border: 1px solid #eeeeee;*/
            position: relative;
        }

        .vertical-text span {
            /*color: red;*/
            display: block;
            writing-mode: horizontal-tb;
            -webkit-transform: rotate(270deg);
            -moz-transform: rotate(270deg);
            -o-transform: rotate(270deg);
            position: absolute;
            top: 26px;
            left: -12px;
        }
    </style>
@endsection

@section('content')

    <header class="flex items-center justify-between mb-3">
        <h4 class="flex items-center">
            <a href="{{ route('doctors.show', $doctor) }}" class="hover:no-underline"
                style="color:#7986cb"
            >
                {{ $doctor->title_name }}
            </a>
        </h4>

        <div class="flex items-center">
            <a href="{{ route('doctors.show', $doctor) }}"
                class="underline text-grey-dark hover:text-grey-darker text-lg mr-4">
                Back to doctor
            </a>
        </div>
    </header>

    <section>
        <div class="inline-flex w-full text-xs mb-4">
            <div class="card card-body bg-yellow-lightest py-2 mr-1" style="flex: 2">
                <p class="font-bold">Annual statistics:</p>
                <hr class="mt-1 mb-2">

                <div class="flex">
                    <div class="bg-yellow-lightest mr-1 flex"
                    style="flex: 1;">
                        <div class="vertical-text bg-yellow-lightest"
                        style="flex: 1; border-left: 1px dashed #dddddd; border-right: 1px dashed #dddddd;">
                            <span class="font-bold text-grey-dark">Allowed</span>
                        </div>
                        <div class="bg-yellow-lightest mt-2 pl-2"
                        style="flex: 10;">
                            <div class="flex">
                                <div class="bg-yellow-lightest" style="flex: 3">
                                    Annual leave entitlement
                                </div>
                                <div id="annual-leave-allowed" class="bg-yellow-lightest" style="flex: 1"></div>
                            </div>
                            <div class="flex">
                                <div class="bg-yellow-lightest" style="flex: 3">
                                    Annual leave carried over
                                </div>
                                <div id="annual-leave-carried-over" class="bg-yellow-lightest" style="flex: 1"></div>
                            </div>
                            <div class="flex">
                                <div class="bg-yellow-lightest" style="flex: 3">
                                    Total allowance / not taken
                                </div>
                                <div id="annual-leave-total" class="bg-yellow-lightest" style="flex: 1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-lightest ml-1 flex" style="flex: 1;">
                        <div class="vertical-text bg-yellow-lightest"
                        style="flex: 1; border-left: 1px dashed #dddddd; border-right: 1px dashed #dddddd;">
                            <span class="ml-2 font-bold text-grey-dark">Taken</span>
                        </div>
                        <div class="flex bg-yellow-lightest pl-2"
                        style="flex: 10;">
                            <div style="flex: 1">
                                <div class="flex">
                                    <div class="bg-yellow-lightest" style="flex: 3">
                                        Annual leave
                                    </div>
                                    <div id="annual-leave-taken" class="bg-yellow-lightest" style="flex: 1">
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="bg-yellow-lightest" style="flex: 3">
                                        Sick leave
                                    </div>
                                    <div id="sick-leave" class="bg-yellow-lightest" style="flex: 1">
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="bg-yellow-lightest" style="flex: 3">
                                        Materinity
                                    </div>
                                    <div id="maternity" class="bg-yellow-lightest" style="flex: 1">
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="bg-yellow-lightest" style="flex: 3">
                                        Training
                                    </div>
                                    <div id="training" class="bg-yellow-lightest" style="flex: 1">
                                    </div>
                                </div>
                            </div>

                            <div style="flex: 1">
                                <div class="flex">
                                    <div class="bg-yellow-lightest" style="flex: 3">
                                        Bereavement
                                    </div>
                                    <div id="bereavement" class="bg-yellow-lightest" style="flex: 1"></div>
                                </div>
                                <div class="flex">
                                    <div class="bg-yellow-lightest" style="flex: 3">
                                        Family
                                    </div>
                                    <div id="family" class="bg-yellow-lightest" style="flex: 1">
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="bg-yellow-lightest" style="flex: 3">
                                        Other leave
                                    </div>
                                    <div id="other" class="bg-yellow-lightest" style="flex: 1">
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class="bg-yellow-lightest" style="flex: 3">
                                        Unpaid leave
                                    </div>
                                    <div id="unpaid" class="bg-yellow-lightest" style="flex: 1">
                                        0
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-body bg-yellow-lightest py-2 ml-1" style="flex: 1">
                <p class="font-bold">Legend: </p>
                <hr class="mt-1 mb-2">

                <div class="flex">
                    <div class="mr-4">
                        @foreach (\App\LeaveType::all() as $type)
                            <div class="flex items-center">
                                <i class="fa fa-square mr-2" style="color: {{ $type->color }}"></i>
                                <span class="text-xs">{{ $type->name }}</span>
                            </div>
                            @if ($type->id == 4)
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="ml-4">
                        @foreach (\App\LeaveType::all() as $type)
                            @if ($type->id >= 5)
                                <div class="flex items-center">
                                    <i class="fa fa-square mr-2" style="color: {{ $type->color }}"></i>
                                    <span class="text-xs">{{ $type->name }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main>
        <div class="card card-body p-0">
            <div id="bs-year-calendar"></div>
        </div>
    </main>

@endsection

@section('scripts')
    <script>

        var calendar = $('#bs-year-calendar');
        var absencesIndexUrl = "{{ route('api.absences.index', $doctor) }}";
        var doctorAbsencesCreateUrl = "{{ route('doctors.absences.create', $doctor) }}";
        var doctorAnnualLeavesAllowed = @json($doctor->leave_types) ;
        var doctorJoinYear = "{{ AppCarbon::formatDate($doctor->created_at, 'Y') }}"

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

        calendar.calendar({
            style:'background',
            weekStart: 1,
            disabledWeekDays: [6, 0],
            disabledDays: getMultiYearsHolidays(3),
            enableRangeSelection: true,
            selectRange: function(e) {

                var startDate = formatJsDate(e.startDate);
                var endDate = formatJsDate(e.endDate);
                var year = e.startDate.getFullYear();
                var today = formatJsDate(new Date());
                var currentYear = new Date().getFullYear()
                var maxDate = formatJsDate(new Date((currentYear+2), 11, 31));

                var range = getDatesArray(startDate, endDate)

                $.ajax({
                    url: absencesIndexUrl,
                    type: "GET",
                    success: function(response)
                    {
                        var absences = response.data;

                        if(startDate >= today && startDate <= maxDate)
                        {
                            if ((range.length > 1 && isValidAbsenceDatesRange(absences, range, year)) ||
                                (range.length == 1 && absenceStartIsNotHoliday(e.startDate))) {

                                    javascript:location.href = doctorAbsencesCreateUrl+"?start_at="+startDate+"&end_at="+endDate
                            }
                            else {

                                alert('Invalid date!')
                            }
                        }
                        else
                        {
                            alert('Selected dates are outside the allowed dates range!')
                        }
                    }
                });
            },
            clickDay: function(e) {

                var eventId = e.events[0] ? e.events[0].id : '';

                if(eventId)
                {
                    javascript:location.href = '/absences/' + eventId + '/edit'
                }
            },
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
            },
            customDayRenderer: function(element, date) {

                return markHolidays(element, date)
            },
            yearChanged: function(e) {

                var year = e.currentYear

                $.ajax({
                    url: absencesIndexUrl,
                    type: "GET",
                    success: function(response)
                    {
                        var absences = response.data;

                        var currYearAllowed = calculateAnnualLeaveAllowed(doctorAnnualLeavesAllowed, doctorJoinYear, year);
                        var currYearTaken = countAbsencesTaken(absences, "Annual leave", year);
                        var prevTotalAllowed = totalAnnualLeaveAllowed(doctorAnnualLeavesAllowed, doctorJoinYear, (year-1));
                        var prevTotalTaken = totalAnnualLeaveTaken(absences, doctorJoinYear, (year-1));
                        var carriedOver = prevTotalAllowed - prevTotalTaken;
                        var currTotalAllowed = currYearAllowed + carriedOver
                        var notTaken = currTotalAllowed - currYearTaken;

                        var trainingLeaveTaken = countAbsencesTaken(absences, "Training", year);
                        var sickLeaveTaken = countAbsencesTaken(absences, 'Sick leave', year)
                        var maternityLeaveTaken = countAbsencesTaken(absences, 'Maternity', year)
                        var familyLeaveTaken = countAbsencesTaken(absences, 'Family', year)
                        var bereavementLeaveTaken = countAbsencesTaken(absences, 'Bereavement', year)
                        var otherLeaveTaken = countAbsencesTaken(absences, 'Other', year)
                        var unpaidLeaveTaken = countAbsencesTaken(absences, 'Unpaid', year)

                        $('#annual-leave-allowed').html(currYearAllowed);
                        $('#annual-leave-carried-over').html((year > doctorJoinYear) ? carriedOver : 0)
                        $('#annual-leave-total').html(currTotalAllowed + ' / ' + (notTaken ? notTaken : 0));
                        $('#annual-leave-taken').html(currYearTaken);

                        $('#training').html(trainingLeaveTaken)
                        $('#sick-leave').html(sickLeaveTaken)
                        $('#maternity').html(maternityLeaveTaken)
                        $('#family').html(familyLeaveTaken)
                        $('#bereavement').html(bereavementLeaveTaken)
                        $('#other').html(otherLeaveTaken)
                        $('#unpaid').html(unpaidLeaveTaken)
                    }
                });
            }
        });

    </script>
@endsection

@section('name')
    <div>Icons made by <a href="https://www.flaticon.com/authors/dave-gandy" title="Dave Gandy">Dave Gandy</a> from <a href="https://www.flaticon.com/"                 title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/"              title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
@endsection