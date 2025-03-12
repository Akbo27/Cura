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

    // Show appointment booking form
    public function create()
    {
        return view('appointments.create', [
            'hospitals' => Hospital::all(),
            'specializations' => Doctor::select('specialization')->distinct()->pluck('specialization'),
        ]);
    }

    // Store the new appointment in the database
    public function store(Request $request)
    {
        $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|in:09:00,10:00,13:00,15:00,18:00',
        ]);

        Appointment::create([
            'user_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'hospital_id' => $request->hospital_id,
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

    // Show details of a single appointment
    public function show(Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            abort(403); // Prevent unauthorized access
        }

        return view('appointments.show', compact('appointment'));
    }

    // Edit appointment details
    public function edit(Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            abort(403);
        }

        return view('appointments.edit', [
            'appointment' => $appointment,
            'hospitals' => Hospital::all(),
            'doctors' => Doctor::all(),
        ]);
    }

    // Update appointment details
    public function update(Request $request, Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|in:09:00,10:00,13:00,15:00,18:00',
        ]);

        $appointment->update([
            'doctor_id' => $request->doctor_id,
            'hospital_id' => $request->hospital_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'scheduled',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    // Delete an appointment
    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            abort(403);
        }

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment canceled successfully!');
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
