<x-site-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Hospitals for {{ $specialization }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($hospitals as $hospital)
                <div class="border p-4 shadow rounded-lg">
                    <h2 class="text-lg font-bold">{{ $hospital->name }}</h2>
                    <p class="text-gray-700">{{ $hospital->location }}</p>
                    <!-- Make sure you pass both hospital_id and specialization here -->
                    <a href="{{ route('appointments.book', ['hospital_id' => $hospital->id, 'specialization' => $specialization]) }}" class="mt-2 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                        Choose This Hospital
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-site-layout>









