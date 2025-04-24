<?php

use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\UserAccess;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Route untuk otentikasi
Auth::routes();  // Menyediakan semua rute otentikasi default (login, register, logout, dll.)

// Route yang membutuhkan autentikasi (hanya bisa diakses oleh user yang sudah login)
Route::middleware(['auth'])->group(function () {
    // Halaman utama setelah login
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Halaman Admin
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('auth');;

    // Produk Routes
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');  // Perbaiki nama rute
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // Cart (Keranjang) Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/tambah/{produk_id}', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart/bayar/{id}', [CartController::class, 'bayar'])->name('cart.bayar');
    Route::delete('/cart/hapus/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/cart/history',        [CartController::class,'history'])->name('cart.history');
    // Rute untuk cetak cart, memungkinkan cetak untuk semua item cart
    Route::get('/cart/cetak', [CartController::class, 'cetak'])->name('cart.cetak');

    // Rute untuk cetak transaksi berdasarkan ID
    Route::get('/cart/cetak/{id}', [CartController::class, 'cetakTransaksi'])->name('cart.cetak');

    // Transaksi Admin
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
Route::get('/transaksi/approve/{id}', [TransaksiController::class, 'approve'])->name('transaksi.approve');
Route::post('/konfirmasi-pesanan', [TransaksiController::class, 'konfirmasiPesanan'])->name('konfirmasi.pesanan');


});
