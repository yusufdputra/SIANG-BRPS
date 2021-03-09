<?php

use Illuminate\Support\Facades\Route;

if (version_compare(PHP_VERSION, '7.2.0','>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['role:Admin']], function () {
    // User
    Route::get('/User', 'HomeController@setting')->name('user.data');
    Route::match(['get','post'],'/User/edit/{user}', 'HomeController@edit')->name('user.edit');
    Route::post('/User/store', 'UserController@store')->name('user.store');
    Route::get('/User/{user:id}/delete','UserController@destroy')->name('user.delete');

    // BUS
    Route::get('/Bus', 'BusController@index')->name('bus.index');
    Route::post('/Bus/store', 'BusController@store')->name('bus.store');
    Route::get('/Bus/{bus:id}/edit', 'BusController@edit')->name('bus.edit');
    Route::put('/Bus/{bus:id}/update', 'BusController@update')->name('bus.update');
    Route::get('/Bus/{bus:id}/delete','BusController@destroy')->name('bus.delete');

    // PROVINSI
    Route::get('/Provinsi', 'ProvinsiController@index')->name('provinsi.index');
    Route::post('/Provinsi/store', 'ProvinsiController@store')->name('provinsi.store');
    Route::get('/Provinsi/{provinsi:id}/edit', 'ProvinsiController@edit')->name('provinsi.edit');
    Route::put('/Provinsi/{provinsi:id}/update', 'ProvinsiController@update')->name('provinsi.update');
    Route::get('/Provinsi/{provinsi:id}/delete','ProvinsiController@destroy')->name('provinsi.delete');

    // TERMINAL
    Route::get('/Terminal', 'TerminalController@index')->name('terminal.index');
    Route::post('/Terminal/store', 'TerminalController@store')->name('terminal.store');
    Route::get('/Terminal/{terminal:id}/edit', 'TerminalController@edit')->name('terminal.edit');
    Route::put('/Terminal/{terminal:id}/update', 'TerminalController@update')->name('terminal.update');
    Route::get('/Terminal/{provinsi:id}/delete','TerminalController@destroy')->name('terminal.delete');

    // PO
    Route::get('/Po', 'PoController@index')->name('po.index');
    Route::post('/Po/store', 'PoController@store')->name('po.store');
    Route::get('/Po/{po:id}/edit', 'PoController@edit')->name('po.edit');
    Route::put('/Po/{po:id}/update', 'PoController@update')->name('po.update');
    Route::get('/Po/{po:id}/delete','PoController@destroy')->name('po.delete');

    // KEBERANGKATAN
    Route::get('/Keberangkatan', 'KeberangkatanController@index')->name('keberangkatan.index');
    Route::post('/Keberangkatan/store', 'KeberangkatanController@store')->name('keberangkatan.store');
    Route::get('/Keberangkatan/{keberangkatan:id}/edit', 'KeberangkatanController@edit')->name('keberangkatan.edit');
    Route::put('/Keberangkatan/{keberangkatan:id}/update', 'KeberangkatanController@update')->name('keberangkatan.update');
    Route::get('/Keberangkatan/{keberangkatan:id}/delete','KeberangkatanController@destroy')->name('keberangkatan.delete');

    // KEDATANGAN
    Route::get('/Kedatangan', 'KedatanganController@index')->name('kedatangan.index');
    Route::post('/Kedatangan/store', 'KedatanganController@store')->name('kedatangan.store');
    Route::get('/Kedatangan/{kedatangan:id}/edit', 'KedatanganController@edit')->name('kedatangan.edit');
    Route::put('/Kedatangan/{kedatangan:id}/update', 'KedatanganController@update')->name('kedatangan.update');
    Route::get('/Kedatangan/{kedatangan:id}/delete','KedatanganController@destroy')->name('kedatangan.delete');

    // LAPORAN KEBERANGKATAN
    Route::get('/Laporan/Keberangkatan', 'LaporanKeberangkatanController@index')->name('laporan.keberangkatan');
    Route::post('/Laporan/Keberangkatan', 'LaporanKeberangkatanController@cari')->name('keberangkatan.cari');
    
    // LAPORAN KEDATANGAN
    Route::get('/Laporan/Kedatangan', 'LaporanKedatanganController@index')->name('laporan.kedatangan');
    Route::post('/Laporan/Kedatangan', 'LaporanKedatanganController@cari')->name('kedatangan.cari');

});

Route::group(['middleware' => ['role:User']], function () {
    Route::get('/Keberangkatan', 'KeberangkatanController@index')->name('keberangkatan.index');

    // KENDARAAN
    Route::get('/Kendaraan', 'KendaraanController@index')->name('kendaraan.index');
    Route::post('/Kendaraan/store', 'KendaraanController@store')->name('kendaraan.store');
    Route::get('/Kendaraan/{kendaraan:id}/edit', 'KendaraanController@edit')->name('kendaraan.edit');
    Route::put('/Kendaraan/{kendaraan:id}/update', 'KendaraanController@update')->name('kendaraan.update');
    Route::get('/Kendaraan/{kendaraan:id}/delete','KendaraanController@destroy')->name('kendaraan.delete');

    // OPERASIONAL KEBERANGKATAN
    Route::get('/Operasional/Keberangkatan', 'OperasionalKeberangkatanController@index')->name('operasional.keberangkatan');
    Route::post('/Operasional/store', 'OperasionalKeberangkatanController@store')->name('operasional.store'); 
    Route::get('/Operasional/{operasional:id}/edit', 'OperasionalKeberangkatanController@edit')->name('operasional.edit');
    Route::put('/Operasional/{operasional:id}/update', 'OperasionalKeberangkatanController@update')->name('operasional.update');
    Route::get('/Operasional/{operasional:id}/delete','OperasionalKeberangkatanController@destroy')->name('operasional.delete');

    // OPERASIONAL KEDATANGAN
    Route::get('/Operasional/Kedatangan', 'OperasionalKedatanganController@index')->name('operasional.kedatangan');
    Route::post('/Operasional/approve','OperasionalKedatanganController@approve')->name('operasional.approve');
});



Route::group(['middleware' => ['role:Pelaksana|Admin|User']], function () {
    Route::get('/Keberangkatan', 'KeberangkatanController@index')->name('keberangkatan.index');
    Route::post('/Keberangkatan/store', 'KeberangkatanController@store')->name('keberangkatan.store');
    Route::get('/Keberangkatan/{keberangkatan:id}/edit', 'KeberangkatanController@edit')->name('keberangkatan.edit');
    Route::put('/Keberangkatan/{keberangkatan:id}/update', 'KeberangkatanController@update')->name('keberangkatan.update');
    Route::get('/Keberangkatan/{keberangkatan:id}/delete','KeberangkatanController@destroy')->name('keberangkatan.delete');

    // c
    Route::get('/Kedatangan', 'KedatanganController@index')->name('kedatangan.index');
    Route::post('/Kedatangan/store', 'KedatanganController@store')->name('kedatangan.store');
    Route::get('/Kedatangan/{kedatangan:id}/edit', 'KedatanganController@edit')->name('kedatangan.edit');
    Route::put('/Kedatangan/{kedatangan:id}/update', 'KedatanganController@update')->name('kedatangan.update');
    Route::get('/Kedatangan/{kedatangan:id}/delete','KedatanganController@destroy')->name('kedatangan.delete');
});

Route::group(['middleware' => ['role:Pelaksana']], function () {
 
    // OPERASIONAL KEDATANGAN
    Route::get('/Operasional/Kedatangan', 'OperasionalKedatanganController@index')->name('operasional.kedatangan');
    Route::post('/Operasional/approve','OperasionalKedatanganController@approve')->name('operasional.approve');
});