@extends('layouts.admin')

@section('title', ' | Doctor Profile')

@section('content')

    <header class="flex items-center justify-between mb-3">
        <h4 class="flex items-center">
            <a href="{{ route('doctors.show', $doctor) }}" class="hover:no-underline"
                style="color:#7986cb"
            >
                {{ $doctor->title_name }}
            </a>
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

    <main class="card card-body card-shadow">
        @include('doctors.html._details')
    </main>

@endsection