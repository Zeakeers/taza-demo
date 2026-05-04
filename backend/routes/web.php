<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\UserAdminController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/admin', function () {
    if (auth()->check() && auth()->user()->role == 'program') {
        return redirect('/admin/konfirmasi-donasi');
    }
    return redirect()->route('admin.home.edit');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware('auth')->group(function () {
    // Halaman Dummy Konfirmasi Donasi (Bisa diisi nanti)
    Route::get('/konfirmasi-donasi', function() {
        return view('admin.donations.index');
    })->name('admin.donations.index');

    // Manajemen Konten Halaman Home
    Route::get('/home', [PageContentController::class, 'editHome'])->name('admin.home.edit');
    Route::post('/home', [PageContentController::class, 'updateHome'])->name('admin.home.update');

    // Manajemen Konten Halaman Tentang Kami
    Route::get('/about', [PageContentController::class, 'editAbout'])->name('admin.about.edit');
    Route::post('/about', [PageContentController::class, 'updateAbout'])->name('admin.about.update');

    // Manajemen Map Provinsi
    Route::get('/provinces/{province}/edit', [\App\Http\Controllers\ProvinceController::class, 'edit'])->name('admin.provinces.edit');
    Route::post('/provinces/{province}', [\App\Http\Controllers\ProvinceController::class, 'update'])->name('admin.provinces.update');

    // Manajemen Akun Admin (Hanya untuk Dev)
    Route::resource('users', UserAdminController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});
