<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Show the appointments creation form
    public function create()
    {
        // Fetch all hospitals and doctors to display in the form
        return view('appointments.create', [
            'hospitals' => Hospital::all(),
            'doctors' => Doctor::all(),
        ]);
    }

    // Store the new appointments in the database
    public function store(Request $request)
    {
        // Validate the incoming data from the form
        $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        // Create the appointments record
        Appointment::create([
            'user_id' => auth()->id(),  // Store the logged-in user's ID
            'doctor_id' => $request->doctor_id,
            'hospital_id' => $request->hospital_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'scheduled',  // Set the status to 'scheduled' by default
        ]);

        // Redirect back with success message
        return redirect()->route('appointments.index')->with('success', 'appointments booked successfully!');
    }

    // Show the list of appointments for the logged-in user
    public function index()
    {
        // Fetch appointments of the currently authenticated user
        $appointments = Appointment::where('user_id', auth()->id())->get();

        // Return a view to show the user's appointments
        return view('appointments.index', [
            'appointments' => $appointments,
        ]);
    }

    // Show details of a single appointments
    public function show($id)
    {
        // Fetch the appointments by its ID and ensure it belongs to the logged-in user
        $appointment = Appointment::where('user_id', auth()->id())->findOrFail($id);

        // Return the view with the appointments data
        return view('appointments.show', [
            'appointments' => $appointment,
        ]);
    }

    // Edit the appointments details
    public function edit($id)
    {
        // Fetch the appointments by its ID and ensure it belongs to the logged-in user
        $appointment = Appointment::where('user_id', auth()->id())->findOrFail($id);

        // Fetch hospitals and doctors to show in the form
        $hospitals = Hospital::all();
        $doctors = Doctor::all();

        // Return the edit view with the data
        return view('appointments.edit', [
            'appointments' => $appointment,
            'hospitals' => $hospitals,
            'doctors' => $doctors,
        ]);
    }

    // Update the appointments details in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming data from the form
        $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        // Find the appointments to update
        $appointment = Appointment::where('user_id', auth()->id())->findOrFail($id);

        // Update the appointments details
        $appointment->update([
            'doctor_id' => $request->doctor_id,
            'hospital_id' => $request->hospital_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'scheduled',  // Status remains scheduled unless changed
        ]);

        // Redirect back with a success message
        return redirect()->route('appointments.index')->with('success', 'appointments updated successfully!');
    }

    // Delete an appointments from the database
    public function destroy($id)
    {
        // Find the appointments and ensure it belongs to the logged-in user
        $appointment = Appointment::where('user_id', auth()->id())->findOrFail($id);

        // Delete the appointments
        $appointment->delete();

        // Redirect back with a success message
        return redirect()->route('appointments.index')->with('success', 'appointments canceled successfully!');
    }
}
