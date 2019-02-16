@extends('layouts.admin')

@section('title', ' | Add User')

@section('content')

    <header class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>Create User</h4>

        <a href="{{ route('users.index') }}" class="underline text-teal text-lg">
            Back to users
        </a>
    </header>

    <main>
        @include('users.forms._save', [
            'route' => route('users.store'),
            'name' => old('name'),
            'email' => old('email'),
            'doctorId' => old('doctor_id'),
            'btn_redirect' => 'Create User',
            'btn_back' => 'Create User & Add Another',
        ])
    </main>

@endsection

@section('scripts')

    @include('users.js._toggle_hidden_field')

@endsection