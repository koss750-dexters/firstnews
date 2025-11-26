<?php

use App\Http\Controllers\TeacherRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TeacherRegistrationController::class, 'showForm'])->name('registration.form');
Route::get('/register', function () {
    return redirect()->route('registration.form');
})->name('registration.form.redirect');
Route::post('/register', [TeacherRegistrationController::class, 'register'])->name('registration.submit');

