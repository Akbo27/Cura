<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Step 1: Show available specializations
    public function selectSpecialization()
    {
        // Fetch distinct specializations
        $specializations = Doctor::select('specialization')->distinct()->pluck('specialization');
        return view('appointments.specializations', compact('specializations'));
    }

    // Step 2: Show hospitals offering the selected specialization
    public function showHospitals($specialization)
    {
        // Fetch hospitals that have doctors with the selected specialization
        $hospitals = Hospital::whereHas('doctors', function ($query) use ($specialization) {
            $query->where('specialization', $specialization);
        })->get();

        return view('appointments.hospitals', compact('hospitals', 'specialization'));
    }

    public function showDoctorSelection(Request $request, $hospital_id)
    {
        if (!$hospital_id) {
            return redirect()->route('appointments.specializations')->with('error', 'Hospital ID is missing');
        }

        // Ensure specialization and hospital_id are retrieved
        $specialization = $request->input('specialization');
        $hospital = Hospital::findOrFail($hospital_id); // Get hospital by ID

        // Fetch doctors that belong to the selected hospital and have the selected specialization
        $doctors = Doctor::where('specialization', $specialization)
            ->where('hospital_id', $hospital->id)
            ->get();

        // Pass specialization, hospital, and doctors to the view
        return view('appointments.book', [
            'doctors' => $doctors,
            'specialization' => $specialization,
            'hospital' => $hospital,
            'hospital_id' => $hospital_id,
        ]);
    }

    // Step 4: Confirm and store the appointment
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
