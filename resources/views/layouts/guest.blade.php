<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-white text-gray-800 font-sans min-h-screen flex flex-col justify-center items-center">
    <div class="w-full max-w-md p-8 border border-orange-200 rounded-lg shadow-lg bg-white">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[#EA2F14]">Logistics App</h1>
            <p class="text-sm text-gray-500">Secure & Fast Delivery</p>
        </div>

        {{ $slot }}
    </div>
</body>
</html>