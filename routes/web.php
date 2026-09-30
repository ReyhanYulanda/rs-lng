<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\JenisPoliController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PoliController;    
use App\Http\Controllers\BiayaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('pasien', PasienController::class);
Route::resource('jenis-poli', JenisPoliController::class);
Route::resource('dokter', DokterController::class);
Route::resource('poli', PoliController::class);
Route::resource('biaya', BiayaController::class);

require __DIR__.'/auth.php';
