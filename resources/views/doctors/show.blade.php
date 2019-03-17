@extends('layouts.admin')

@section('title', ' | Display doctor')

@section('links')
    <style>
        .abc { color: #ffecb3; }
    </style>
@endsection

@section('content')

    <header class="flex items-center justify-between mb-3">
        <h4 class="flex items-center">
            {{ $doctor->title_name }}
        </h4>

        <div class="flex items-center">
            <a href="{{ route('doctors.index') }}"
                class="underline text-grey-dark hover:text-grey-darker text-lg mr-4">
                Back to doctors
            </a>

            @include('partials.buttons._delete_edit', [
                'name' => 'doctors',
                'parameter' => $doctor
            ])
        </div>
    </header>

    <div class="row mt-8">
        <div class="col-md-3">
            @include('doctors.show.partials._profile')
        </div>
        <div class="col-md-3">
            @include('doctors.show.partials._account')

        </div>
        <div class="col-md-3">
            @include('doctors.show.partials._patients')

        </div>
        <div class="col-md-3">
            @include('doctors.show.partials._appointments')
        </div>
    </div>

    <div class="row mt-12">
        <div class="col-md-3">
            @include('doctors.show.partials._schedule')
        </div>
        <div class="col-md-3">
            @include('doctors.show.partials._absences')
        </div>
    </div>

@endsection