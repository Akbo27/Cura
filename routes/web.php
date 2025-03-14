<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\AdminController;  // Missing AdminController added
use App\Http\Middleware\IsAdmin;

// ** For Normal Users (Unauthenticated):
Route::get('/', function () {
    return view('home');
})->name('home');

// ** For Admin User:
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
Route::put('appointments/{appointment}/update', [AppointmentController::class, 'update'])->name('appointments.update');
Route::put('appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

// ** For Authenticated User:
// **Step 1: Choose Specialization (Available for everyone)**
Route::get('/appointments/specializations', [AppointmentController::class, 'selectSpecialization'])
    ->name('appointments.specializations');

// **Step 2: Show hospitals for the selected specialization**
Route::get('/appointments/hospitals/{specialization}', [AppointmentController::class, 'showHospitals'])
    ->name('appointments.hospitals');

// **Step 3: Show available doctors in a selected hospital**
Route::get('/appointments/book/{hospital_id}', [AppointmentController::class, 'showDoctorSelection'])
    ->name('appointments.book');

// **Step 4: Store appointment**
Route::post('/appointments/store', [AppointmentController::class, 'store'])
    ->name('appointments.store');

// **Appointments list**
Route::resource('appointments', AppointmentController::class)->except(['create', 'store']);  // Missing closing parenthesis added here

require __DIR__.'/auth.php';
