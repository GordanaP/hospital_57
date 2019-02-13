<header class="flex items-center justify-between mb-3 ">
    <h4>Work Schedule</h4>

    <span>
        <a href="{{ route('schedule.edit', $doctor) }}"
        class="btn button-teal">
            {{ $doctor->hasWorkSchedule() ? 'Update' : 'Add' }} Schedule
        </a>
    </span>
</header>

<main>
    <div class="card card-body border-grey-lighter card-shadow">
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
    </div>
</main>