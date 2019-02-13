@extends('layouts.admin')

@section('title', ' | Display doctor')

@section('content')

    <section id="doctorDetails">
        @include('doctors.html._section_details')
    </section>

    <section id="doctorSchedule" class="mt-5">
        @include('doctors.html._section_schedule')
    </section>

    <section id="doctorPatients" class="mt-5">
        @include('doctors.html._section_patients')
    </section>

@endsection

@section('scripts')
    <script>

        // Datatable
        var patientsTable = $('#doctorPatientsTable');
        var patientsIndexUrl = "{{ route('api.patients.index', $doctor) }}";

        @include('patients.js._datatable')

        // Delete patient
        @include('patients.js._delete')

    </script>
@endsection