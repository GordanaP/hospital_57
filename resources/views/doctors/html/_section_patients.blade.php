<header class="flex items-center justify-between mb-3 ">
    <h4>Patients</h4>

    <span>
        <a href="{{ route('doctors.patients.create', $doctor) }}"
        class="btn button-teal">
            Add Patient
        </a>
    </span>
</header>

<main>
    @datatable(['collection' => $doctor->patients])
        @slot('card_id') patientsIndexTable
        @endslot

        @slot('table_id') doctorPatientsTable
        @endslot

        @include('patients.table._thead')
    @enddatatable
</main>