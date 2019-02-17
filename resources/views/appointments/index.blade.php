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
        <h4>Appointments</h4>

        <a href="{{ route('doctors.index') }}" class="underline text-teal text-lg">
            Back to doctors
        </a>
    </header>

    <main>

        @if (request()->route()->named('appointments.index'))
            @include('appointments.html._collapse', [
                'doctors' => $doctors
            ])
        @endif

        <div id="calendar" class="bg-white p-4 mt-4"></div>
    </main>

@endsection

@section('scripts')
    <script>

        @if (request()->route()->named('doctors.appointments.index'))
            var appIndexUrl = "{{ route('api.appointments.index', $doctor) }}";
            var appStoreUrl = "{{ route('doctors.appointments.store', $doctor) }}";
            var doctorExists = true;
        @else
            var appIndexUrl = "{{ route('api.appointments.index') }}";
            var doctorExists = false;
        @endif


        // Calendar
        var calendar = $('#calendar');
        var defaultView = doctorExists ? 'agendaWeek' :'month';
        var timeFormat = "HH:mm"; // 24 hour
        var dateFormat = "YYYY-MM-DD";
        // var slotDuration = doctorExists ? drAppSlot :'00:30:00';
        var slotDuration = '00:30:00';
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


        calendar.fullCalendar({
            @include('appointments.fullcalendar._custom_button'),
            @include('appointments.fullcalendar._basic'),
        });

    </script>
@endsection