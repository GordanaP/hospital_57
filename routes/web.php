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

// Doctor
Route::delete('doctors/{doctor?}', 'Doctor\DoctorController@destroy')
    ->name('doctors.destroy');
Route::resource('doctors', 'Doctor\DoctorController', [
    'except' => 'destroy'
]);

// DoctorUser
Route::post('doctors/{doctor}/users', 'Doctor\DoctorUserController@store')
        ->name('doctors.users.store');
Route::get('doctors/{doctor}/users/create', 'Doctor\DoctorUserController@create')
    ->name('doctors.users.create');