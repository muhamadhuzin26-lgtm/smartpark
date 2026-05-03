<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkir Masuk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center 
             bg-gradient-to-br from-gray-900 via-gray-800 to-blue-900 text-white">

    <!-- CARD -->
    <div class="w-full max-w-xl p-8 rounded-3xl 
                bg-gray-800/80 backdrop-blur-lg 
                border border-white/10 
                shadow-2xl shadow-blue-500/10">
    <!-- BACK BUTTON -->
<div class="mb-4">
    <a href="{{ route('dashboard') }}"
       class="inline-flex items-center gap-2 text-gray-400 hover:text-white 
              transition text-sm">

        ← Kembali
    </a>
</div>

        <!-- HEADER -->
        <div class="text-center mb-6">
            <div class="text-5xl mb-2">🚗</div>
            <h1 class="text-3xl font-bold">Parkir Masuk</h1>
            <p class="text-gray-400 text-sm mt-1">
                Pilih jenis kendaraan untuk masuk parkir
            </p>
        </div>

        <!-- LINE -->
        <div class="w-full h-[1px] bg-gradient-to-r from-transparent via-blue-500 to-transparent mb-6"></div>

        <!-- FORM -->
        <form method="POST" action="{{ route('parkir.masuk') }}" class="space-y-6">
            @csrf

            <!-- SELECT -->
            <div>
                <label class="text-sm text-gray-300">Jenis Kendaraan</label>

                <select name="jenis_kendaraan"
                        class="mt-2 w-full bg-gray-900 border border-gray-600 
                               rounded-xl px-4 py-3 
                               focus:ring-2 focus:ring-blue-500 outline-none
                               transition">

                    <option value="motor">Motor</option>
                    <option value="mobil">Mobil</option>
                </select>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full py-3 rounded-xl 
                       bg-gradient-to-r from-blue-500 to-blue-600
                       hover:scale-105 hover:shadow-lg hover:shadow-blue-500/30
                       transition duration-300 font-semibold text-lg">

                🚀 Generate Tiket Parkir
            </button>

        </form>

        <!-- DIVIDER -->
        <div class="flex items-center my-6">
            <div class="flex-1 border-t border-gray-600"></div>
            <span class="mx-3 text-xs text-gray-400"></span>
            <div class="flex-1 border-t border-gray-600"></div>
        </div>

        </div>

    </div>

</body>
</html>