@showDoctor
    @slot('href') href={{ route('doctors.absences.show', $doctor) }}
    @endslot

    @slot('fill') brown-lightest-custom @endslot

    @slot('hover') brown-lighter-custom @endslot

    @slot('path')
        M17 16a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4.01V4a1 1 0 0 1 1-1 1 1
        0 0 1 1 1v6h1V2a1 1 0 0 1 1-1 1 1 0 0 1 1 1v8h1V1a1 1 0 1 1
        2 0v9h1V2a1 1 0 0 1 1-1 1 1 0 0 1 1 1v13h1V9a1 1 0 0 1 1-1h1v8z
    @endslot

    @slot('title') Absences @endslot
@endshowDoctor

