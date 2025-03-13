<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin'); // Ensure the user is an admin
    }

    // Display the appointments for the admin
    public function index()
    {
        $appointments = Appointment::with('doctor', 'user', 'hospital')->get();

        return view('admin.appointments.index', compact('appointments'));
    }

    // Approve an appointment
    public function approve(Appointment $appointment)
    {
        $appointment->update(['status' => 'approved']);

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment approved!');
    }

    // Cancel an appointment
    public function cancel(Appointment $appointment)
    {
        $appointment->update(['status' => 'canceled']);

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment canceled!');
    }

    private function middleware(string $string)
    {
    }
}
