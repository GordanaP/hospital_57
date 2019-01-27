<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::resource('users', 'User\UserController');