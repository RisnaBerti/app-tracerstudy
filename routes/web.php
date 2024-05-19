<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OpsiController;
use App\Http\Controllers\Bkk\BkkController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\Bkk\AlumniController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Bkk\JurusanController;
use App\Http\Controllers\Bkk\KategoriController;
use App\Http\Controllers\Bkk\TahunLulusController;
use App\Http\Controllers\Humas\HumasController;

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

Route::get('/maintenance', function () {return view('maintenance'); })->name('maintenance');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/action-login', [AuthController::class, 'actionLogin'])->name('action-login');





//Route Pegawai
Route::controller(PegawaiController::class)->group(function () {
    Route::get('/pegawai', 'index')->name('pegawai');
    Route::get('/pegawai-create', 'create')->name('pegawai-create');
    Route::post('/pegawai-store', 'store')->name('pegawai-store');
    Route::get('/pegawai-edit/{id}', 'edit')->name('pegawai-edit');
    Route::post('/pegawai-update', 'update')->name('pegawai-update');
    Route::get('/pegawai-delete/{id}', 'destroy')->name('pegawai-delete');
});


//Route Kuesioner
Route::controller(KuesionerController::class)->group(function () {
    Route::get('/kuesioner', 'index')->name('kuesioner');
    Route::get('/kuesioner-create', 'create')->name('kuesioner-create');
    Route::post('/kuesioner-store', 'store')->name('kuesioner-store');

    Route::get('/kuesioner-show/{id}', 'show')->name('kuesioner-show');

    Route::get('/kuesioner-edit/{id}', 'edit')->name('kuesioner-edit');
    Route::post('/kuesioner-update', 'update')->name('kuesioner-update');
    Route::get('/kuesioner-delete/{id}', 'destroy')->name('kuesioner-delete');
});

//Route Pertanyaan
Route::controller(PertanyaanController::class)->group(function () {
    Route::get('/pertanyaan', 'index')->name('pertanyaan');
    Route::get('/pertanyaan-create', 'create')->name('pertanyaan-create');
    Route::post('/pertanyaan-store', 'store')->name('pertanyaan-store');
    Route::get('/pertanyaan-edit/{id}', 'edit')->name('pertanyaan-edit');
    Route::post('/pertanyaan-update', 'update')->name('pertanyaan-update');
    Route::get('/pertanyaan-delete/{id}', 'destroy')->name('pertanyaan-delete');
});

//Route Jawaban
Route::controller(JawabanController::class)->group(function () {
    Route::get('/jawaban', 'index')->name('jawaban');
    Route::get('/jawaban-create', 'create')->name('jawaban-create');
    Route::post('/jawaban-store', 'store')->name('jawaban-store');
    Route::get('/jawaban-edit/{id}', 'edit')->name('jawaban-edit');
    Route::post('/jawaban-update', 'update')->name('jawaban-update');
    Route::get('/jawaban-delete/{id}', 'destroy')->name('jawaban-delete');
});

//Route Opsi
Route::controller(OpsiController::class)->group(function () {
    Route::get('/opsi', 'index')->name('opsi');
    Route::get('/opsi-create', 'create')->name('opsi-create');
    Route::post('/opsi-store', 'store')->name('opsi-store');
    Route::get('/opsi-edit/{id}', 'edit')->name('opsi-edit');
    Route::post('/opsi-update', 'update')->name('opsi-update');
    Route::get('/opsi-delete/{id}', 'destroy')->name('opsi-delete');
});

//Route Admin
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin');
});

// =====================================================
// ROUTE UNTUK BKK
// =====================================================

// Route Dashboard
Route::controller(BkkController::class)->group(function () {
    Route::get('/bkk', 'index')->name('bkk');
});

//Route Jurusan
Route::controller(JurusanController::class)->group(function () {
    Route::get('/jurusan', 'index')->name('jurusan');
    Route::get('/jurusan-create', 'create')->name('jurusan-create');
    Route::post('/jurusan-store', 'store')->name('jurusan-store');
    Route::get('/jurusan-edit/{id}', 'edit')->name('jurusan-edit');
    Route::post('/jurusan-update', 'update')->name('jurusan-update');
    Route::get('/jurusan-delete/{id}', 'destroy')->name('jurusan-delete');
});

//Route Kategori
Route::controller(KategoriController::class)->group(function () {
    Route::get('/kategori', 'index')->name('kategori');
    Route::get('/kategori-create', 'create')->name('kategori-create');
    Route::post('/kategori-store', 'store')->name('kategori-store');
    Route::get('/kategori-edit/{id}', 'edit')->name('kategori-edit');
    Route::post('/kategori-update', 'update')->name('kategori-update');
    Route::get('/kategori-delete/{id}', 'destroy')->name('kategori-delete');
});

//Route Tahun Lulus
Route::controller(TahunLulusController::class)->group(function () {
    Route::get('/tahun-lulus', 'index')->name('tahun-lulus');
    Route::get('/tahun-lulus-create', 'create')->name('tahun-lulus-create');
    Route::post('/tahun-lulus-store', 'store')->name('tahun-lulus-store');
    Route::get('/tahun-lulus-edit/{id}', 'edit')->name('tahun-lulus-edit');
    Route::post('/tahun-lulus-update', 'update')->name('tahun-lulus-update');
    Route::get('/tahun-lulus-delete/{id}', 'destroy')->name('tahun-lulus-delete');
});

//Route Alumni
Route::controller(AlumniController::class)->group(function () {
    Route::get('/alumni', 'index')->name('alumni');
    Route::get('/alumni-create', 'create')->name('alumni-create');
    Route::post('/alumni-store', 'store')->name('alumni-store');
    Route::get('/alumni-edit/{id}', 'edit')->name('alumni-edit');
    Route::post('/alumni-update', 'update')->name('alumni-update');
    Route::get('/alumni-delete/{id}', 'destroy')->name('alumni-delete');
});


// =====================================================
// ROUTE UNTUK WAKA HUMAS
// =====================================================

// Route Dashboard
Route::controller(HumasController::class)->group(function () {
    Route::get('/humas', 'index')->name('humas');
    Route::get('/jurusan-humas', 'jurusan')->name('jurusan-humas');
    Route::get('/alumni-humas', 'alumni')->name('alumni-humas');
});



