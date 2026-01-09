<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('mahasiswa', MahasiswaController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/db-reset', function () {
    try {
        // Menjalankan perintah migrate:fresh
        Artisan::call('migrate:fresh', ['--force' => true]);

        return '<div style="font-family: sans-serif; text-align: center; padding: 50px;">
                    <h1 style="color: green;">✅ BERHASIL!</h1>
                    <p>Database sudah di-reset total (Tables dropped & Re-migrated).</p>
                    <a href="/register" style="background: #0f172a; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Buka Halaman Register</a>
                </div>';
    } catch (\Exception $e) {
        return '<div style="font-family: sans-serif; text-align: center; padding: 50px;">
                    <h1 style="color: red;">❌ GAGAL</h1>
                    <p>Error: ' . $e->getMessage() . '</p>
                </div>';
    }
});


require __DIR__ . '/auth.php';
