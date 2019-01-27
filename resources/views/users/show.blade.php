@extends('layouts.admin')

@section('title', ' | Display User')

@section('content')

    <header class="flex items-center justify-between mb-3">
        <h4>User Details</h4>

        <div class="flex items-center">
            <a href="{{ route('users.index') }}"
                class="underline text-teal hover:text-teal-darker text-lg mr-4">
                Back to users
            </a>

            @include('partials.buttons._delete_edit', [
                'name' => 'users',
                'parameter' => $user
            ])
        </div>
    </header>

    @include('users.html._details')

@endsection