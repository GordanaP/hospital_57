<header class="flex items-center justify-between mb-3">
    <h4 class="flex items-center">
        {{ $doctor->title_name }}

        @if ($doctor->hasWorkSchedule())
            <a href="{{ route('doctors.appointments.index', $doctor) }}">
                <svg class="fill-current text-yellow hover:text-yellow-dark inline-block h-12 w-12 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"/></svg>
            </a>
        @endif
    </h4>

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

<main class="card card-body card-shadow">
    @include('doctors.html._details')
</main>