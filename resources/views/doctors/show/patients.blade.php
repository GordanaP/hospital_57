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

            <a href="{{ route('doctors.patients.create', $doctor) }}"
            class="btn button-teal">
                <span data-feather="plus-square"></span>
            </a>
        </div>
    </header>

    <main id="patientsIndexCard">
        @datatable(['collection' => $doctor->patients])
            @slot('card_id') patientsIndexTable
            @endslot

            @slot('table_id') doctorPatientsTable
            @endslot

            @include('patients.table._thead')

            @slot('items') patients
            @endslot
        @enddatatable
    </main>

@endsection

@section('scripts')
    <script>

        // Patients
        var patientsTable = $('#doctorPatientsTable');
        var patientsIndexUrl = "{{ route('api.patients.index', $doctor) }}";

        @include('patients.js._datatable')

        @include('patients.js._delete')

    </script>
@endsection
