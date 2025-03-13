<nav class="bg-blue-500 text-white p-4">
    <div class="container mx-auto flex justify-between">
        <a href="{{ route('home') }}" class="text-lg font-bold">Cura</a>
        <div>
            <a href="{{ route('appointments.index') }}" class="mr-4">My Appointments</a>
            <a href="{{ route('appointments.specializations') }}" class="mr-4">Specializations</a>

            @auth
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-white">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-4">Login</a>
            @endauth
        </div>
    </div>
</nav>
