<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangmasukController;
use App\Http\Controllers\BarangkeluarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    //return phpinfo();
});


Route::get('/stembayo', function () {
    return "welcome to SIJA";
});

Route::get('/', function () {
    return view('welcome');
});


Route::resource('barang', BarangController::class)->middleware('auth');
Route::resource('kategori', KategoriController::class);
Route::resource('barangmasuk', BarangmasukController::class);
Route::resource('barangkeluar', BarangkeluarController::class);

Route::get('login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class,'authenticate']);
Route::post('logout', [LoginController::class,'logout']);
Route::get('logout', [LoginController::class,'logout']);


Route::post('register', [RegisterController::class,'store']);
Route::get('register', [RegisterController::class,'create']);

Route::get('/sija', function () {
    return"Produk Kreatif dan Kewirausahaan";
})->name('pkk');
