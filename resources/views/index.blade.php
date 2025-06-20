<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center bg-white p-10 rounded-2xl shadow-lg w-[90%] max-w-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Minemang Logistics</h1>
        
        <div class="flex flex-col gap-4">
            <a href="{{ route('login') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                Login
            </a>
            <a href="{{ route('register') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded transition">
                Register
            </a>
        </div>
    </div>
</body>
</html>