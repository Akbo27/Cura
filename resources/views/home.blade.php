<x-site-layout>
    @section('title', 'Welcome')

    <div class="text-center">
        <h1 class="text-8xl font-bold">Welcome to your path to wellness!</h1>
        <p class="mt-4">Experience personalized and secure healthcare in Bangkok with CURA</p>
        <a href="{{ route('appointments.specializations') }}" class="bg-blue-500 text-white px-6 py-3 mt-4 inline-block rounded">
            Book Appointment Now
        </a>
    </div>
</x-site-layout>
