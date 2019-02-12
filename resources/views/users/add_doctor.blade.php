@extends('layouts.admin')

@section('title', ' | User | Add Doctor')

@section('content')

    <header class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>{{ $user->hasDoctor() ? 'Change' : 'Add' }} Doctor</h4>

        <a href="{{ route('doctors.index') }}" class="underline text-teal text-lg">
            Back to doctors
        </a>
    </header>

    <main>
        @include('users.forms._add_doctor', [
            'route' => route('users.doctors.update', $user),
            'doctorId' => old('doctor_id') ?: optional($user->doctor)->id,
            'btn_redirect' => $user->hasDoctor() ? 'Save Changes' : 'Add Doctor',
        ])
    </main>

@endsection