<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @include('layouts.navigation')
<div class="flex min-h-screen bg-white text-whites-800">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#FB9E3A] text-white p-6 shadow-lg">
        <h2 class="text-xl font-bold mb-6">Dashboard</h2>
        <ul class="space-y-4">
            <li><a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'font-bold underline' : '' }}">Dashboard</a></li>
            <li><a href="/users" class="{{ request()->is('users*') ? 'font-bold underline' : '' }}">Users</a></li>
        </ul>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-10 bg-white">
        {{ $slot }}
    </main>
</div>

    </body>
</html>
