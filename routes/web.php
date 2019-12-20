<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/main', function() {
    return view('simpeg.mains');
});

Route::get('/pendidikan/cari', 'pendidikanController@cari')->name('pendidikan.cari');
Route::resource('pendidikan', 'pendidikanController')->middleware('auth');

Route::get('/gaji/cari', 'gajiController@cari')->name('gaji.cari');
Route::resource('gaji', 'gajiController')->middleware('auth');

Route::resource('user', 'userController');

Route::get('/pegawai/cari', 'pegawaiController@cari')->name('pegawai.cari');
Route::resource('pegawai', 'pegawaiController')->middleware('auth');

Route::get('/jabatan/cari', 'jabatanController@cari')->name('jabatan.cari');
Route::resource('jabatan', 'jabatanController')->middleware('auth');

Route::get('/bagian/cari', 'bagianController@cari')->name('bagian.cari');
Route::resource('bagian', 'bagianController')->middleware('auth');

Route::get('import-export', 'pegawaiController@importExport')->name('pegawai.import-export');
Route::post('import', 'pegawaiController@import')->name('pegawai.import');
Route::get('export', 'pegawaiController@export')->name('pegawai.export');
Route::get('pdf', 'pegawaiController@pdf')->name('pegawai.pdf');

Route::get('/about', function () {
    return view('simpeg.partials.about');
});
