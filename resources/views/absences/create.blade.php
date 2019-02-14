@extends('layouts.admin')

@section('title', ' | Add Absence')

@section('content')

    <header class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>Create Absence</h4>

        <a href="{{ route('absences.index') }}" class="underline text-teal text-lg">
            Back to absences
        </a>
    </header>

    <main>
        @include('absences.forms._save', [
            'route' => route('absences.store'),
            'doctorId' => old('doctor_id'),
            'description' => old('description'),
            'start_at' => old('start_at'),
            'end_at' => old('end_at'),
            'btn_redirect' => 'Create Absence',
            'btn_back' => 'Create Absence & Add Another',
        ])
    </main>

@endsection