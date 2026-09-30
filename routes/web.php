<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\JenisPoliController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin,karyawan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('pasien', PasienController::class);
    Route::resource('jenis-poli', JenisPoliController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::resource('biaya', BiayaController::class);
});

Route::middleware(['auth', 'role:admin,tenaga_medis'])->group(function () {
    Route::get('diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa.index');
    Route::get('diagnosa/{pendaftaran}/edit', [DiagnosaController::class, 'edit'])->name('diagnosa.edit');
    Route::put('diagnosa/{pendaftaran}', [DiagnosaController::class, 'update'])->name('diagnosa.update');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
