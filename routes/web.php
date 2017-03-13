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

// Routing topik
Route::resource('topik', 'TopicController');

// Routing edit profil sekolah
Route::get('profil-sekolah', 'SchoolController@index')->name('sekolah.index');
Route::put('profil-sekolah', 'SchoolController@update')->name('sekolah.update');