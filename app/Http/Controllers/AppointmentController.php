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
        // Fetch distinct specializations
        $specializations = Doctor::select('specialization')->distinct()->pluck('specialization');
        return view('appointments.specializations', compact('specializations'));
    }

    // Step 2: Show doctors and the appointment form based on selected specialization
    public function showDoctorSelection(Request $request)
    {
        // Get the specialization from the request
        $specialization = $request->input('specialization');
        // Fetch doctors based on the selected specialization
        $doctors = Doctor::where('specialization', $specialization)->get();

        // Pass the data to the book view
        return view('appointments.book', [
            'doctors' => $doctors,
            'specialization' => $specialization
        ]);
    }

    // Step 3: Confirm and store the appointment
    public function store(Request $request)
    {
        $request->validate([
            'doctor' => 'required|exists:doctors,id',
            'appointment_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $year = (int) date('Y', strtotime($value));
                    if ($year < 2024) {
                        $fail('The appointment year must be 2024 or later.');
                    }
                },
            ],
            'appointment_time' => 'required|in:09:00,10:00,13:00,15:00,18:00',
        ]);

        Appointment::create([
            'user_id' => auth()->id(),
            'doctor_id' => $request->doctor,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'scheduled',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');
    }

    // Show list of user's appointments
    public function index()
    {
        $appointments = Appointment::where('user_id', auth()->id())
            ->with('doctor.hospital') // Ensure relationships are loaded
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    // Fetch doctors dynamically based on specialization (AJAX - not used in this case)
    public function getDoctors(Request $request)
    {
        // Fetch doctors based on specialization from the request
        $doctors = Doctor::where('specialization', $request->specialization)->with('user')->get();
        return response()->json($doctors);
    }

    private function middleware(string $string)
    {
    }
}
