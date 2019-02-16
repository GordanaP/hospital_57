<header class="flex items-center justify-between mb-3 ">
    <h4>Patients</h4>

    <span>
        <a href="{{ route('doctors.patients.create', $doctor) }}"
        class="btn button-teal">
            <span data-feather="plus-square"></span>
        </a>
    </span>
</header>

<main id="patientsIndexCard">
    @datatable(['collection' => $doctor->patients])
        @slot('card_id') patientsIndexTable
        @endslot

        @slot('table_id') doctorPatientsTable
        @endslot

        @include('patients.table._thead')

        @slot('items') patients
        @endslot
    @enddatatable
</main>