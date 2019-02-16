var absences = 'Absences';
var deleteAbsence = '#deleteAbsence';
var deleteAbsences = $('#deleteAbsences')
var deleteAbsencesUrl = "{{ route('absences.destroy') }}";
var absencesLocation = '#absencesIndexCard';

deleteSingleRecord(deleteAbsence, deleteAbsencesUrl, absencesDatatable, absencesLocation)

deleteManyRecords(absences, deleteAbsencesUrl, absencesDatatable, absencesLocation)

checkAll(absences, absencesTable, deleteAbsences)
