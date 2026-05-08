<?php

use Illuminate\Support\Facades\Route;

// AUTH
use App\Http\Controllers\AuthController;

// CONTROLLER
use App\Http\Controllers\IbuController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\PenimbanganController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KehamilanController;

/*
|--------------------------------------------------------------------------
| REDIRECT AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| AUTH (GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost']);

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost']);

});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| AREA LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | EXPORT & LAPORAN
    |--------------------------------------------------------------------------
    */

    // OBAT
    Route::get('/obat/laporan', [ObatController::class, 'laporan'])->name('obat.laporan');
    Route::get('/obat/laporan/export/excel', [ObatController::class, 'exportExcel'])->name('obat.laporan.excel');
    Route::get('/obat/laporan/export/pdf', [ObatController::class, 'exportPdf'])->name('obat.laporan.pdf');

    // KEUANGAN
    Route::get('/keuangan/export/excel', [KeuanganController::class, 'exportExcel'])->name('keuangan.export.excel');
    Route::get('/keuangan/export/pdf', [KeuanganController::class, 'exportPdf'])->name('keuangan.export.pdf');

    // KEHAMILAN
    Route::get('/kehamilan/laporan/pdf', [KehamilanController::class, 'laporanPdf'])->name('kehamilan.laporan.pdf');

    // IMUNISASI
    Route::get('/imunisasi/laporan/pdf', [ImunisasiController::class, 'laporanPdf'])->name('imunisasi.laporan.pdf');

    // PENIMBANGAN
    Route::get('/penimbangan/laporan/pdf', [PenimbanganController::class, 'laporanPdf'])->name('penimbangan.laporan.pdf');

    /*
    |--------------------------------------------------------------------------
    | MASTER DATA (CRUD)
    |--------------------------------------------------------------------------
    */

    Route::resource('ibu', IbuController::class);
    Route::resource('anak', AnakController::class);

    Route::resource('imunisasi', ImunisasiController::class);
    Route::resource('penimbangan', PenimbanganController::class);

    Route::resource('dokter', DokterController::class);

    Route::get('/pasien/{id}/riwayat-obat', [RekamMedisController::class, 'riwayatObat'])
        ->name('pasien.riwayat');

    Route::resource('pasien', PasienController::class);

    Route::resource('obat', ObatController::class)->except(['show']);
    Route::resource('rekam-medis', RekamMedisController::class);
    Route::resource('keuangan', KeuanganController::class);
    Route::resource('kehamilan', KehamilanController::class);

});