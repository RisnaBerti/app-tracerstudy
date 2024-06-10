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
use App\Http\Controllers\Alumni\AlumniController as AlumniAlumniController;
use App\Http\Controllers\Bkk\JurusanController;
use App\Http\Controllers\Bkk\KategoriController;
use App\Http\Controllers\Bkk\TahunLulusController;
use App\Http\Controllers\Disnaker\DisnakerController;
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

Route::get('/maintenance', function () {
    return view('maintenance');
})->name('maintenance');

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// });
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('prevent-direct-logout');

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/action-login', [AuthController::class, 'actionLogin'])->name('action-login');
Route::get('/lupa-password', [AuthController::class, 'lupaPassword'])->name('lupa-password');
Route::post('/action-lupa-password', [AuthController::class, 'actionLupaPassword'])->name('action-lupa-password');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('reset-password');
Route::post('/action-reset-password/{token}', [AuthController::class, 'actionResetPassword'])->name('action-reset-password');


//Route Admin
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin');
});

// =====================================================
// ROUTE UNTUK BKK
// =====================================================
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::controller(BkkController::class)->group(function () {
        Route::get('/bkk', 'index')->name('bkk');
        Route::get('/profil-bkk/{id}', 'edit')->name('profil-bkk');
        Route::post('/update-profile-bkk', 'update')->name('update-profile-bkk');
        Route::post('/update-password-bkk', 'gantiPassword')->name('update-password-bkk');

        Route::get('/hasil-kuesioner-bkk', 'hasil')->name('hasil-kuesioner-bkk');
        Route::get('/hasil-preview-bkk/{id}', 'preview')->name('hasil-preview-bkk');
        Route::get('/preview-print-bkk/{id}', 'previewPrint')->name('preview-print-bkk');
        Route::get('/hasil-preview2-bkk/{id}', 'preview2')->name('hasil-preview2-bkk');
        Route::get('/hasil-preview3-bkk/{id}', 'preview3')->name('hasil-preview3-bkk');
        Route::get('/hasil-preview4-bkk/{id}', 'preview4')->name('hasil-preview4-bkk');
        Route::get('/hasil-preview5-bkk/{id}', 'preview5')->name('hasil-preview5-bkk');
        Route::get('/hasil-preview6-bkk/{id}', 'preview6')->name('hasil-preview6-bkk');


        Route::get('/notifikasi-bkk/{id}', 'kirimNotifikasi')->name('notifikasi-bkk');
        Route::get('/statistik-bkk', 'statistik')->name('statistik-bkk');
        Route::get('/statistik-bkk-print', 'statistikPrint')->name('statistik-bkk-print');
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
        Route::get('/alumni-bkk', 'getDataTables')->name('alumni-bkk');
        // Route::get('/alumni-bkk', 'index')->name('alumni-bkk');
        Route::get('/alumni-create', 'create')->name('alumni-create');
        Route::post('/alumni-store', 'store')->name('alumni-store');
        Route::get('/alumni-edit/{id}', 'edit')->name('alumni-edit');
        Route::post('/alumni-update', 'update')->name('alumni-update');
        Route::get('/alumni-delete/{id}', 'destroy')->name('alumni-delete');
    });

    //Route Kuesioner
    Route::controller(KuesionerController::class)->group(function () {
        Route::get('/kuesioner', 'index')->name('kuesioner');
        Route::get('/kuesioner-create', 'create')->name('kuesioner-create');
        Route::post('/kuesioner-store', 'store')->name('kuesioner-store');

        Route::get('/kuesioner-show-bkk/{id}', 'show')->name('kuesioner-show-bkk');

        Route::get('/kuesioner-edit/{id}', 'edit')->name('kuesioner-edit');
        Route::post('/kuesioner-update', 'update')->name('kuesioner-update');
        Route::get('/kuesioner-delete/{id}', 'destroy')->name('kuesioner-delete');
        // Route::get('/hasil-kuesioner-bkk', 'hasil')->name('hasil-kuesioner-bkk');
        // Route::get('/statistik-bkk', 'statistik')->name('statistik-bkk');
    });

    //Route Pertanyaan
    Route::controller(PertanyaanController::class)->group(function () {
        Route::get('/pertanyaan', 'index')->name('pertanyaan');
        Route::get('/pertanyaan-create', 'create')->name('pertanyaan-create');
        Route::post('/pertanyaan-store', 'store')->name('pertanyaan-store');
        Route::get('/pertanyaan-show/{id}', 'show')->name('pertanyaan-show');
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
        Route::delete('/opsi-delete/{id}', 'destroy')->name('opsi-delete');
    });
});

// =====================================================
// ROUTE UNTUK WAKA HUMAS
// =====================================================
Route::middleware(['auth', 'role:2'])->group(function () {
    // Route Dashboard
    Route::controller(HumasController::class)->group(function () {
        Route::get('/humas', 'index')->name('humas');
        Route::get('/jurusan-humas', 'jurusan')->name('jurusan-humas');
        // Route::get('/alumni-humas', 'getDataTablesAlumni')->name('alumni-humas');
        Route::get('/alumni-humas', 'alumni')->name('alumni-humas');
        Route::get('/profil-humas/{id}', 'edit')->name('profil-humas');
        Route::post('/update-profile-humas', 'update')->name('update-profile-humas');
        Route::post('/update-password-humas', 'gantiPassword')->name('update-password-humas');

        Route::get('/hasil-kuesioner-humas', 'hasil')->name('hasil-kuesioner-humas');
        Route::get('/hasil-preview-humas/{id}', 'preview')->name('hasil-preview-humas');
        Route::get('/preview-print-humas', 'previewPrint')->name('preview-print-humas');
        Route::get('/hasil-preview2-humas/{id}', 'preview2')->name('hasil-preview2-humas');
        Route::get('/hasil-preview3-humas/{id}', 'preview3')->name('hasil-preview3-humas');
        Route::get('/hasil-preview4-humas/{id}', 'preview4')->name('hasil-preview4-humas');
        Route::get('/hasil-preview5-humas/{id}', 'preview5')->name('hasil-preview5-humas');
        Route::get('/hasil-preview6-humas/{id}', 'preview6')->name('hasil-preview6-humas');


        Route::get('/notifikasi-humas/{id}', 'kirimNotifikasi')->name('notifikasi-humas');
        Route::get('/statistik-humas', 'statistik')->name('statistik-humas');
        Route::get('/statistik-humas-print', 'statistikPrint')->name('statistik-humas-print');

        // Route::get('/hasil-kuesioner-humas', 'hasil')->name('hasil-kuesioner-humas');
        // Route::get('/statistik-humas', 'statistik')->name('statistik-humas');
    });

    //Route Pegawai
    Route::controller(PegawaiController::class)->group(function () {
        Route::get('/pegawai', 'index')->name('pegawai');
        Route::get('/pegawai-create', 'create')->name('pegawai-create');
        Route::post('/pegawai-store', 'store')->name('pegawai-store');
        Route::get('/pegawai-edit/{id}', 'edit')->name('pegawai-edit');
        Route::post('/pegawai-update', 'update')->name('pegawai-update');
        Route::get('/pegawai-delete/{id}', 'destroy')->name('pegawai-delete');
    });
});


// =====================================================
// ROUTE UNTUK DISNAKER
// =====================================================
Route::middleware(['auth', 'role:3'])->group(function () {
    Route::controller(DisnakerController::class)->group(function () {
        Route::get('/disnaker', 'index')->name('disnaker');
        Route::get('/hasil-kuesioner-disnaker', 'index')->name('hasil-kuesioner-disnaker');

        Route::get('/jurusan-disnaker', 'jurusan')->name('jurusan-disnaker');
        Route::get('/alumni-disnaker', 'alumni')->name('alumni-disnaker');

        Route::get('/hasil-kuesioner-disnaker', 'hasil')->name('hasil-kuesioner-disnaker');
        Route::get('/hasil-preview-disnaker/{id}', 'preview')->name('hasil-preview-disnaker');
        Route::get('/preview-print-disnaker', 'previewPrint')->name('preview-print-disnaker');
        Route::get('/hasil-preview2-disnaker/{id}', 'preview2')->name('hasil-preview2-disnaker');
        Route::get('/hasil-preview3-disnaker/{id}', 'preview3')->name('hasil-preview3-disnaker');
        Route::get('/hasil-preview4-disnaker/{id}', 'preview4')->name('hasil-preview4-disnaker');
        Route::get('/hasil-preview5-disnaker/{id}', 'preview5')->name('hasil-preview5-disnaker');
        Route::get('/hasil-preview6-disnaker/{id}', 'preview6')->name('hasil-preview6-disnaker');


        Route::get('/notifikasi-disnaker/{id}', 'kirimNotifikasi')->name('notifikasi-disnaker');
        Route::get('/statistik-disnaker', 'statistik')->name('statistik-disnaker');
        Route::get('/statistik-disnaker-print', 'statistikPrint')->name('statistik-disnaker-print');
    });
});


// =====================================================
// ROUTE UNTUK ALUMNI
// =====================================================
Route::middleware(['auth', 'role:4'])->group(function () {
    Route::controller(AlumniAlumniController::class)->group(function () {
        Route::get('/alumni', 'index')->name('alumni');
        Route::get('/profil-alumni/{id}', 'edit')->name('profil-alumni');
        Route::post('/update-profil-alumni', 'update')->name('update-profil-alumni');
        Route::post('/update-password-alumni', 'gantiPassword')->name('update-password-alumni');


        Route::get('/kuesioner-alumni', 'viewKuesioner')->name('kuesioner-alumni');
        Route::get('/kuesioner-alumni-show/{id}', 'showKuesioner')->name('kuesioner-alumni-show');
        Route::post('/kuesioner-alumni-save', 'saveKuesioner')->name('kuesioner-alumni-save');

        Route::get('/kuesioner-history-alumni', 'historyKuesioner')->name('kuesioner-history-alumni');
        Route::get('/kuesioner-history-detail-alumni/{id}', 'historyDetailKuesioner')->name('kuesioner-history-detail-alumni');


        // Route::get('/kuesioner-alumni', 'index')->name('kuesioner-alumni');
        Route::get('/riwayat-kuesioner-alumni', 'index')->name('riwayat-kuesioner-alumni');

        Route::get('/jurusan-alumni', 'jurusan')->name('jurusan-alumni');
        Route::get('/alumni-alumni', 'alumni')->name('alumni-alumni');
    });
});
