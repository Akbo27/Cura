<x-site-layout>

        <h2 class="text-2xl font-bold">My Appointments</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mt-2">{{ session('success') }}</div>
        @endif

        @if($appointments->isEmpty())
            <p class="text-gray-500">No appointments found.</p>
        @else

            <table class="w-full bg-grey-100 shadow mt-4">
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
                        <td class="border p-2">
                            {{ $appointment->doctor ? $appointment->doctor->name : 'Unknown Doctor' }}
                        </td>
                        <td class="border p-2">
                            {{ $appointment->doctor && $appointment->doctor->hospital ? $appointment->doctor->hospital->name : 'Unknown Hospital' }}
                        </td>
                        <td class="border p-2">
                            {{ $appointment->appointment_date ?? 'Not Set' }}
                        </td>
                        <td class="border p-2">
                            {{ $appointment->appointment_time ?? 'Not Set' }}
                        </td>
                        <td class="border p-2">
                            {{ ucfirst($appointment->status ?? 'pending') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
</x-site-layout>
