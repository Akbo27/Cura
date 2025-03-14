<nav class="bg-blue-600 text-white p-4">
    <div class="container mx-auto flex items-center justify-between">
        <a href="{{ route('home') }}" class="text-white text-2xl text-decoration-none font-bold">Cura</a>

        <div class="flex space-x-8">
            <a href="{{ route('appointments.index') }}" class="text-white text-base font-normal text-decoration-none">My Appointments</a>
            <a href="{{ route('appointments.specializations') }}" class="text-white font-normal text-decoration-none">Specializations</a>

        </div>

        <!-- Login / Logout Button -->
        <div>
            <div class="flex space-x-8">
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-white px-4 py-2 rounded-lg text-decoration-none text-uppercase rounded font-semibold hover:bg-gray-200 border border-white">Admin Dashboard</a>
                    @endif
                @endauth

                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-white text-blue-600 px-4 py-2 rounded-lg text-decoration-none text-uppercase rounded font-semibold hover:bg-gray-200">
                            Log out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg text-decoration-none text-uppercase rounded font-semibold hover:bg-gray-200">
                        Log in
                    </a>
                @endauth
            </div>
        </div>
</nav>
