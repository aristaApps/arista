<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HktController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\SdptController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NasibAkhirController;
use App\Http\Controllers\KelembagaanController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\LokasiArsipController;
use App\Http\Controllers\KemahasiswaanController;
use App\Http\Controllers\PenciptaArsipController;
use App\Http\Controllers\UnitPengelolaController;
use App\Http\Controllers\TingkatPerkembanganController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rute untuk verifikasi email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Rute untuk menangani link verifikasi
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard'); // Arahkan ke halaman setelah verifikasi berhasil
})->middleware(['auth', 'signed'])->name('verification.verify');

// Rute untuk mengirim ulang email verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Email verifikasi telah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('klasifikasi', KlasifikasiController::class);
Route::resource('pencipta_arsip', PenciptaArsipController::class);
Route::resource('lokasi', LokasiArsipController::class);
Route::resource('unit', UnitPengelolaController::class);
Route::resource('tingkat', TingkatPerkembanganController::class);
Route::resource('nasib', NasibAkhirController::class);
Route::resource('hkt', HktController::class);
Route::resource('keuangan', KeuanganController::class);
Route::resource('kelembagaan', KelembagaanController::class);
Route::resource('kemahasiswaan', KemahasiswaanController::class);
Route::resource('akademik', AkademikController::class);
Route::resource('sdpt', SdptController::class);







