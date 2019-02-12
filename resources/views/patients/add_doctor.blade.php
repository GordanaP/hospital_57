@extends('layouts.admin')

@section('title', ' | Patient | Add Doctor')

@section('content')

    <header class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>{{ $patient->hasDoctor() ? 'Change' : 'Add' }} Doctor</h4>

        <a href="{{ route('patients.index') }}" class="underline text-teal text-lg">
            Back to patients
        </a>
    </header>

    @include('patients.forms._add_doctor', [
        'doctorId' => old('doctor_id') ?: optional($patient->doctor)->id,
        'btn_redirect' => $patient->hasDoctor() ? 'Save Changes' : 'Add Doctor',
    ])

@endsection