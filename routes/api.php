<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', 'AjaxController@usersIndex')
    ->name('api.users.index');
Route::get('doctors', 'AjaxController@doctorsIndex')
    ->name('api.doctors.index');
Route::get('patients/{doctor?}', 'AjaxController@patientsIndex')
    ->name('api.patients.index');
Route::get('absences/{doctor?}', 'AjaxController@absencesIndex')
    ->name('api.absences.index');