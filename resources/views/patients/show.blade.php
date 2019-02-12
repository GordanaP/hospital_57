@extends('layouts.admin')

@section('title', ' | Display Patient')

@section('content')

    <header class="flex items-center justify-between mb-3">
        <h4>Patient Details</h4>

        <div class="flex items-center">
            <a href="{{ route('patients.index') }}"
                class="underline text-teal hover:text-teal-darker text-lg mr-4">
                Back to patients
            </a>

            @include('partials.buttons._delete_edit', [
                'name' => 'patients',
                'parameter' => $patient
            ])
        </div>
    </header>

    <main class="card card-body card-shadow">
        @include('patients.html._details')
    </main>

@endsection