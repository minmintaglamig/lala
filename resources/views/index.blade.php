<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Minemang Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 flex items-center justify-center min-h-screen">
    <div class="text-center bg-white p-10 rounded-2xl shadow-lg w-[90%] max-w-md">
        <div class="flex items-center justify-center mb-6">
            <img src="{{ asset('images/minemang-logo.png') }}" alt="Minemang Logo" class="h-16">
        </div>

        <h1 class="text-3xl font-bold text-orange-600 mb-4">Minemang Logistics</h1>

        <div class="flex flex-col gap-4">
            <a href="{{ route('login') }}"
               class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded transition">
                Login
            </a>
            <a href="{{ route('register') }}"
               class="bg-white border border-orange-400 hover:bg-orange-100 text-orange-700 font-semibold py-2 px-4 rounded transition">
                Register
            </a>
        </div>
    </div>
</body>
</html>