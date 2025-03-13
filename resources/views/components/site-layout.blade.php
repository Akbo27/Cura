<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital Booking System')</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100">
<div class="min-h-screen flex flex-col">
    <x-site-layout-header />

    <div class="flex-1 px-4 sm:px-8 py-8">
        <div class="container mx-auto">
            {{ $slot }}
        </div>
    </div>

    <x-site-layout-footer />
</div>
</body>
</html>
