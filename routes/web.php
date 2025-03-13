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

// **Step 1: Choose Specialization (Available for everyone)**
Route::get('/appointments/specializations', [AppointmentController::class, 'selectSpecialization'])
    ->name('appointments.specializations');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    // **Step 2: Show hospitals for the selected specialization**
    Route::get('/appointments/hospitals/{specialization}', [AppointmentController::class, 'showHospitals'])
        ->name('appointments.hospitals');

    // **Step 3: Show available doctors in a selected hospital**
    Route::get('/appointments/book/{hospital_id}', [AppointmentController::class, 'showDoctorSelection'])
        ->name('appointments.book');

    // **Step 4: Store appointment**
    Route::post('/appointments/store', [AppointmentController::class, 'store'])
        ->name('appointments.store');

    // **Appointments list for the logged-in user**
    Route::resource('appointments', AppointmentController::class)->except(['create', 'store']);

    // **Doctors & Hospitals Management**
    Route::resource('doctors', DoctorController::class);
    Route::resource('hospitals', HospitalController::class);
});

require __DIR__.'/auth.php';
