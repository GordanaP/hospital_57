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

    @datatable(['collection' => $users])
        @slot('card_id') usersIndexTable
        @endslot

        @slot('table_id') usersTable
        @endslot

        @include('users.table._thead')
    @enddatatable

@endsection

@section('scripts')
    <script>

        // Datatable
        var usersTable = $('#usersTable');
        var usersIndexUrl = "{{ route('api.users.index') }}";

        @include('users.js._datatable')

        var usersDeleteButton = 'deleteUser';
        var usersDeleteUrl = "{{ route('users.destroy') }}";
        var usersCheckbox = 'users';
        var usersLocation = '#usersIndexTable';

        @include('users.js._delete')

    </script>
@endsection