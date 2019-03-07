<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/test', function () {
    $doctors = \App\Doctor::all();
    return view('test', compact('doctors'));
})->name('test');


Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

// User
Route::delete('users/{user?}', 'User\UserController@destroy')
    ->name('users.destroy');
Route::resource('users', 'User\UserController', [
    'except' => 'destroy'
]);

// UserDoctor
Route::delete('users/{user}/detach', 'User\UserDoctorController@destroy')
    ->name('users.doctors.destroy');
Route::get('users/{user}/doctors/create', 'User\UserDoctorController@create')
    ->name('users.doctors.create');

// Doctor
Route::delete('doctors/{doctor?}', 'Doctor\DoctorController@destroy')
    ->name('doctors.destroy');
Route::resource('doctors', 'Doctor\DoctorController', [
    'except' => 'destroy'
]);

// DoctorUser
Route::delete('doctors/{doctor}/users', 'Doctor\DoctorUserController@destroy')
    ->name('doctors.users.destroy');
Route::get('doctors/{doctor}/users/create', 'Doctor\DoctorUserController@create')
    ->name('doctors.users.create');

// DoctorPatient
Route::get('doctors/{doctor}/create_patient', 'Doctor\DoctorPatientController')
    ->name('doctors.patients.create');

// DoctorWorkSchedule
Route::resource('schedule', 'Doctor\DoctorWorkScheduleController', [
    'only' => ['edit', 'update', 'destroy'],
    'parameters' => ['schedule' => 'doctor'],
]);

// DoctorAbsence
Route::get('doctors/{doctor}/create_absence', 'Doctor\DoctorAbsenceController')
    ->name('doctors.absences.create');

// DoctorAppointment
Route::get('doctors/{doctor}/appointments', 'Doctor\DoctorAppointmentController@index')
    ->name('doctors.appointments.index');
Route::post('doctors/{doctor}/appointments', 'Doctor\DoctorAppointmentController@store')
    ->name('doctors.appointments.store');


// Patient
Route::delete('patients/{patient?}', 'Patient\PatientController@destroy')
    ->name('patients.destroy');
Route::resource('patients', 'Patient\PatientController', [
    'except' => 'destroy'
]);

// PatientDoctor
Route::get('patients/{patient}/add-doctor', 'Patient\PatientDoctorController@create')
    ->name('patients.doctors.create');
Route::patch('patients/{patient}/add-doctor', 'Patient\PatientDoctorController@update')
    ->name('patients.doctors.update');
Route::delete('patients/{patient}/detach-doctor', 'Patient\PatientDoctorController@destroy')
    ->name('patients.doctors.destroy');

// Absence
Route::delete('absences/{absence?}', 'Absence\AbsenceController@destroy')
        ->name('absences.destroy');
Route::resource('absences', 'Absence\AbsenceController', [
    'except' => 'destroy'
]);

// Appointment
Route::delete('appointments/{appointment?}', 'Appointment\AppointmentController@destroy')
        ->name('appointments.destroy');
Route::resource('appointments', 'Appointment\AppointmentController', [
    'except' => 'destroy'
]);