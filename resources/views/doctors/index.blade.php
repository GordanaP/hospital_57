@extends('layouts.admin')

@section('title', ' | Doctors')

@section('content')
    <header class="flex items-center justify-between mb-4 ">
        <h2>Doctors</h2>

        <span>
            <a href="{{ route('doctors.create') }}" class="btn button-teal">
                Add Doctor
            </a>
        </span>
    </header>

    @datatable(['collection' => $doctors])
        @slot('card_id') doctorsIndexTable
        @endslot

        @slot('table_id') doctorsTable
        @endslot

        @include('doctors.table._thead')
    @enddatatable
@endsection

@section('scripts')
    <script>

        // Datatable
        var doctorsTable = $('#doctorsTable');
        var doctorsIndexUrl = "{{ route('api.doctors.index') }}";

        @include('doctors.js._datatable')

        // Delete records
        var doctorsDeleteButton = 'deleteDoctor';
        var doctorsDeleteUrl = "{{ route('doctors.destroy') }}";
        var doctorsCheckbox = 'doctors';
        var doctorsLocation = '#doctorsIndexTable';

        deleteSingleRecord(doctorsDeleteButton, doctorsDeleteUrl, doctorsDatatable, doctorsLocation)

        deleteManyRecords(doctorsCheckbox, doctorsDeleteUrl, doctorsDatatable, doctorsLocation)

        checkAll(doctorsCheckbox, doctorsTable)

    </script>
@endsection
