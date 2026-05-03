<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SmartPark</title>

   @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative bg-gray-100">

    <!-- BACKGROUND -->
    <div class="absolute inset-0 bg-[url('/public/images/bg-city.png')] bg-cover bg-center opacity-40"></div>

    <!-- CONTENT -->
    <div class="relative min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md text-center">

            <!-- LOGO -->
            <div class="mb-6">
                <img src="{{ asset('images/logo.png') }}" class="w-44 mx-auto">
            </div>

            <!-- TITLE -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">
                    Selamat datang kembali!
                </h2>
                <p class="text-gray-500 text-sm">
                    Masuk untuk melanjutkan ke akun Anda
                </p>
            </div>

            <!-- CARD -->
            <div class="bg-white rounded-2xl shadow-xl shadow-gray-300/40 p-6">
                {{ $slot }}
            </div>

        </div>

    </div>

</body>
</html>