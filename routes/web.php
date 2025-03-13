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

    // **Step 1: Choose specialization**
    Route::get('/appointments/specializations', [AppointmentController::class, 'selectSpecialization'])
        ->name('appointments.specializations');

    // **Step 2: Choose doctor, date & time**
    Route::get('/appointments/book', [AppointmentController::class, 'showDoctorSelection'])
        ->name('appointments.book');

    Route::post('/appointments/store', [AppointmentController::class, 'store'])
        ->name('appointments.store');

    // **Resource routes for appointments (except create and store)**
    Route::resource('appointments', AppointmentController::class)->except(['create', 'store']);

    // **Doctors & Hospitals**
    Route::resource('doctors', DoctorController::class);
    Route::resource('hospitals', HospitalController::class);
});

require __DIR__.'/auth.php';
