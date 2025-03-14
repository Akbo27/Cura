<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    // Display the appointments for the admin
    public function index()
    {
        $appointments = Appointment::with('doctor', 'user', 'hospital')->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    private function middleware(string $string)
    {
    }
}
