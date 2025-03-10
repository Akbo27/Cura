<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital Booking System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<nav class="bg-blue-500 text-white p-4">
    <div class="container mx-auto flex justify-between">
        <a href="{{ route('home') }}" class="text-lg font-bold">Hospital Booking</a>
        <div>
            @auth
                <a href="{{ route('appointments.index') }}" class="mr-4">My Appointments</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-white">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </div>
</nav>
<div class="container mx-auto mt-8">
    @yield('content')
</div>
</body>
</html>
