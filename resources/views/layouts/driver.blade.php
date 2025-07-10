<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Driver - @yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-gray-900 bg-white">

    @include('layouts.navigation')

    <div>
        @include('components.sidebar-driver')

        <main class="min-h-screen pt-2 px-6 pb-6 ml-64">
            <h1 class="text-2xl font-bold mb-4 text-[#EA2F14]">@yield('title')</h1>
            @yield('content')
        </main>
    </div>

</body>

</html>
