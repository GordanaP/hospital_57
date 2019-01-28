@extends('layouts.admin')

@section('title', ' | Edit Doctor')

@section('content')
    <div class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>Create Doctor</h4>

        <a href="{{ route('doctors.index') }}" class="underline text-teal text-lg">
            Back to doctors
        </a>
    </div>


    @include('doctors.forms._save', [
        'route' => route('doctors.update', $doctor),
        'title' => old('title') ?: $doctor->title,
        'first_name' => old('first_name') ?: $doctor->first_name,
        'last_name' => old('last_name') ?: $doctor->last_name,
        'specialty' => old('specialty') ?: $doctor->specialty,
        'license' => old('license') ?: $doctor->license,
        'biography' => old('biography') ?: $doctor->biography,
        'color' => old('color') ?: $doctor->color,
        'app_slot' => old('app_slot') ?: $doctor->app_slot,
        'btn_redirect' => 'Save Changes',
        'btn_back' => 'Save & Continue Editing',
    ])

@endsection

@section('scripts')
    <script>
        @include('doctors.js._enable_file_input')
    </script>
@endsection
