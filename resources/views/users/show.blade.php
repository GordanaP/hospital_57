@extends('layouts.admin')

@section('title', ' | Display User')

@section('content')

    <header class="flex items-center justify-between mb-3">
        <h4>User Details</h4>

        @include('partials.buttons._delete_edit', [
            'name' => 'users',
            'parameter' => $user
        ])
    </header>

    @include('users.html._details')

@endsection