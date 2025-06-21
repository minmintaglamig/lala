<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

    @include('layouts.navigation')

    <div class="flex min-h-screen">
        <aside class="w-64 bg-white shadow-md p-6 space-y-4">
            <h2 class="text-lg font-bold text-orange-600 mb-4">Sections</h2>
            <nav class="flex flex-col space-y-2 text-gray-700">
                <a href="{{ route('drivers.index') }}" class="hover:text-orange-600">Drivers</a>
                <a href="{{ route('vehicles.index') }}" class="hover:text-orange-600">Vehicles</a>
                <a href="{{ route('jobs.index') }}" class="hover:text-orange-600">Jobs</a>
                <a href="{{ route('locations.index') }}" class="hover:text-orange-600">Location</a>
            </nav>
        </aside>

        <div class="flex-1 p-6">
            @hasSection('header')
                <header class="mb-4 border-b pb-2">
                    @yield('header')
                </header>
            @endif

            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>