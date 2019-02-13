@extends('layouts.admin')

@section('title', ' | Doctor | Edit Work Schedule')

@section('content')

    <header class="flex items-center justify-between w-4/5 mx-auto mb-4">

        <h4>{{ $doctor->hasWorkSchedule() ? 'Edit' : 'Create' }} Schedule</h4>

    </header>

    <main>
        @include('schedules.forms._save', [
            'btn_redirect' => 'Save Schedule',
            'btn_back' => 'Save Schedule & Conitunue Saving',
        ])
    </main>

@endsection