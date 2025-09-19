<?php

use Illuminate\Support\Facades\Route;

// Import Controller
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;

// Import Controller Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;

// Import Controller Officer
use App\Http\Controllers\Officer\DashboardController as OfficerDashboardController;
use App\Http\Controllers\Officer\BinController;
use App\Http\Controllers\Officer\BinLocationController;
use App\Http\Controllers\Officer\ScheduleController;
use App\Http\Controllers\Officer\ComplaintController;
use App\Http\Controllers\Officer\InformationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == RUTE PUBLIK ==
Route::get('/', [PublicController::class, 'landing'])->name('landing');
Route::post('/complaints', [PublicController::class, 'storeComplaint'])->name('complaints.store');


// --- TAMBAHKAN DUA RUTE DI BAWAH INI ---
Route::get('/jadwal-pengambilan', [PublicController::class, 'showSchedules'])->name('schedules.public.index');
Route::get('/edukasi', [PublicController::class, 'showEducations'])->name('educations.public.index');

// == RUTE AUTENTIKASI ==
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// ========================================================================
// == GRUP ADMIN ==
// HANYA bisa diakses oleh role 'admin'.
// ========================================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/', fn() => redirect()->route('admin.dashboard.index'));
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

    // Admin HANYA mengelola pengguna (officer).
    Route::resource('users', UserController::class);
});


// ========================================================================
// == GRUP OFFICER ==
// Bisa diakses oleh role 'officer' DAN 'admin'.
// ========================================================================
Route::middleware(['auth', 'officer'])->prefix('officer')->name('officer.')->group(function () {
    
    Route::get('/', fn() => redirect()->route('officer.dashboard.index'));
    Route::get('/dashboard', [OfficerDashboardController::class, 'index'])->name('dashboard.index');

    // Officer mengelola operasional harian.
    Route::resource('bins', BinController::class);
    Route::get('bins/{bin}/qr-code', [BinController::class, 'showQrCode'])->name('bins.qr_code');
    Route::resource('locations', BinLocationController::class);
    Route::resource('schedules', ScheduleController::class)->parameters(['schedules' => 'schedule']);
    Route::resource('complaints', ComplaintController::class)->except(['create', 'store', 'destroy']); // Officer mungkin hanya bisa melihat & update status
    Route::resource('informations', InformationController::class);
});