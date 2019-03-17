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

            @if ($doctor->hasWorkSchedule())
                @include('partials.buttons._delete_edit', [
                    'name' => 'schedule',
                    'parameter' => $doctor
                ])
            @else
                <a href="{{ route('schedule.edit', $doctor) }}"  class="btn button-edit pt-2 ml-1">
                    <span data-feather="plus-square"></span>
                </a>
            @endif

        </div>
    </header>


    <main class="card card-body border-grey-lighter card-shadow">
        @if ($doctor->hasWorkSchedule())
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        @foreach ($business_days as $day)
                            <th
                                @if ($doctor->isWorkingOnDay($day->index))
                                    class="bg-grey-light"
                                @endif
                            >
                                {{ $day->name }}
                            </th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach (Day::all() as $id => $day)
                            <th
                                @if ($doctor->isWorkingOnDay($id))
                                    class="bg-grey-lightest"
                                @endif
                            >
                                @foreach ($doctor->working_days as $day)
                                    @if ($day->index == $id)
                                        {{ $day->hour->start_at }} - {{ $day->hour->end_at }}
                                    @endif
                                @endforeach
                            </th>
                        @endforeach
                    </tr>
                </thead>
            </table>
        @else
            @include('partials.table._empty')
        @endif
    </main>

@endsection