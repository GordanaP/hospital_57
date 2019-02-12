<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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
Route::put('users/{user}/doctors', 'User\UserDoctorController@update')
    ->name('users.doctors.update');
Route::get('users/{user}/doctors/create', 'User\UserDoctorController@create')
    ->name('users.doctors.create');

// Doctor
Route::delete('doctors/{doctor?}', 'Doctor\DoctorController@destroy')
    ->name('doctors.destroy');
Route::resource('doctors', 'Doctor\DoctorController', [
    'except' => 'destroy'
]);

// DoctorUser
Route::post('doctors/{doctor}/users', 'Doctor\DoctorUserController@store')
    ->name('doctors.users.store');
Route::delete('doctors/{doctor}/users', 'Doctor\DoctorUserController@destroy')
    ->name('doctors.users.destroy');
Route::get('doctors/{doctor}/users/create', 'Doctor\DoctorUserController@create')
    ->name('doctors.users.create');

// DoctorPatient
Route::get('doctors/{doctor}/create_patient', 'Doctor\DoctorPatientController')
    ->name('doctors.patients.create');

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
