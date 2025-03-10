@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="text-center">
        <h1 class="text-3xl font-bold">Welcome to Hospital Booking System</h1>
        <p class="mt-2">Book an appointment with top doctors in your city.</p>
        <a href="{{ route('appointments.create') }}" class="bg-blue-500 text-white px-6 py-3 mt-4 inline-block rounded">
            Book Appointment Now
        </a>
    </div>
@endsection

