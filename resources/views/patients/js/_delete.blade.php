var patients = 'Patients';
var deletePatient = '#deletePatient';
var deletePatients = $('#deletePatients')
var deletePatientsUrl = "{{ route('patients.destroy') }}";
var patientsLocation = '#patientsIndexCard';

deleteSingleRecord(deletePatient, deletePatientsUrl, patientsDatatable, patientsLocation)

deleteManyRecords(patients, deletePatientsUrl, patientsDatatable, patientsLocation)

checkAll(patients, patientsTable, deletePatients)