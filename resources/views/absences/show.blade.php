@extends('layouts.admin')

@section('title', ' | Doctor Absences')

@section('content')

    <header class="mb-3">
        <h4>
            <a href="{{ route('doctors.show', $doctor) }}" class="hover:no-underline"
                style="color:#7986cb"
            >
                {{ $doctor->title_name }}
            </a>
        </h4>
    </header>

    <main>
        <section id="absenceStatistics" class="inline-flex w-full text-xs mb-4">
            @include('absences.html._statistics')
        </section>

        <section id="absenceCalendar" class="card card-body p-0">
            <div id="bs-year-calendar"></div>
        </section>
    </main>

@endsection

@section('scripts')
    <script>

        var calendar = $('#bs-year-calendar');
        var absencesIndexUrl = "{{ route('api.absences.index', $doctor) }}";
        var doctorAbsencesCreateUrl = "{{ route('doctors.absences.create', $doctor) }}";
        var doctorAnnualLeavesAllowed = @json($doctor->leave_types) ;
        var doctorJoinYear = "{{ AppCarbon::formatDate($doctor->created_at, 'Y') }}"

        @include('absences.calendar.partials._data_source')

        calendar.calendar({
            style:'background',
            weekStart: 1,
            disabledWeekDays: [6, 0],
            disabledDays: getMultiYearsHolidays(3),
            enableRangeSelection: true,
            @include('absences.calendar.partials._select_range'),
            @include('absences.calendar.partials._click_day'),
            @include('absences.calendar.partials._mouse_popover'),
            @include('absences.calendar.partials._day_renderer'),
            @include('absences.calendar.partials._year_changed')
        });

    </script>
@endsection
