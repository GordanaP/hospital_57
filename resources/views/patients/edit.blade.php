@extends('layouts.admin')

@section('title', ' | Edit Patient')

@section('content')

    <header class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>Edit Patient</h4>

        <a href="{{ route('patients.index') }}" class="underline text-teal text-lg">
            Back to patients
        </a>
    </header>

    <main>
        @include('patients.forms._save', [
            'route' => route('patients.update', $patient),
            'first_name' => old('first_name') ?: $patient->first_name,
            'last_name' => old('last_name') ?: $patient->last_name,
            'gender' => old('gender') ?: $patient->gender,
            'birthday' => old('birthday') ?: $patient->birthday,
            'postal_code' => old('postal_code') ?: $patient->postal_code,
            'city' => old('city') ?: $patient->city,
            'address' => old('address') ?: $patient->address,
            'phone' => old('phone') ?: $patient->phone,
            'doctorId' => old('doctor_id') ?: $patient->doctor_id,
            'btn_redirect' => 'Save Changes',
            'btn_back' => 'Save & Continue Editing',
        ])
    </main>

@endsection