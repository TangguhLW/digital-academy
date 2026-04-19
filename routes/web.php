<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Google OAuth Routes
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/pengaduan/export', [PengaduanController::class, 'exportIndex'])->name('pengaduan.export.index');
    Route::get('/pengaduan/export/pdf', [PengaduanController::class, 'exportPdf'])->name('pengaduan.export.pdf');
    Route::get('/pengaduan/export/excel', [PengaduanController::class, 'exportExcel'])->name('pengaduan.export.excel');
    
    Route::resource('pengaduan', PengaduanController::class);
    Route::patch('/pengaduan/{pengaduan}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    Route::post('/pengaduan/{pengaduan}/tanggapan', [\App\Http\Controllers\TanggapanController::class, 'store'])->name('tanggapan.store');

    // Profile Routes
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Pages
    Route::get('/prosedur-pengaduan', [\App\Http\Controllers\PageController::class, 'prosedur'])->name('page.prosedur');
    Route::get('/tentang-website', [\App\Http\Controllers\PageController::class, 'about'])->name('page.about');

    // Admin User Management
    Route::middleware([\App\Http\Middleware\CheckAdminRole::class])->group(function () {
        Route::resource('admin/users', \App\Http\Controllers\AdminUserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);
    });
});
