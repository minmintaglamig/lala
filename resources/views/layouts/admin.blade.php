<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900">

    @include('layouts.navigation')

    <div>
        @include('components.sidebar-admin')

        <main class="ml-64 p-6 min-h-screen">
            <h1 class="text-2xl font-bold mb-4 text-[#EA2F14]">@yield('title')</h1>
            @yield('content')
        </main>
    </div>

</body>
</html>