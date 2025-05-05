<?php

use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KategoriController;
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
    Route::get('/user/index', [HomeController::class, 'index'])->name('user.index');

    // Halaman Admin
    Route::get('/admin/home', [ProdukController::class, 'index'])->name('admin.index')->middleware('auth');;

    // Produk Routes
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');  // Perbaiki nama rute
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/hapus/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // Cart (Keranjang) Routes
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart.index');
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

// Rute Kategori (tanpa auth middleware)
Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.produk.kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('admin.produk.kategori.create');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('admin.produk.kategori.store');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('admin.produk.kategori.edit');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('admin.produk.kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('admin.produk.kategori.destroy');



});