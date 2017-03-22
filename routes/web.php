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

// Auth routes sudah termasuk : login, register(diasbled), reset password 
Auth::routes();

// Dasbor
Route::get('/', 'DashboardController@index')->name('dashboard');

// Routing admin
Route::resource('admin', 'AdminController');
Route::delete('admin', 'AdminController@bulkDestroy')->name('admin.bulkDestroy');

// Routing kelas
Route::resource('kelas', 'ClassroomController');
Route::delete('kelas', 'ClassroomController@bulkDestroy')->name('kelas.bulkDestroy');

// Routing pengumuman
Route::resource('pengumuman', 'AnnouncementController');

// Routing diskusi
Route::get('diskusi', 'DiscussionController@index')->name('diskusi.index'); // List semua diskusi, hanya untuk guru
Route::get('diskusi/{siswa}/siswa', 'DiscussionController@withstudent')->name('diskusi.student'); // List semua diskusi dengan salah satu siswa
Route::get('diskusi/tambah', 'DiscussionController@create')->name('diskusi.create'); // Halaman untuk menambah diskusi baru
Route::post('diskusi', 'DiscussionController@store')->name('diskusi.store'); // Fungsi untuk simpan diskusi baru
Route::post('diskusi/{diskusi}', 'DiscussionController@chat')->name('diskusi.chat'); // Fungsi untuk simpan balasan diskusi
Route::get('diskusi/{diskusi}', 'DiscussionController@discussion')->name('diskusi.show'); // Tampilkan detail 1 diskusi
Route::delete('diskusi/{diskusi}', 'DiscussionController@destroy')->name('diskusi.destroy'); // Hampus diskusi

// Routing edit profil sekolah
Route::get('profil-sekolah', 'SchoolController@index')->name('sekolah.index');
Route::put('profil-sekolah', 'SchoolController@update')->name('sekolah.update');