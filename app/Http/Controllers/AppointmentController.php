<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Apply auth middleware to ensure only logged-in users access these methods
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Step 1: Show the specialization selection form
    public function selectSpecialization()
    {
        $specializations = Doctor::select('specialization')->distinct()->pluck('specialization');
        return view('appointments.specializations', compact('specializations'));
    }

    // Step 2: Show doctors and the appointment form based on selected specialization
    public function showDoctorSelection(Request $request)
    {
        $specialization = $request->input('specialization');
        $doctors = Doctor::where('specialization', $specialization)->get();

        return view('appointments.book', [
            'doctors' => $doctors,
            'specialization' => $specialization
        ]);
    }

    // Step 3: Confirm and store the appointment
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|in:09:00,10:00,13:00,15:00,18:00',
        ]);

        // Create the appointment in the database
        Appointment::create([
            'user_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'hospital_id' => $request->hospital_id, // Optional if you have hospitals
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'scheduled',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');
    }

    // Show list of user's appointments
    public function index()
    {
        return view('appointments.index', [
            'appointments' => Appointment::where('user_id', auth()->id())->with('doctor.user', 'doctor.hospital')->get(),
        ]);
    }

    // Fetch doctors dynamically based on specialization (AJAX)
    public function getDoctors(Request $request)
    {
        $doctors = Doctor::where('specialization', $request->specialization)->with('user')->get();
        return response()->json($doctors);
    }

    private function middleware(string $string)
    {
    }
}
