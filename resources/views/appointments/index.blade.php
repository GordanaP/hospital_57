@extends('layouts.admin')

@section('title', ' | Appontments')

@section('links')
    <style>
        .fc-newEvent-button {background: #64D5CA; color: #FFFFFF; border-color: #4DC0B5}
        .fc-newEvent-button:hover {background: #38A89D; border: 1px solid #4DC0B5}
         .doctor-work-day a {background: #6574CD !important; color:#ffffff !important}
     </style>
@endsection

@section('content')

    <header class="flex items-center justify-between mx-auto mb-4">
        <h4>
            @if (request()->route()->named('doctors.appointments.index'))
                <a href="{{ route('doctors.show', $doctor) }}">
                    {{ $doctor->title_name }}
                </a>
            @else
                Appointments
            @endif
        </h4>

        @if (request()->route()->named('doctors.appointments.index'))
            <a href="{{ route('appointments.index') }}" class="underline text-teal text-lg">
                Back to appointments
            </a>
        @endif
    </header>

    <main>
        <!-- Collapse -->
        @if (request()->route()->named('appointments.index'))
            @include('appointments.html._collapse', [
                'doctors' => $doctors
            ])
        @endif

        <!-- Calendar -->
        <div id="calendar" class="bg-white p-4 mt-4"></div>

        <!-- App modal -->
        @include('appointments.html._modal',  [
            'doctors' => $doctors
        ])
    </main>

@endsection

@section('scripts')
    <script>

        @if (request()->route()->named('doctors.appointments.index'))
            var appIndexUrl = "{{ route('api.appointments.index', $doctor) }}";
            var appStoreUrl = "{{ route('doctors.appointments.store', $doctor) }}";
            var absencesIndexUrl = "{{ route('api.absences.index', $doctor) }}";
            var availableAppSlotsUrl = "{{ route('api.appointments.available.slots', $doctor) }}"
            var doctorExists = true;

            var absences = @json($doctor->absences);
            var businessWeek = [1,2,3,4,5,6];
            var appSlot = "{{ $doctor->app_slot }}";
            var formattedAppSlot = '00:'+appSlot+':00';
            var drWorkDays = @json($doctor->working_days);
            var drWorkDaysIds = {{ $doctor->working_days->pluck('id') }}; // !!! No " " !!!
            var drWorkHoursArray = drWorkHoursArray(drWorkDays);
        @else
            var appIndexUrl = "{{ route('api.appointments.index') }}";
            var doctorExists = false;
        @endif

        /**
         * Calendar
         */
        var calendar = $('#calendar');
        var defaultView = doctorExists ? 'agendaWeek' :'month';
        var timeFormat = "HH:mm"; // 24 hour
        var dateFormat = "YYYY-MM-DD";
        var slotDuration = doctorExists ? formattedAppSlot :'00:30:00';
        var firstDay = 1;
        var standardDays = [1,2,3,4,5];
        var standardOpen = '09:00';
        var standardClose = '20:00';
        var saturday = [6];
        var saturdayOpen = '10:00';
        var saturdayClose = '15:00';
        var weekOpenAsNumber = 9;
        var weekendOpenAsNumber = 10;
        var timezone = 'Europe\Belgrade';
        var eventBgColor = '#4a148c';
        var eventTextColor = '#ffffff';

        /**
         * Modal
         */
        var appModal = $('#appModal');
        var titleIcon = $(".modal-title i");
        var titleSpan = $(".modal-title span");

        var errorFields = [
            'doctor_id', 'app_date', 'app_start', 'first_name', 'last_name',
            'birthday', 'phone'
        ];

        /**
         * Form
         */
        var doctorId = $('#doctor_id');
        var appDate = $('#app_date');
        var appTime = $('#app_start');
        var patientFirstName = $('#first_name');
        var patientLastName = $('#last_name');
        var patientBirthday = $('#birthday');
        var patientPhone = $('#phone');

        var appButton = $(".app-button");
        var deleteButton = $("#deleteApp");

        disabledOnUpdate = [ patientFirstName, patientLastName, patientBirthday ];

        appModal.setAutofocus('app_date')
        appModal.clearOnClose(errorFields, appTime);

        appDate.datepicker({
            onSelect: function(date) {

                appTime.timepicker('remove');
                appTime.val('')

                $.ajax({
                    type: "POST",
                    url: availableAppSlotsUrl,
                    data: {
                        appointment_date: date,
                        appointment_time: appTime.val()
                    },
                    success: function(response)
                    {
                        var slots = response.bookedSlots;
                        var minTime = response.minTime
                        var maxTime = response.maxTime
                        appTime.timepicker({
                            'timeFormat': 'H:i',
                            'step': appSlot,
                            'minTime': minTime,
                            'maxTime': maxTime,
                            'disableTimeRanges': getBookedSlots(slots),
                            'forceRoundTime': true,
                        });
                    }
                });
            },
            firstDay: 1,
            dateFormat: "yy-mm-dd", // 2017-09-27
            minDate: 0, // today
            maxDate: datepickerMaxDate(),
            changeMonth: true,
            changeYear: true,
            beforeShowDay: function(date)
            {
                return highlightDoctorWorkdays(drWorkDaysIds, absences, date);
            }
        });

        patientBirthday.datepicker({
            firstDay: 1,
            dateFormat: "yy-mm-dd",
            maxDate: 0,
            changeMonth: true,
            changeYear: true
        });

        calendar.fullCalendar({
            @include('appointments.fullcalendar._custom_button'),
            @include('appointments.fullcalendar._basic'),
            @include('appointments.fullcalendar._events'),
            @include('appointments.fullcalendar._event_mouse'),
            @include('appointments.fullcalendar._date_select'),
            @include('appointments.fullcalendar._event_click'),
            @include('appointments.fullcalendar._day_render'),
        });

        @include('appointments.js._store')

        @include('appointments.js._update')

        @include('appointments.js._delete')

    </script>
@endsection