@extends('layouts.admin')

@section('title', ' | Users')

@section('content')

    <header class="flex items-center justify-between mb-4 ">
        <h2>Users</h2>

        <span>
            <a href="{{ route('users.create') }}" class="btn button-teal">
                Add User
            </a>
        </span>
    </header>

    <main id="usersIndexCard">
        @datatable(['collection' => $users])
            @slot('table_id') usersTable
            @endslot

            @include('users.table._thead')

            @slot('items') users
            @endslot
        @enddatatable
    </main>

@endsection

@section('scripts')
    <script>

        // Datatable
        var usersTable = $('#usersTable');
        var usersIndexUrl = "{{ route('api.users.index') }}";

        @include('users.js._datatable')

        // Delete records
        @include('users.js._delete')

    </script>
@endsection