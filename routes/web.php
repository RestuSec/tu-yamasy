<?php

use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\TagihanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiswaController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route Admin
Route::middleware(['auth', 'admin.role'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('siswa', SiswaController::class);
    Route::resource('tagihan', TagihanController::class);
    Route::resource('pembayaran', PembayaranController::class)->only(['index', 'create', 'store']);
    Route::post('pembayaran/{pembayaran}/verifikasi', [PembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
    Route::post('pembayaran/{pembayaran}/tolak', [PembayaranController::class, 'tolak'])->name('pembayaran.tolak');
    Route::resource('pengeluaran', PengeluaranController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::get('pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});

// Route Ortu
Route::prefix('ortu')->name('ortu.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Ortu\LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\Ortu\LoginController::class, 'login'])
        ->middleware('throttle:10,1')
        ->name('login.post');
    Route::post('/logout', [App\Http\Controllers\Ortu\LoginController::class, 'logout'])->name('logout');

    Route::middleware('ortu.auth')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Ortu\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/pembayaran/{tagihan}/create', [App\Http\Controllers\Ortu\PembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('/pembayaran/{tagihan}/store', [App\Http\Controllers\Ortu\PembayaranController::class, 'store'])->name('pembayaran.store');
        Route::post('/pembayaran/mandiri', [App\Http\Controllers\Ortu\PembayaranController::class, 'mandiri'])->name('pembayaran.mandiri');
    });
});

require __DIR__.'/auth.php';