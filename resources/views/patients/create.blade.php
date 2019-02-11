@extends('layouts.admin')

@section('title', ' | Add Patient')

@section('content')

    <header class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>Create Patient</h4>

        <a href="{{ route('patients.index') }}" class="underline text-teal text-lg">
            Back to patients
        </a>
    </header>

    <main>
        @include('patients.forms._save', [
            'route' => route('patients.store'),
            'first_name' => old('first_name'),
            'last_name' => old('last_name'),
            'gender' => old('gender'),
            'birthday' => old('birthday'),
            'postal_code' => old('postal_code'),
            'city' => old('city'),
            'address' => old('address'),
            'phone' => old('phone'),
            'doctorId' => old('doctor_id'),
            'btn_redirect' => 'Create Patient',
            'btn_back' => 'Create Patient & Add Another',
        ])
    </main>

@endsection

@section('scripts')
    <script>


    </script>
@endsection