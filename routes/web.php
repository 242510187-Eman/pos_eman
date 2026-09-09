<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TentangController; // Pastikan ini sudah di-import di atas

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest Routes (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('login.process');
});

// Authenticated Routes (Sudah Login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Khusus Admin (Akses Kelola User)
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Bisa diakses Admin & Kasir
    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('produk', ProdukController::class);
        Route::resource('penjualan', PenjualanController::class);
        Route::resource('itempenjualan', ItemPenjualanController::class);
        
        // PERBAIKAN ADA DI SINI (Ubah dari Tentang::class menjadi TentangController::class)
        Route::resource('tentang', TentangController::class);
    });
});