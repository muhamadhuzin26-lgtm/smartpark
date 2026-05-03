<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TarifController;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Form masuk parkir
Route::get('/masuk', function () {
    return view('parkir.masuk');
})->name('masuk.form');

// Scan QR
Route::get('/scan', function () {
    return view('parkir.scan');
})->name('parkir.scan');

// Proses parkir
Route::post('/masuk', [ParkirController::class, 'masuk'])->name('parkir.masuk');
Route::post('/parkir/keluar', [ParkirController::class, 'keluar'])->name('parkir.keluar');

// Tiket & struk
Route::get('/tiket/{id}', [ParkirController::class, 'tiket'])->name('tiket');
Route::get('/struk/{id}', [ParkirController::class, 'struk'])->name('struk');
Route::get('/struk/{id}/download', [ParkirController::class, 'downloadStruk'])
    ->name('struk.download');


/*
|--------------------------------------------------------------------------
| API DASHBOARD REALTIME
|--------------------------------------------------------------------------
*/

Route::get('/api/dashboard', function () {

    return response()->json([
        'totalKendaraan' => \App\Models\Parkir::where('status','masuk')->count(),
        'totalPendapatan' => \App\Models\Parkir::where('status','keluar')->sum('biaya'),

        'motor' => \App\Models\Parkir::whereHas('kendaraan', function($q){
            $q->where('jenis_kendaraan','motor');
        })->count(),

        'mobil' => \App\Models\Parkir::whereHas('kendaraan', function($q){
            $q->where('jenis_kendaraan','mobil');
        })->count(),
    ]);

})->name('api.dashboard');


/*
|--------------------------------------------------------------------------
| TEST DATA
|--------------------------------------------------------------------------
*/

Route::get('/test-masuk', function () {

    return \App\Models\Parkir::create([
        'kendaraan_id' => 1,
        'waktu_masuk' => now(),
        'qr_code' => uniqid(),
        'status' => 'masuk'
    ]);

});


/*
|--------------------------------------------------------------------------
| LOGIN GOOGLE
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', function () {

    return Socialite::driver('google')->redirect();

})->name('google.login');


Route::get('/auth/google/callback', function () {

    try {

        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->email],
            [
                'name' => $googleUser->name,
                'password' => bcrypt('google_login')
            ]
        );

        Auth::login($user, true);

        return redirect()->route('dashboard');

    } catch (\Exception $e) {

        return redirect('/login')->with('error','Login Google gagal');

    }

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('user', UserController::class);
    Route::resource('tarif', TarifController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';