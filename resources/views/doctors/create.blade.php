@extends('layouts.admin')

@section('title', ' | Add Doctor')

@section('content')

    <header class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>Create Doctor</h4>

        <a href="{{ route('doctors.index') }}" class="underline text-teal text-lg">
            Back to doctors
        </a>
    </header>

    <main>
        @include('doctors.forms._save', [
            'route' => route('doctors.store'),
            'title' => old('title'),
            'first_name' => old('first_name'),
            'last_name' => old('last_name'),
            'specialty' => old('specialty'),
            'license' => old('license'),
            'biography' => old('biography'),
            'color' => old('color'),
            'app_slot' => old('app_slot'),
            'btn_redirect' => 'Create Doctor',
            'btn_back' => 'Create Doctor & Add Another',
        ])
    </main>

@endsection

@section('scripts')
    <script>

        @include('doctors.js._enable_file_input')

        clearErrorOnNewInput()

    </script>
@endsection