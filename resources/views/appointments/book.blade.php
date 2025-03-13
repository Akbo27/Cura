<x-site-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Book Appointment for {{ $specialization }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <!-- Select Doctor -->
            <div class="mb-4">
                <label for="doctor">Choose a Doctor:</label>
                <select name="doctor" id="doctor" required>
                    <option value="">Select a Doctor</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Appointment Date -->
            <div class="mb-4">
                <label for="appointment_date" class="form-label">Choose Appointment Date:</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
            </div>

            <!-- Appointment Time -->
            <div class="mb-4">
                <label for="appointment_time" class="form-label">Choose Appointment Time:</label>
                <select name="appointment_time" id="appointment_time" class="form-select" required>
                    <option value="09:00">09:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="13:00">01:00 PM</option>
                    <option value="15:00">03:00 PM</option>
                    <option value="18:00">06:00 PM</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Book Appointment</button>
            </div>
        </form>
    </div>
</x-site-layout>
