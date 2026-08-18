<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BookmarkController;

/*
|--------------------------------------------------------------------------
| Public routes (belum login)
|--------------------------------------------------------------------------
| Halaman login ini KHUSUS untuk customer, sesuai catatan desain Figma
| dan konfirmasi SA. Petani punya jalur akses terpisah (lewat menu
| hamburger di navbar) yang belum final desainnya -- menyusul.
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

/*
|--------------------------------------------------------------------------
| Customer routes (butuh login)
|--------------------------------------------------------------------------
| Prioritas SA: Halaman Login & Halaman User jadi dulu sebelum halaman lain.
|
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user', [UserController::class, 'update'])->name('user.update');

    // Halaman Produk
    Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
    Route::get('/produk/{product}', [ProductController::class, 'show'])->name('produk.show');

    // Halaman Keranjang
    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [CartController::class, 'store'])->name('keranjang.store');
    Route::patch('/keranjang/{cartItem}', [CartController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{cartItem}', [CartController::class, 'destroy'])->name('keranjang.destroy');

    // Checkout -- validasi "1 kebun per transaksi" ditangani di controller
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

    // Halaman Markah Petani (bookmark)
    Route::get('/markah', [BookmarkController::class, 'index'])->name('markah.index');
    Route::post('/markah/{product}', [BookmarkController::class, 'store'])->name('markah.store');
    Route::delete('/markah/{product}', [BookmarkController::class, 'destroy'])->name('markah.destroy');
});

/*
|--------------------------------------------------------------------------
| Farmer routes (menyusul -- placeholder)
|--------------------------------------------------------------------------
| Prefix /petani belum final. Diaktifkan setelah alur akses petani
| dari menu hamburger sudah disepakati desainnya.
*/
// Route::prefix('petani')->name('petani.')->middleware(['auth', 'role:farmer'])->group(function () {
//     Route::get('/dashboard', [FarmerDashboardController::class, 'index'])->name('dashboard');
//     Route::resource('kebun', FarmController::class);
//     Route::resource('produk', FarmerProductController::class);
// });