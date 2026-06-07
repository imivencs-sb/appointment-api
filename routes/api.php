<?php

use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use Illuminate\Support\Facades\Route;

Route::apiResource('doctors', DoctorController::class);
Route::apiResource('patients', PatientController::class);