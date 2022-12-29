<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// APP Routes Below
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['web', 'auth', 'verified'])->name('dashboard');
