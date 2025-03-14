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

    // Display appointments for the admin
    public function index()
    {
        $appointments = Appointment::all();
        return view('admin.dashboard', compact('appointments'));
    }

    private function middleware(string $string)
    {
    }
}
