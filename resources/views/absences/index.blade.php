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

    <main id="absencesIndexCard">
        @datatable(['collection' => $absences])
            @slot('table_id') absencesTable
            @endslot

            @include('absences.table._thead')

            @slot('items') absences
            @endslot
        @enddatatable
    </main>

@endsection

@section('scripts')
    <script>

        // Datatable
        var absencesTable = $('#absencesTable');
        var absencesIndexUrl = "{{ route('api.absences.index') }}";
        var doctorExists = false;

        @include('absences.js._datatable')

        // Delete records
        @include('absences.js._delete')

    </script>
@endsection
