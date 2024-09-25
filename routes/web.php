<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () { return view('layouts/app'); }) -> name('app');
Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');




// AUTH View
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/profile/show', function () { return view('profile/show'); })->name('profile.show');
});
