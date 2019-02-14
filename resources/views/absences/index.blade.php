@extends('layouts.admin')

@section('title', ' | Absences')

@section('content')

    <header class="flex items-center justify-between mb-4 ">
        <h2>Absences</h2>

        <span>
            <a href="{{ route('absences.create') }}" class="btn button-teal">
                Add Absence
            </a>
        </span>
    </header>

    @datatable(['collection' => $absences])
        @slot('card_id') absencesIndexTable
        @endslot

        @slot('table_id') absencesTable
        @endslot

        @include('absences.table._thead')
    @enddatatable

@endsection

@section('scripts')
    <script>

        // Datatable
        var absencesTable = $('#absencesTable');
        var absencesIndexUrl = "{{ route('api.absences.index') }}";
        var doctorExists = false;

        @include('absences.js._datatable')

    </script>
@endsection
