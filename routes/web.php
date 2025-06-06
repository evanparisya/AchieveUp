<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\DashboardDosen;
use App\Http\Controllers\DashboardMahasiswa;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\LombaDosenController;
use App\Http\Controllers\NotifikasiMahasiswa;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PrestasiMahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\NotifikasiDosenPembimbing;
use App\Http\Controllers\ProfilAdminController;
use App\Http\Controllers\ProfilDosenPembimbingController;
use App\Http\Controllers\ProfilMahasiswaController;
use App\Http\Controllers\RekomendasiLombaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiPrestasiController;
use Illuminate\Support\Facades\Route;

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

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/landing', [LandingController::class, 'index']);

Route::middleware(['dosen:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardAdmin::class, 'index'])->name('index');
        Route::get('entropy', [DashboardAdmin::class, 'entropy'])->name('entropy');
        Route::get('electre', [DashboardAdmin::class, 'electre'])->name('electre');
        Route::get('aras', [DashboardAdmin::class, 'aras'])->name('aras');
        Route::get('test', [DashboardAdmin::class, 'test'])->name('test');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');

        Route::get('/mahasiswa/getdata', [UserController::class, 'getMahasiswaData'])->name('mahasiswa.getdata');
        Route::delete('/mahasiswa/{id}', [UserController::class, 'destroyMahasiswa'])->name('admin.users.mahasiswa.delete');

        Route::get('/dosen/getdata', [UserController::class, 'getDosenData'])->name('dosen.data');
        Route::delete('/dosen/{id}', [UserController::class, 'destroyDosen'])->name('admin.users.dosen.delete');

        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');

        Route::get('/mahasiswa/{id}/update', [UserController::class, 'showUpdateMahasiswaForm'])->name('admin.users.mahasiswa.update.form');
        Route::put('/mahasiswa/{id}/update', [UserController::class, 'updateMahasiswa'])->name('admin.users.mahasiswa.update');

        Route::get('/dosen/{id}/update', [UserController::class, 'showUpdateDosenForm'])->name('admin.users.dosen.update.form');
        Route::put('/dosen/{id}/update', [UserController::class, 'updateDosen'])->name('admin.users.dosen.update');

        Route::get('/{id}', [UserController::class, 'show'])->name('admin.users.show');
    });

    Route::prefix('prestasi')->name('prestasi.')->group(function () {
        Route::get('/', [VerifikasiPrestasiController::class, 'index'])->name('index');
        Route::get('/getdata', [VerifikasiPrestasiController::class, 'getData'])->name('getdata');
        Route::get('/{id}', [VerifikasiPrestasiController::class, 'show'])->name('show');
        Route::patch('/{id}/approve', [VerifikasiPrestasiController::class, 'approve'])->name('approve');
        Route::patch('/{id}/reject', [VerifikasiPrestasiController::class, 'reject'])->name('reject');
        Route::get('/{id}', [VerifikasiPrestasiController::class, 'show'])->name('admin.prestasi.show');
    });

    Route::prefix('periode')->name('periode.')->group(function () {
        Route::get('/', [PeriodeController::class, 'index'])->name('index');
    });

    Route::prefix('lomba')->name('lomba.')->group(function () {
        Route::get('/', [LombaController::class, 'index'])->name('index');
        Route::get('/getall', [LombaController::class, 'getAll'])->name('getall');
        Route::get('/{id}', [LombaController::class, 'show'])->name('detail');
        Route::get('/create', [LombaController::class, 'create'])->name('create');
        Route::post('/store', [LombaController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [LombaController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [LombaController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [LombaController::class, 'destroy'])->name('delete');
    });

    Route::prefix('prodi')->name('prodi.')->group(function () {
        Route::get('/', [ProdiController::class, 'index'])->name('index');
        Route::get('/getall', [ProdiController::class, 'getall'])->name('getall');
        Route::get('/{id}', [ProdiController::class, 'show'])->name('detail');
        Route::get('/create', [ProdiController::class, 'create'])->name('create');
        Route::post('/store', [ProdiController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProdiController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProdiController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProdiController::class, 'destroy'])->name('delete');
    });

    Route::prefix('bidang')->name('bidang.')->group(function () {
        Route::get('/', [BidangController::class, 'index'])->name('index');
        Route::get('/create', [BidangController::class, 'create'])->name('create');
        Route::get('/getall', [BidangController::class, 'getall'])->name('getall');
        Route::get('/{id}', [BidangController::class, 'show'])->name('detail');
        
        Route::post('/store', [BidangController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BidangController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BidangController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BidangController::class, 'destroy'])->name('delete');
    });




    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [ProfilAdminController::class, 'index'])->name('index');
        Route::get('/edit', [ProfilAdminController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProfilAdminController::class, 'update'])->name('update');
    });

    Route::prefix('rekomendasi')->name('rekomendasi.')->group(function () {
        Route::get('/', [RekomendasiLombaController::class, 'index'])->name('index');
        Route::get('/create/{id}', [RekomendasiLombaController::class, 'create'])->name('create');
        Route::post('/store', [RekomendasiLombaController::class, 'store'])->name('store');
        Route::get('/list', [RekomendasiLombaController::class, 'list'])->name('list');
        Route::get('/getAll', [RekomendasiLombaController::class, 'getAll'])->name('getAll');
        Route::get('/{id}', [RekomendasiLombaController::class, 'show'])->name('detail');
        Route::delete('/delete/{id}', [RekomendasiLombaController::class, 'destroy'])->name('delete');
    });
});

Route::middleware(['dosen:dosen pembimbing'])->prefix('dosen_pembimbing')->name('dosen.')->group(function () {
    Route::get('/dashboard', [DashboardDosen::class, 'index'])->name('dashboard.index');

    Route::prefix('bimbingan')->name('bimbingan.')->group(function () {
        Route::get('/', [BimbinganController::class, 'index'])->name('index');
        Route::get('/getdata', [BimbinganController::class, 'getData'])->name('getdata');
        Route::get('/{id}', [BimbinganController::class, 'detail'])->name('detail');
    });

    Route::prefix('profil')->name('profil.')->group(function(){
        Route::get('/', [ProfilDosenPembimbingController::class, 'index'])->name('index');
        Route::get('/edit', [ProfilDosenPembimbingController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProfilDosenPembimbingController::class, 'update'])->name('update');
    });

    Route::prefix('lomba')->name('lomba.')->group(function () {
        Route::get('/', [LombaDosenController::class, 'index'])->name('index');
        Route::get('/getall', [LombaDosenController::class, 'getAll'])->name('getall');
        Route::get('/create', [LombaDosenController::class, 'create'])->name('create');
        Route::post('/store', [LombaDosenController::class, 'store'])->name('store');
        Route::get('/{id}', [LombaDosenController::class, 'show'])->name('show');
    });

    Route::prefix('notifikasi')->name('notifikasi.')->group(function () {
        Route::get('/', [NotifikasiDosenPembimbing::class, 'index'])->name('index');
        Route::get('getAllRekomendasi', [NotifikasiDosenPembimbing::class, 'getAllRekomendasi'])->name('getAllRekomendasi');
        Route::post('/markAsRead', [NotifikasiDosenPembimbing::class, 'markAsRead'])->name('markAsRead');
        Route::post('/markAllAsRead', [NotifikasiDosenPembimbing::class, 'markAllAsRead'])->name('markAllAsRead');
        Route::get('/{id}', [NotifikasiDosenPembimbing::class, 'show'])->name('detail');
        Route::delete('/{id}', [NotifikasiDosenPembimbing::class, 'destroy'])->name('delete');
        Route::post('/destroyIsAcceptedMessage', [NotifikasiDosenPembimbing::class, 'destroyIsAcceptedMessage'])->name('destroyIsAcceptedMessage');

    });
});

Route::middleware(['mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('', [DashboardMahasiswa::class, 'index'])->name('index');
    });

    Route::prefix('prestasi')->name('prestasi.')->group(function () {
        Route::get('/', [PrestasiMahasiswaController::class, 'index'])->name('index');
        Route::get('/getdata', [PrestasiMahasiswaController::class, 'getData'])->name('getdata');
        Route::get('/create', [PrestasiMahasiswaController::class, 'create'])->name('create');
        Route::post('/store', [PrestasiMahasiswaController::class, 'store'])->name('store');
        Route::get('/{id}', [PrestasiMahasiswaController::class, 'show'])->name('show');
        Route::delete('/{id}', [PrestasiMahasiswaController::class, 'destroy'])->name('destroy');

        Route::get('/{id}/edit', [PrestasiMahasiswaController::class, 'edit'])
            ->name('mahasiswa.prestasi.edit');
        Route::put('/{id}', [PrestasiMahasiswaController::class, 'update'])
            ->name('mahasiswa.prestasi.update');
    });

    Route::prefix('lomba')->name('lomba.')->group(function () {
        Route::get('/', [PrestasiMahasiswaController::class, 'index'])->name('index');
        Route::get('/getdata', [PrestasiMahasiswaController::class, 'getData'])->name('getdata');
        Route::get('/create', [PrestasiMahasiswaController::class, 'create'])->name('create');
        Route::post('/store', [PrestasiMahasiswaController::class, 'store'])->name('store');
        Route::get('/{id}', [PrestasiMahasiswaController::class, 'show'])->name('show');
        Route::delete('/{id}', [PrestasiMahasiswaController::class, 'destroy'])->name('destroy');

        Route::get('/{id}/edit', [PrestasiMahasiswaController::class, 'edit'])
            ->name('mahasiswa.prestasi.edit');
        Route::put('/{id}', [PrestasiMahasiswaController::class, 'update'])
            ->name('mahasiswa.prestasi.update');
    });

    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [ProfilMahasiswaController::class, 'index'])->name('index');
        Route::get('/edit', [ProfilMahasiswaController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProfilMahasiswaController::class, 'update'])->name('update');
    });

    Route::prefix('notifikasi')->name('notifikasi.')->group(function () {
        Route::get('/', [NotifikasiMahasiswa::class, 'index'])->name('index');
        Route::get('getAllRekomendasi', [NotifikasiMahasiswa::class, 'getAllRekomendasi'])->name('getAllRekomendasi');
        Route::post('/markAsRead', [NotifikasiMahasiswa::class, 'markAsRead'])->name('markAsRead');
        Route::post('/markAllAsRead', [NotifikasiMahasiswa::class, 'markAllAsRead'])->name('markAllAsRead');
        Route::get('/{id}', [NotifikasiMahasiswa::class, 'show'])->name('detail');
        Route::delete('/{id}', [NotifikasiMahasiswa::class, 'destroy'])->name('delete');
        Route::post('/destroyIsAccpeptedMessege', [NotifikasiMahasiswa::class, 'destroyIsAccpeptedMessege'])->name('destroyIsAccpeptedMessege');

    });
});
