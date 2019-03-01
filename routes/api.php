<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * User
 */
Route::get('users', 'AjaxController@usersIndex')
    ->name('api.users.index');
/**
 * Doctor
 */
Route::get('doctors', 'AjaxController@doctorsIndex')
    ->name('api.doctors.index');
/**
 * Patient
 */
Route::get('patients/{doctor?}', 'AjaxController@patientsIndex')
    ->name('api.patients.index');
/**
 * Absence
 */
Route::get('absences/{doctor?}', 'AjaxController@absencesIndex')
    ->name('api.absences.index');
/**
 * Appointment
 */
Route::get('appointments/{doctor?}', 'AjaxController@appointmentsIndex')
    ->name('api.appointments.index');
Route::post('appointments/{doctor}', 'AjaxController@appointmentsBookedSlots')
    ->name('api.appointments.available.slots');
Route::get('appointments/{appointment}/edit', 'AjaxController@appointmentsEdit');