@extends('layouts.admin')

@section('title', ' | Edit Absence')

@section('content')

    <header class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>Edit Absence</h4>

        <a href="{{ route('absences.index') }}" class="underline text-teal text-lg">
            Back to absences
        </a>
    </header>

    <main>
        @include('absences.forms._save', [
            'route' => route('absences.update', $absence),
            'doctorId' => old('doctor_id') ?: $absence->doctor_id,
            'description' => old('description') ?: $absence->description,
            'start_at' => old('start_at')  ?: $absence->start_at,
            'end_at' => old('end_at')  ?: $absence->end_at,
            'btn_redirect' => 'Save Changes',
            'btn_back' => 'Save & Continue Editing',
        ])
    </main>

@endsection

@section('scripts')
    <script>

        clearErrorOnNewInput()

    </script>
@endsection