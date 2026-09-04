<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\TentangController;

// Redirect halaman utama ke login
Route::redirect('/', '/login');

// Route untuk Pengunjung (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
});

// Route untuk Pengguna yang Sudah Login (Auth)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route Halaman Tentang
    Route::get('/tentang', [TentangController::class, 'index'])->name('tentang.index');

    // Route untuk Admin dan Kasir
    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('produk', ProdukController::class);
        Route::resource('jenis', JenisController::class);
        Route::resource('penjualan', PenjualanController::class);
        Route::resource('itempenjualan', ItemPenjualanController::class);
    });
});