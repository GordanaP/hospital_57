<header class="flex items-center justify-between mb-3 ">
    <h4>Absences</h4>

    <span>
        <a href="#" class="btn button-teal">
            <span data-feather="plus-square"></span>
        </a>
    </span>
</header>

<main>
    @datatable(['collection' => $doctor->absences])
        @slot('card_id') absencesIndexTable
        @endslot

        @slot('table_id') doctorAbsencesTable
        @endslot

        @include('absences.table._thead')
    @enddatatable
</main>