<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
Route::get('buku', 'BukuController@apiBuku')->name('api.buku');

Route::get('laporan', 'LaporanController@apiLaporan')->name('api.laporan');
Route::get('kategoriBuku', 'KategoriBukuController@apiKategori')->name('api.kategori.buku');

Route::get('pinjam', 'PeminjamanController@apiPinjam')->name('api.pinjam');
Route::get('pinjamSelect', 'PeminjamanController@apiBukuSelect')->name('api.select.pinjam');
Route::get('registerAdmin', 'RegisterAdminController@apiRegister')->name('api.register');
Route::get('ulasan', 'UlasanController@apiUlasan')->name('api.ulasan');
Route::get('dataDashboard', 'DashboardController@apiDashboard')->name('api.dashboard');
Route::get('dataKoleksi', 'KoleksiController@apiKoleksi')->name('api.koleksi');



});
    
    
    

