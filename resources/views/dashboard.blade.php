<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartPark Dashboard</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-900 text-white">

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR ================= -->
    <aside class="w-64 bg-gradient-to-b from-gray-900 to-gray-800 p-5 flex flex-col justify-between">

        <!-- LOGO -->
        <div>
            <h1 class="text-xl font-bold mb-8 flex items-center gap-2
                hover:scale-105 transition duration-300">
                🚗 SmartPark
            </h1>

            <!-- MENU -->
            <nav class="space-y-2">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg bg-blue-600
                   hover:scale-105 transition duration-300">
                    📊 Dashboard
                </a>

                <a href="{{ route('masuk.form') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-green-600 transition
                   hover:scale-105 transition duration-300">
                    ➕ Kendaraan Masuk
                </a>

                <a href="{{ route('parkir.scan') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-yellow-500 transition
                   hover:scale-105 transition duration-300">
                    📷 Scan QR
                </a>

            </nav>
        </div>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 py-2 rounded-lg
                    hover:scale-105 transition duration-300">
                🚪 Logout
            </button>
        </form>

    </aside>


    <!-- ================= CONTENT ================= -->
    <main class="flex-1 p-8">

        <!-- TITLE -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">🚗 SmartPark Dashboard</h1>
            <p class="text-gray-400">Monitoring Parkir Real-time</p>
        </div>


        <!-- ================= CARD ================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-2xl shadow-lg
                hover:scale-105 transition duration-300">
                <p class="text-sm">Total Kendaraan</p>
                <h2 class="text-3xl font-bold mt-2">10</h2>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 rounded-2xl shadow-lg
                hover:scale-105 transition duration-300">
                <p class="text-sm">Pendapatan</p>
                <h2 class="text-3xl font-bold mt-2">0</h2>
            </div>

            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-6 rounded-2xl shadow-lg
                 hover:scale-105 transition duration-300">
                <p class="text-sm">Motor</p>
                <h2 class="text-3xl font-bold mt-2">7</h2>
            </div>

            <div class="bg-gradient-to-r from-red-500 to-red-600 p-6 rounded-2xl shadow-lg
                 hover:scale-105 transition duration-300">
                <p class="text-sm">Mobil</p>
                <h2 class="text-3xl font-bold mt-2">3</h2>
            </div>

        </div>


        <!-- ================= CHART ================= -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Statistik -->
            <div class="bg-gray-800 p-6 rounded-2xl shadow-lg">
                <h2 class="mb-4">📊 Statistik Kendaraan</h2>
                <canvas id="chartKendaraan"></canvas>
            </div>

            <!-- Pendapatan -->
            <div class="bg-gray-800 p-6 rounded-2xl shadow-lg">
                <h2 class="mb-4">💰 Pendapatan Bulanan</h2>
                <canvas id="chartPendapatan"></canvas>
            </div>

        </div>

    </main>

</div>


<!-- ================= CHART JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    new Chart(document.getElementById('chartKendaraan'), {
        type: 'bar',
        data: {
            labels: ['Motor', 'Mobil'],
            datasets: [{
                label: 'Jumlah Kendaraan',
                data: [7, 3],
                backgroundColor: '#3b82f6'
            }]
        }
    });

    new Chart(document.getElementById('chartPendapatan'), {
        type: 'line',
        data: {
            labels: [1,5,10,15,20,25,30],
            datasets: [{
                label: 'Pendapatan',
                data: [0,20,50,30,80,120,60],
                borderColor: '#22c55e',
                fill: false
            }]
        }
    });
</script>

</body>
</html>