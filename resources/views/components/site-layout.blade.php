<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital Booking System')</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100">
<!-- Page container with flex column layout to push footer to the bottom -->
<div class="min-h-screen flex flex-col">
    <!-- Header -->
    <x-site-layout-header />

    <!-- Main content area with padding and space for the content -->
    <div class="flex-1 px-4 sm:px-8 py-8">
        <div class="container mx-auto">
            {{ $slot }} <!-- This is where content injected by the pages will go -->
        </div>
    </div>

    <!-- Footer -->
    <x-site-layout-footer />
</div>
</body>
</html>
