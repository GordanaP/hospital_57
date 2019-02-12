@extends('layouts.admin')

@section('title', ' | Display doctor')

@section('content')

    <section id="doctorDetails">
        <header class="flex items-center justify-between mb-3">
            <h4>{{ $doctor->title_name }}</h4>

            <div class="flex items-center">
                <a href="{{ route('doctors.index') }}"
                    class="underline text-teal hover:text-teal-darker text-lg mr-4">
                    Back to doctors
                </a>

                @include('partials.buttons._delete_edit', [
                    'name' => 'doctors',
                    'parameter' => $doctor
                ])
            </div>
        </header>

        <main class="card card-body card-shadow">
            @include('doctors.html._details')
        </main>
    </section>

    <section id="doctorPatients" class="mt-5">
        <header class="flex items-center justify-between mb-3 ">
            <h4>Patients</h4>

            <span>
                <a href="{{ route('doctors.patients.create', $doctor) }}"
                class="btn button-teal">
                    Add Patient
                </a>
            </span>
        </header>

        <main>
            @datatable(['collection' => $doctor->patients])
                @slot('card_id') patientsIndexTable
                @endslot

                @slot('table_id') doctorPatientsTable
                @endslot

                @include('patients.table._thead')
            @enddatatable
        </main>
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