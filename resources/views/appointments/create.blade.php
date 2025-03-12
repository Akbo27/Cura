<x-site-layout>
    @section('title', 'Book Appointments')

    @section('content')
        <h2 class="text-2xl font-bold">Book an Appointment</h2>

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
                <label class="block text-gray-700">Select Specialization</label>
                <select id="specialization" class="w-full border p-2 rounded">
                    <option value="">-- Choose Specialization --</option>
                    @foreach($specializations as $specialization)
                        <option value="{{ $specialization }}">{{ $specialization }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Select Doctor</label>
                <select name="doctor_id" id="doctor_id" class="w-full border p-2 rounded" required>
                    <option value="">-- Select a Doctor --</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Appointment Date</label>
                <input type="date" name="appointment_date" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Appointment Time</label>
                <select name="appointment_time" class="w-full border p-2 rounded" required>
                    <option value="09:00">09:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="13:00">01:00 PM</option>
                    <option value="15:00">03:00 PM</option>
                    <option value="18:00">06:00 PM</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Confirm Appointment</button>
        </form>

        <script>
            document.getElementById('specialization').addEventListener('change', function () {
                let specialization = this.value;
                let doctorDropdown = document.getElementById('doctor_id');

                doctorDropdown.innerHTML = '<option>Loading...</option>';

                fetch(`/get-doctors?specialization=${specialization}`)
                    .then(response => response.json())
                    .then(doctors => {
                        doctorDropdown.innerHTML = '<option value="">-- Select a Doctor --</option>';
                        doctors.forEach(doctor => {
                            doctorDropdown.innerHTML += `<option value="${doctor.id}">${doctor.user.name} (${doctor.specialization})</option>`;
                        });
                    });
            });
        </script>

    @endsection
</x-site-layout>
