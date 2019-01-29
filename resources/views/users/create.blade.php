@extends('layouts.admin')

@section('title', ' | Add User')

@section('content')

    <div class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>Create User</h4>

        <a href="{{ route('users.index') }}" class="underline text-teal text-lg">
            Back to users
        </a>
    </div>

    @include('users.forms._save', [
        'route' => request()->route()->named('users.create')
            ? route('users.store') : route('doctors.users.store', $doctor),
        'name' => old('name'),
        'email' => old('email'),
        'btn_redirect' => 'Create User',
        'btn_back' => 'Create User & Add Another',
    ])
@endsection

@section('scripts')

    @include('users.js._toggle_hidden_field')

@endsection