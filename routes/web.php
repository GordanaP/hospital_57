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