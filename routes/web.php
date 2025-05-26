<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Warga Routes
Route::middleware('auth:warga')->prefix('warga')->name('warga.')->group(function () {
    Route::get('/dashboard', [WargaController::class, 'dashboard'])->name('dashboard');

    // Pengaduan Routes
    Route::get('/pengaduan', [WargaController::class, 'indexPengaduan'])->name('pengaduan.index');
    Route::get('/pengaduan/create', [WargaController::class, 'createPengaduan'])->name('pengaduan.create');
    Route::post('/pengaduan', [WargaController::class, 'storePengaduan'])->name('pengaduan.store');
    Route::get('/pengaduan/{id}', [WargaController::class, 'showPengaduan'])->name('pengaduan.show');
});

// Admin Routes
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Pengaduan Routes
    Route::get('/pengaduan', [AdminController::class, 'indexPengaduan'])->name('pengaduan.index');
    Route::get('/pengaduan/{id}', [AdminController::class, 'showPengaduan'])->name('pengaduan.show');
    Route::patch('/pengaduan/{id}/status', [AdminController::class, 'updateStatus'])->name('pengaduan.updateStatus');

    // Tanggapan Routes
    Route::post('/pengaduan/{id}/tanggapan', [AdminController::class, 'storeTanggapan'])->name('tanggapan.store');
});
