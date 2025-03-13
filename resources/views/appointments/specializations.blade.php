<x-site-layout>
<form action="{{ route('appointments.chooseDoctor') }}" method="GET">
    <label for="specialization">Choose Specialization:</label>
    <select name="specialization" id="specialization">
        @foreach ($specializations as $specialization)
            <option value="{{ $specialization }}">{{ $specialization }}</option>
        @endforeach
    </select>
    <button type="submit">Next</button>
</form>
</x-site-layout>
