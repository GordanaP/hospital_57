@extends('layouts.admin')

@section('title', ' | Edit User')

@section('content')

    <header class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>Edit User</h4>

        <a href="{{ route('users.index') }}" class="underline text-teal text-lg">
            Back to users
        </a>
    </header>

    <main>
        @include('users.forms._save', [
            'route' => route('users.update', $user),
            'name' => old('name') ?: $user->name,
            'email' => old('email') ?: $user->email,
            'doctorId' => old('doctor_id') ?: optional($user->doctor)->id,
            'btn_redirect' => 'Save Changes',
            'btn_back' => 'Save & Continue Editing'
        ])
    </main>

@endsection

@section('scripts')

    <script>

        @include('users.js._toggle_hidden_field')

        clearErrorOnNewInput()

    </script>

@endsection