@extends('layouts.admin')

@section('title', ' | Appontments')

@section('links')
    <style>
        .fc-newEvent-button {background: #64D5CA; color: #FFFFFF; border-color: #4DC0B5}
        .fc-newEvent-button:hover {background: #38A89D; border: 1px solid #4DC0B5}
    </style>
@endsection

@section('content')

    <header class="flex items-center justify-between mx-auto mb-4">
        <h4>
            @if (request()->route()->named('doctors.appointments.index'))
                {{ $doctor->title_name }}
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
            var doctorExists = true;

            var absences = @json($doctor->absences);
            var businessWeek = [1,2,3,4,5,6];
            var drAppSlot = '00:'+"{{ $doctor->app_slot }}"+':00';
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
        var slotDuration = doctorExists ? drAppSlot :'00:30:00';
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
        appModal.setAutofocus('app_date')

        var errorFields = [
            'doctor_id', 'app_date', 'app_start', 'first_name', 'last_name',
            'birthday', 'phone'
        ];

        appModal.clearOnClose(errorFields);

        /**
         * Form
         */
        // Form
        var doctorId = $('#doctor_id');
        var appDate = $('#app_date');
        var appTime = $('#app_start');
        var patientFirstName = $('#first_name');
        var patientLastName = $('#last_name');
        var patientBirthday = $('#birthday');
        var patientPhone = $('#phone');

        var appButton = $(".app-button");
        var deleteButton = $("#deleteApp");

        disableOnUpdate = [ patientFirstName, patientLastName, patientBirthday ];


        calendar.fullCalendar({
            @include('appointments.fullcalendar._custom_button'),
            @include('appointments.fullcalendar._basic'),
            @include('appointments.fullcalendar._events'),
            @include('appointments.fullcalendar._day_render'),
            @include('appointments.fullcalendar._event_mouse'),
            select: function(start, end, jsEvent, view)
            {
                // appModal.open()

                // Open modal
                doctorExists
                    && isBusinessOperatingTime(start, view, saturdayOpen, saturdayClose)
                    && isBusinessDay(start)
                    && isDoctorWorkDay(drWorkDaysIds, start)
                    && isDoctorWorkHour(drWorkHoursArray, start)
                    && isNotDoctorAbsence(absences, start)
                ? appModal.open() : '';

                // Modal title
                titleIcon.addClass('fa-calendar');
                titleSpan.text('New appointment');

                // Form buttons
                appButton.addClass('bg-purple-darker hover:bg-purple-darkest text-white')
                    .text('Schedule').attr('id', 'storeApp');
                deleteButton.hide();

                // Form date & time fields
                formattedDate = fromMoment(start, dateFormat);
                formattedTime = getAgendaViewTime(start, view, weekOpenAsNumber, weekendOpenAsNumber);

                appDate.val(formattedDate);
                appTime.val(formattedTime);

                // Reset the form disabled fields
                // removeAttribute(disableOnUpdate, 'disabled');
            }
        });

        $(document).on('click', '#storeApp', function() {

            var data = {
                doctor_id: doctorId.val(),
                app_date: appDate.val(),
                app_start: appTime.val(),
                first_name: patientFirstName.val(),
                last_name: patientLastName.val(),
                birthday: patientBirthday.val(),
                phone: patientPhone.val()
            }

            $.ajax({
                url: appStoreUrl,
                type: 'POST',
                data: data,
                success: function(response)
                {
                    appModal.close();

                    sendSuccessNotification(response.message);

                    renderEvent(calendar, response.appointment);
                },
                error: function(response)
                {
                    var errors = response.responseJSON.errors

                    errorResponse(errors, appModal)
                }
            });
        });

    </script>
@endsection