<x-site-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Manage Appointments</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->user->name }}</td>
                    <td>{{ $appointment->doctor->name }}</td>
                    <td>{{ $appointment->doctor->hospital->name }}</td>
                    <td>{{ $appointment->appointment_date }} {{ $appointment->appointment_time }}</td>
                    <td>{{ $appointment->status }}</td>
                    <td>
                        @if($appointment->status === 'scheduled')
                            <form action="{{ route('admin.appointments.approve', $appointment) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form action="{{ route('admin.appointments.cancel', $appointment) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Cancel</button>
                            </form>
                        @elseif($appointment->status === 'approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif($appointment->status === 'canceled')
                            <span class="badge bg-danger">Canceled</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-site-layout>

