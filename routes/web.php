<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// cek Status Laundry
Route::get('/cek-status',[App\Http\Controllers\landingController::class,'cekstatus']);

Route::middleware('auth')->group(function(){
    Route::resource('/account',App\Http\Controllers\userController::class);
    Route::resource('/outlet',App\Http\Controllers\outletController::class);
    Route::resource('/paket',App\Http\Controllers\paketController::class);
    Route::resource('/membership',App\Http\Controllers\memberController::class);

    Route::get('/profile',[App\Http\Controllers\profileController::class,'index'])->name('profile');
    Route::post('/edit-username/{id}',[App\Http\Controllers\profileController::class,'edit_username']);
    Route::post('/edit-password/{id}',[App\Http\Controllers\profileController::class,'edit_pass']);
    Route::post('/edit-image',[App\Http\Controllers\profileController::class,'edit_image']);

    Route::get('/buat-transaksi',[App\Http\Controllers\transaksiController::class,'transaksiindex'])->name('buat-transaksi');
    Route::get('/transaksi',[App\Http\Controllers\transaksiController::class,'riwayatindex']);
    Route::get('/get-paket',[App\Http\Controllers\transaksiController::class,'get_paket']);

    // transaksi 
    Route::post('/add-transaksi',[App\Http\Controllers\transaksiController::class,'store']);
    Route::get('/transaksi/{kode_invoice}',[App\Http\Controllers\transaksiController::class,'show']);
    Route::get('/pilih-paket',[App\Http\Controllers\transaksiController::class,'selectpaket']);
    Route::post('/add-paket/{id_transaksi}/{id_paket}',[App\Http\Controllers\transaksiController::class,'tambahpaket']);
    Route::post('/hapus-paket-transaksi/{id}',[App\Http\Controllers\transaksiController::class,'hapuspaket']);
    Route::post('/add-diskon/{id}',[App\Http\Controllers\transaksiController::class,'tambahbiaya']);

    // nota laundry
    Route::get('/invoice-transaksi/{kode_invoice}',[App\Http\Controllers\notaController::class,'index']);

    // pembayaran
    Route::post('pembayaran/{id}',[App\Http\Controllers\transaksiController::class,'pembayaran']);

    // status laundry
    Route::post('status/{id}',[App\Http\Controllers\transaksiController::class,'status']);

    // laporan
    Route::get('/laporan',[App\Http\Controllers\laporanController::class,'index'])->name('laporan');
    Route::post('/get-laporan',[App\Http\Controllers\laporanController::class,'getlaporan']);
});
