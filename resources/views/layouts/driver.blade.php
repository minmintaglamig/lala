<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Driver - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) ...
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


</head>

<body class="text-gray-900 bg-white">

    @include('layouts.navigation')

    <div>
        @include('components.sidebar-driver')

        <main class="min-h-screen p-6 ml-64">
            <h1 class="text-2xl font-bold mb-4 text-[#EA2F14]">@yield('title')</h1>
            @yield('content')
        </main>
    </div>

    @stack('scripts')

</body>

</html>