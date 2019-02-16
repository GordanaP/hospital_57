@extends('layouts.admin')

@section('title', ' | Display doctor')

@section('content')

    <section id="doctorDetails">
        @include('doctors.html._section_details')
    </section>

    <section id="doctorSchedule" class="mt-5">
        @include('doctors.html._section_schedule')
    </section>

    <section id="doctorAbsences" class="mt-5">
        @include('doctors.html._section_absences')
    </section>

    <section id="doctorPatients" class="mt-5">
        @include('doctors.html._section_patients')
    </section>

@endsection

@section('scripts')
    <script>

        // Patients
        var patientsTable = $('#doctorPatientsTable');
        var patientsIndexUrl = "{{ route('api.patients.index', $doctor) }}";

        @include('patients.js._datatable')

        @include('patients.js._delete')


        // Absences
        var absencesTable = $('#doctorAbsencesTable');
        var absencesIndexUrl = "{{ route('api.absences.index', $doctor) }}";
        var doctorExists = true;

        @include('absences.js._datatable')

        @include('absences.js._delete')

    </script>
@endsection
