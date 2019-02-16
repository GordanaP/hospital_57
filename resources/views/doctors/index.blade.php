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

    <main id="doctorsIndexCard">
        @datatable(['collection' => $doctors])

            @slot('table_id') doctorsTable
            @endslot

            @include('doctors.table._thead')

            @slot('items') doctors
            @endslot

        @enddatatable
    </main>

@endsection

@section('scripts')
    <script>

        // Datatable
        var doctorsTable = $('#doctorsTable');
        var doctorsIndexUrl = "{{ route('api.doctors.index') }}";

        @include('doctors.js._datatable')

        // Delete records
        @include('doctors.js._delete')

    </script>
@endsection
