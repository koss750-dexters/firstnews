<?php

use App\Http\Controllers\Api\TeacherRegistrationApiController;
use Illuminate\Support\Facades\Route;

Route::post('/teachers/register', [TeacherRegistrationApiController::class, 'register']);


