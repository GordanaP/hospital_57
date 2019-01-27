var usersDeleteButton = 'deleteUser';
var usersDeleteUrl = "{{ route('users.destroy') }}";
var usersCheckbox = 'users';
var usersLocation = '#usersIndexTable';

deleteSingleRecord(usersDeleteButton, usersDeleteUrl, usersDatatable, usersLocation)

deleteManyRecords(usersCheckbox, usersDeleteUrl, usersDatatable, usersLocation)

checkAll(usersCheckbox, usersTable)