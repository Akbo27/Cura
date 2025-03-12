<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::resource('appointments', AppointmentController::class);
    Route::get('/get-doctors', [AppointmentController::class, 'getDoctors']);

    Route::resource('doctors', DoctorController::class);
    Route::resource('hospitals', HospitalController::class);
});

require __DIR__.'/auth.php';
