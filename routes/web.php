<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelolaPengaduanController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\StatistikController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

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

Route::get('/', [LandingController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//email verifikasi
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth:warga')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('warga.dashboard');
})->middleware(['auth:warga', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user('warga')->sendEmailVerificationNotification();
    return back()->with('status', 'Link verifikasi telah dikirim!');
})->middleware(['auth:warga', 'throttle:6,1'])->name('verification.send');

//Lupa Password
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Warga Routes
Route::middleware(['auth:warga', 'no.cache', 'verified'])->prefix('warga')->name('warga.')->group(function () {
    Route::get('/dashboard', [WargaController::class, 'dashboard'])->name('dashboard');
    // Pengaduan Routes
    Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
        Route::get('/', [PengaduanController::class, 'index'])->name('index');
        Route::get('/create', [PengaduanController::class, 'create'])->name('create');
        Route::post('/', [PengaduanController::class, 'store'])->name('store');
        Route::delete('/{id}', [PengaduanController::class, 'destroy'])->name('destroy');
        Route::get('/pengaduan/{id}/detail', [PengaduanController::class, 'showDetail'])->name('detail');
    });

    // laporan
    Route::get('/laporan', [KelolaPengaduanController::class, 'laporan'])->name('laporan');
    Route::get('laporan/{id}', [KelolaPengaduanController::class, 'detaillaporan'])->name('detaillaporan');

    Route::get('/profil', [WargaController::class, 'profil'])->name('profil');
    Route::get('/profil/edit', [WargaController::class, 'editProfil'])->name('editProfil');
    Route::post('/profil/update', [WargaController::class, 'updateProfil'])->name('updateProfil');
});

Route::middleware(['auth:admin', 'no.cache'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Pengaduan Routes
    Route::get('/kelola-pengaduan', [KelolaPengaduanController::class, 'kelolaPengaduan'])->name('kelola-pengaduan');
    Route::get('/pengaduan/{pengaduan_id}/detail', [KelolaPengaduanController::class, 'detailPengaduan'])->name('detail-pengaduan');
    Route::put('/pengaduan/{pengaduan_id}/update-status', [KelolaPengaduanController::class, 'updateStatus'])->name('update-status');

    Route::get('/pengaduan/{pengaduan_id}/tanggapan', [KelolaPengaduanController::class, 'createTanggapan'])->name('tanggapan.create');

    Route::post('/pengaduan/{pengaduan_id}/tanggapan', [KelolaPengaduanController::class, 'storeTanggapan'])->name('tanggapan.store');

    Route::get('/profil', [AdminController::class, 'profil'])->name('profil');
    Route::get('/profil/edit', [AdminController::class, 'editProfil'])->name('editProfil');
    Route::post('/profil/update', [AdminController::class, 'updateProfil'])->name('updateProfil');

    // Statistik
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');

    // Export
    Route::get('/export', [StatistikController::class, 'exportPage'])->name('export');
    Route::post('/export/download', [StatistikController::class, 'exportData'])->name('export.download');
});
