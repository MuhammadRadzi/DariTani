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
| Verifikasi email (belum login, tapi bukan "guest" murni -- user sudah
| terdaftar, hanya menunggu verifikasi kode OTP)
|--------------------------------------------------------------------------
*/
Route::get('/verify', [AuthController::class, 'showVerify'])->name('verify');
Route::post('/verify', [AuthController::class, 'verify'])->name('verify.submit');
Route::post('/verify/resend', [AuthController::class, 'resend'])->name('verify.resend');

/*
|--------------------------------------------------------------------------
| Customer routes (butuh login)
|--------------------------------------------------------------------------
| Prioritas SA: Halaman Login & Halaman User jadi dulu sebelum halaman lain.
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman User -- prioritas kedua sesuai saran SA
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user', [UserController::class, 'update'])->name('user.update');

    // Halaman Produk -- sebenarnya halaman detail 1 kebun beserta produknya
    Route::get('/kebun/{farm}', [ProductController::class, 'show'])->name('kebun.show');

    // Halaman Keranjang
    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [CartController::class, 'store'])->name('keranjang.store');
    Route::patch('/keranjang/{cartItem}', [CartController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{cartItem}', [CartController::class, 'destroy'])->name('keranjang.destroy');

    // Checkout -- validasi "1 kebun per transaksi" ditangani di controller
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

    // Halaman Markah Petani (bookmark) -- untuk kebun (farm), bukan produk
    Route::get('/markah', [BookmarkController::class, 'index'])->name('markah.index');
    Route::post('/markah/{farm}', [BookmarkController::class, 'store'])->name('markah.store');
    Route::delete('/markah/{farm}', [BookmarkController::class, 'destroy'])->name('markah.destroy');
    Route::delete('/markah', [BookmarkController::class, 'destroyAll'])->name('markah.destroyAll');
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
