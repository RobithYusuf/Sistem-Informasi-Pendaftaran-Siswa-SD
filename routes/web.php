<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerkasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengumumanController;

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

//frontend landing page
Route::get('/', [InformasiController::class, 'landingPageIndex'])->name('landing_page');

//halaman untuk admin
Route::middleware(['auth'])->group(function () {
    //dashboard
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard')->middleware('auth');

    // Route::post('/admin/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store')->middleware('auth');
    //Admin Pendaftaran
    Route::get('/admin/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index')->middleware('auth');
    Route::get('/admin/pendaftaran/detail/{pendaftaran}', [PendaftaranController::class, 'detail'])->name('pendaftaran.detail')->middleware('auth');
    Route::get('/admin/pendaftaran/edit/{pendaftaran}', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit')->middleware('auth');
    Route::put('/admin/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'update'])->name('pendaftaran.update')->middleware('auth');
    Route::post('/admin/pendaftaran/{id}/diterima', [PendaftaranController::class, 'diterima'])->name('pendaftaran.diterima')->middleware('auth');
    Route::post('/admin/pendaftaran/{id}/ditolak', [PendaftaranController::class, 'ditolak'])->name('pendaftaran.ditolak')->middleware('auth');
    Route::post('/admin/pendaftaran/{id}/menunggu', [PendaftaranController::class, 'menunggu'])->name('pendaftaran.menunggu')->middleware('auth');
    Route::delete('/admin/pendaftaran/{id}/hapus', [PendaftaranController::class, 'hapus'])->name('pendaftaran.hapus')->middleware('auth');

    //Admin Pengumuman
    Route::get('/admin/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index.admin')->middleware('auth');
    Route::get('/admin/pengumuman/detail/{id}', [PengumumanController::class, 'detailadmin'])->name('pengumuman.detail')->middleware('auth');
    Route::get('/admin/pengumuman/tambah', [PengumumanController::class, 'create'])->name('pengumuman.create')->middleware('auth');
    Route::post('/admin/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store')->middleware('auth');
    Route::get('/admin/pengumuman/edit/{pengumuman}', [PengumumanController::class, 'edit'])->name('pengumuman.edit')->middleware('auth');
    Route::put('/admin/pengumuman/{pengumuman}', [PengumumanController::class, 'update'])->name('pengumuman.update')->middleware('auth');
    Route::get('/admin/pengumuman/detail/{pengumuman}', [PengumumanController::class, 'detail'])->name('pengumuman.detail')->middleware('auth');
    Route::delete('/admin/pengumuman/{id}/hapus', [PengumumanController::class, 'hapus'])->name('pengumuman.hapus')->middleware('auth');

    //admin data wali
    Route::get('/admin/wali', [PendaftaranController::class, 'indexwali'])->name('datawali.index')->middleware('auth');
    Route::get('/admin/wali/edit/{pendaftaran}', [PendaftaranController::class, 'editwali'])->name('datawali.edit')->middleware('auth');
    Route::put('/admin/wali/{pendaftaran}', [PendaftaranController::class, 'updatewali'])->name('datawali.update')->middleware('auth');

    //Admin Jadwal
    Route::get('/admin/informasi', [InformasiController::class, 'index'])->name('informasi.index.admin')->middleware('auth');
    Route::get('/admin/informasi/{id}', [InformasiController::class, 'edit'])->name('informasi.edit')->middleware('auth');
    Route::put('/admin/informasi/{id}', [InformasiController::class, 'update'])->name('informasi.update')->middleware('auth');

    //Admin Daftar ulang
    Route::get('/admin/daftarulang', [BerkasController::class, 'index'])->name('daftarulang.index')->middleware('auth');
    Route::get('/admin/daftarulang/{id}', [BerkasController::class, 'edit'])->name('daftarulang.edit')->middleware('auth');
    Route::post('/admin/daftarulang/{id}/acc', [BerkasController::class, 'accberkas'])->name('daftarulang.acc')->middleware('auth');
    Route::post('/admin/daftarulang/{id}/menunggu', [BerkasController::class, 'menungguberkas'])->name('daftarulang.menunggu')->middleware('auth');

    //laporan
    Route::get('/admin/laporanpendaftaran', [LaporanController::class, 'index'])->name('laporanpendaftaran.index')->middleware('auth');
    Route::get('/admin/laporanpendaftaran/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak')->middleware('auth');

});

//pendaftaran siswa (frontend)
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.submit');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/hasil-pendaftaran', [PendaftaranController::class, 'hasil'])->name('pendaftaran.hasil');
//pencarian datasiswa hasil pendaftaram
Route::get('/pendaftaran/hasil/{nik}', [PendaftaranController::class, 'hasilNik'])->name('pendaftaran.hasil.nik');

//pengumuman landingpage
Route::get('/pengumuman', [PengumumanController::class, 'pengumuman'])->name('pengumuman.index');
Route::get('/pengumuman/{pengumuman}', [PengumumanController::class, 'detail'])->name('pengumuman.detail');
Route::get('/pengumuman/print/{pengumuman}', [PengumumanController::class, 'print'])->name('pengumuman.print');
Route::get('/get-pengumuman', [PengumumanController::class, 'getPengumumanTanggal']);


//daftar ulang
Route::get('/daftarulang', [BerkasController::class, 'daftarulang'])->name('daftarulang.index');
Route::post('/daftarulang/validasidata', [BerkasController::class, 'validasidata'])->name('validasidata');
Route::post('/daftarulang/kirimberkas', [BerkasController::class, 'store'])->name('kirimberkas');


//login as admin
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/proseslogin', [AuthController::class, 'postLogin'])->name('postLogin')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
