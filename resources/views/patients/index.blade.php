@extends('layouts.admin')

@section('title', ' | Patients')

@section('content')

    <header class="flex items-center justify-between mb-4 ">
        <h2>Patients</h2>

        <span>
            <a href="{{ route('patients.create') }}" class="btn button-teal">
                Add Patient
            </a>
        </span>
    </header>

    @datatable(['collection' => $patients])
        @slot('card_id') patientsIndexTable
        @endslot

        @slot('table_id') patientsTable
        @endslot

        @include('patients.table._thead')
    @enddatatable

@endsection

@section('scripts')
    <script>

        // Datatable
        var patientsTable = $('#patientsTable');
        var patientsIndexUrl = "{{ route('api.patients.index') }}";

        @include('patients.js._datatable')

    </script>
@endsection
