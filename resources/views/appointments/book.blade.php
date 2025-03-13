<x-site-layout>
    <form action="{{ route('appointments.store') }}" method="POST">
    @csrf
    <label for="doctor">Choose Doctor:</label>
    <select name="doctor_id" id="doctor">
        @foreach ($doctors as $doctor)
            <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
        @endforeach
    </select>

    <label for="appointment_date">Date:</label>
    <input type="date" name="appointment_date" id="appointment_date" required>

    <label for="appointment_time">Time:</label>
    <select name="appointment_time" id="appointment_time" required>
        <option value="09:00">09:00 AM</option>
        <option value="10:00">10:00 AM</option>
        <option value="13:00">01:00 PM</option>
        <option value="15:00">03:00 PM</option>
        <option value="18:00">06:00 PM</option>
    </select>

    <button type="submit">Book Appointment</button>
</form>
</x-site-layout>
