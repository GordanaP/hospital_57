@extends('layouts.admin')

@section('title', ' | Doctor Profile')

@section('content')

    <header class="flex items-center justify-between mb-3">
        <h4 class="flex items-center">
            <a href="{{ route('doctors.show', $doctor) }}" class="hover:no-underline"
                style="color:#7986cb"
            >
                {{ $doctor->title_name }}
            </a>
        </h4>

        <div class="flex items-center">
            <a href="{{ route('doctors.index') }}"
                class="underline text-grey-dark hover:text-grey-darker text-lg mr-4">
                Back to doctors
            </a>

            <a href="{{ route('doctors.absences.create', $doctor) }}" class="btn button-teal">
                <span data-feather="plus-square"></span>
            </a>
        </div>
    </header>

    <main id="absencesIndexCard">
        @datatable(['collection' => $doctor->absences])
            @slot('card_id') absencesIndexTable
            @endslot

            @slot('table_id') doctorAbsencesTable
            @endslot

            @include('absences.table._thead')

            @slot('items') absences
            @endslot
        @enddatatable
    </main>

@endsection

@section('scripts')
    <script>

        // Absences
        var absencesTable = $('#doctorAbsencesTable');
        var absencesIndexUrl = "{{ route('api.absences.index', $doctor) }}";
        var doctorExists = true;

        @include('absences.js._datatable')

        @include('absences.js._delete')

    </script>
@endsection
