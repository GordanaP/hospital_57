var doctors = 'Doctors';
var deleteDoctor = '#deleteDoctor';
var deleteDoctors = $('#deleteDoctors')
var deleteDoctorsUrl = "{{ route('doctors.destroy') }}";
var doctorsLocation = '#doctorsIndexCard';

deleteSingleRecord(deleteDoctor, deleteDoctorsUrl, doctorsDatatable, doctorsLocation)

deleteManyRecords(doctors, deleteDoctorsUrl, doctorsDatatable, doctorsLocation)

checkAll(doctors, doctorsTable, deleteDoctors)