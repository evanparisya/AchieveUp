<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\DashboardDosen;
use App\Http\Controllers\DashboardMahasiswa;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PrestasiMahasiswaController;
use App\Http\Controllers\ProdiController;
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
    // Route pemeringkatan
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardAdmin::class, 'index'])->name('index');
        Route::get('entropy', [DashboardAdmin::class, 'entropy'])->name('entropy');
        Route::get('electre', [DashboardAdmin::class, 'electre'])->name('electre');
        Route::get('getAllScorelombamahasiswa', [DashboardAdmin::class, 'getScoreLombaMahasiswa'])->name('getAllScorelombamahasiswa');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/mahasiswa/getdata', [UserController::class, 'getMahasiswaData'])->name('mahasiswa.getdata');
        Route::get('/dosen/getdata', [UserController::class, 'getDosenData'])->name('dosen.data');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
    });

    Route::prefix('prestasi')->name('prestasi.')->group(function () {
        Route::get('/', [VerifikasiPrestasiController::class, 'index'])->name('index');
    });

    Route::prefix('periode')->name('periode.')->group(function () {
        Route::get('/', [PeriodeController::class, 'index'])->name('index');
    });

    Route::prefix('lomba')->name('lomba.')->group(function () {
        Route::get('/', [LombaController::class, 'index'])->name('index');
        Route::get('/getall', [LombaController::class, 'getAll'])->name('getall');
        Route::get('/create', [LombaController::class, 'create'])->name('create');
        Route::post('/store', [LombaController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [LombaController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [LombaController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [LombaController::class, 'destroy'])->name('delete');
    });

    Route::prefix('prodi')->name('prodi.')->group(function () {
        Route::get('/', [ProdiController::class, 'index'])->name('index');
        Route::get('/getall', [ProdiController::class, 'getall'])->name('getall');
        Route::get('/create', [ProdiController::class, 'create'])->name('create');
        Route::post('/store', [ProdiController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProdiController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProdiController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProdiController::class, 'destroy'])->name('delete');
    });
});

Route::middleware(['dosen:dosen pembimbing'])->prefix('dosen_pembimbing')->name('dosen.')->group(function () {
    Route::get('/bimbingan', function () {
        return dd('login dosen pembimbing');
    });
});

Route::middleware(['mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [DashboardMahasiswa::class, 'index'])->name('dashboard.index');

    Route::prefix('prestasi')->name('prestasi.')->group(function () {
        Route::get('/', [PrestasiMahasiswaController::class, 'index'])->name('index');
        Route::get('/getdata', [PrestasiMahasiswaController::class, 'getData'])->name('getdata');
    });
});
