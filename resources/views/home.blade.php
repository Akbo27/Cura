<x-site-layout>
    @section('title', 'Welcome')

    <div class="w-full">
        <div class="relative bg-cover bg-center w-full h-screen" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
            <div class="absolute inset-0 bg-black opacity-50"></div>

            <!-- Centered Content -->
            <div class="relative z-10 flex justify-center items-center w-full h-full text-center text-white">
                <div>
                    <h1 class="display-1 text-6xl font-bold">Welcome to your path to wellness!</h1>
                    <p class="mt-4 text-xl">Experience personalized and secure healthcare in Bangkok with CURA!</p>
                    <a href="{{ route('appointments.specializations') }}" class="bg-blue-600 text-white text-uppercase text-decoration-none px-6 py-3 mt-4 inline-block rounded">
                        Book Appointment Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-site-layout>
