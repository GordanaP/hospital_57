@extends('layouts.admin')

@section('title', ' | Display doctor')

@section('content')

    <header class="flex items-center justify-between mb-3">
        <h4>{{ $doctor->title_name }}</h4>

        <div class="flex items-center">
            <a href="{{ route('doctors.index') }}"
                class="underline text-teal hover:text-teal-darker text-lg mr-4">
                Back to doctors
            </a>

            @include('partials.buttons._delete_edit', [
                'name' => 'doctors',
                'parameter' => $doctor
            ])
        </div>
    </header>

    @include('doctors.html._details')

@endsection