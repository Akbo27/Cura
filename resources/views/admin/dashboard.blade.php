<x-site-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Admin Dashboard</h1>

        <!-- Success Message (If there's any session message passed) -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table for Managing Appointments -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Hospital</th>
                <th>Date & Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <!-- Check if appointments are empty -->
            @if($appointments->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">No appointments found.</td>
                </tr>
            @else
                <!-- Loop through appointments and display data -->
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient_name }}</td>
                        <td>{{ $appointment->doctor_name }}</td>
                        <td>{{ $appointment->hospital_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y h:i A') }}</td>
                        <td>
                                <span class="badge bg-{{ $appointment->status == 'Scheduled' ? 'warning' : ($appointment->status == 'Approved' ? 'success' : 'danger') }}">
                                    {{ $appointment->status }}
                                </span>
                        </td>
                        <td>
                            @if($appointment->status == 'Scheduled')
                                <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>

                                <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </form>
                            @else
                                <span class="badge bg-{{ $appointment->status == 'Approved' ? 'success' : 'danger' }}">{{ $appointment->status }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</x-site-layout>
