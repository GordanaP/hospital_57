var users = 'Users';
var deleteUser = '#deleteUser';
var deleteUsers = $('#deleteUsers')
var usersDeleteUrl = "{{ route('users.destroy') }}";
var usersLocation = '#usersIndexCard';

deleteSingleRecord(deleteUser, usersDeleteUrl, usersDatatable, usersLocation)

deleteManyRecords(users, usersDeleteUrl, usersDatatable, usersLocation)

checkAll(users, usersTable, deleteUsers)
