@extends('layouts.app')

@section('title', 'My Appointments')

@section('content')
    <h2 class="text-2xl font-bold">My Appointments</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mt-2">{{ session('success') }}</div>
    @endif

    <table class="w-full bg-white shadow mt-4">
        <thead>
        <tr>
            <th class="border p-2">Doctor</th>
            <th class="border p-2">Hospital</th>
            <th class="border p-2">Date</th>
            <th class="border p-2">Time</th>
            <th class="border p-2">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($appointments as $appointment)
            <tr>
                <!-- Doctor's Name: Check if user exists -->
                <td class="border p-2">
                    {{ $appointment->doctor->user ? $appointment->doctor->user->name : 'Unknown Doctor' }}
                </td>

                <!-- Hospital's Name: Check if hospital exists -->
                <td class="border p-2">
                    {{ $appointment->doctor->hospital ? $appointment->doctor->hospital->name : 'Unknown Hospital' }}
                </td>

                <!-- appointments Date -->
                <td class="border p-2">{{ $appointment->appointment_date }}</td>

                <!-- appointments Time: Format using Carbon -->
                <td class="border p-2">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>

                <!-- Status: Capitalize first letter -->
                <td class="border p-2">{{ ucfirst($appointment->status) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
