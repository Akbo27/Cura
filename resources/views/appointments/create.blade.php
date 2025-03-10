@extends('layouts.app')

@section('title', 'Book appointments')

@section('content')
    <h2 class="text-2xl font-bold">Book an Appointment</h2>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="mb-4">
            <ul class="text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST" class="mt-4 bg-white p-6 shadow rounded">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Select Hospital</label>
            <select name="hospital_id" id="hospital_id" class="w-full border p-2 rounded">
                <option value="">-- Choose a Hospital --</option>
                @forelse($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @empty
                    <option disabled>No hospitals available</option>
                @endforelse
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Select Doctor</label>
            <select name="doctor_id" id="doctor_id" class="w-full border p-2 rounded">
                <option value="">-- Select a Doctor --</option>
                @forelse($doctors as $doctor)
                    <option value="{{ $doctor->id }}">
                        {{ $doctor->user ? $doctor->user->name : 'Unknown Doctor' }} ({{ $doctor->specialization }})
                    </option>
                @empty
                    <option disabled>No doctors available</option>
                @endforelse
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Appointment Date</label>
            <input type="date" name="appointment_date" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Appointment Time</label>
            <input type="time" name="appointment_time" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Confirm Appointment</button>
    </form>
@endsection
