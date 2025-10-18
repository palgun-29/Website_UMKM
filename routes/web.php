<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController; // <-- 1. TAMBAHKAN INI
use App\Http\Controllers\Admin\ProductController as AdminProductController;

// Rute Halaman Publik
Route::get('/', [AppController::class, 'home'])->name('home');
Route::get('/produk', [AppController::class, 'produk'])->name('produk');
Route::get('/tentang-kami', [PageController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');

// Rute Keranjang Belanja (Cart)
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/tambah', [CartController::class, 'add'])->name('cart.add');
Route::post('/keranjang/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/keranjang/hapus', [CartController::class, 'remove'])->name('cart.remove');

// Rute yang memerlukan login (untuk SEMUA user yang sudah login)
Route::middleware('auth')->group(function () {
    // Rute Pesanan
    Route::get('/pesanan', [AppController::class, 'pesanan'])->name('orders');

    // Rute Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 👇 -- 2. TAMBAHKAN RUTE CHECKOUT DI SINI -- 👇
    Route::get('/checkout', [OrderController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
});

// Route khusus admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
});

// Route khusus user/pelanggan
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
});

require __DIR__ . '/auth.php';