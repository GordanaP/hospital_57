var doctorsDeleteButton = 'deleteDoctor';
var doctorsDeleteUrl = "{{ route('doctors.destroy') }}";
var doctorsCheckbox = 'doctors';
var doctorsLocation = '#doctorsIndexTable';

deleteSingleRecord(doctorsDeleteButton, doctorsDeleteUrl, doctorsDatatable, doctorsLocation)

deleteManyRecords(doctorsCheckbox, doctorsDeleteUrl, doctorsDatatable, doctorsLocation)

checkAll(doctorsCheckbox, doctorsTable)