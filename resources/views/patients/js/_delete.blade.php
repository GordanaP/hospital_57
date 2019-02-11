var patientsDeleteButton = 'deletePatient';
var patientsDeleteUrl = "{{ route('patients.destroy') }}";
var patientsCheckbox = 'patients';
var patientsLocation = '#patientsIndexTable';

deleteSingleRecord(patientsDeleteButton, patientsDeleteUrl, patientsDatatable, patientsLocation)

deleteManyRecords(patientsCheckbox, patientsDeleteUrl, patientsDatatable, patientsLocation)

checkAll(patientsCheckbox, patientsTable)