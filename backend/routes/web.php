<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\CustomFormController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/admin', function () {
    if (auth()->check() && auth()->user()->role == 'program') {
        return redirect()->route('admin.custom-forms.index');
    }
    return redirect()->route('admin.home.edit');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Custom Form Routes (No auth required)
Route::get('/form/{slug}', [CustomFormController::class, 'showPublicForm'])->name('public.form.show');
Route::post('/form/{slug}', [CustomFormController::class, 'submitPublicForm'])->name('public.form.submit');

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

    // Custom Form Builder (Untuk Program & Dev)
    Route::prefix('custom-forms')->group(function () {
        Route::get('/', [CustomFormController::class, 'index'])->name('admin.custom-forms.index');
        Route::get('/create', [CustomFormController::class, 'create'])->name('admin.custom-forms.create');
        Route::post('/', [CustomFormController::class, 'store'])->name('admin.custom-forms.store');
        Route::get('/{customForm}/edit', [CustomFormController::class, 'edit'])->name('admin.custom-forms.edit');
        Route::put('/{customForm}', [CustomFormController::class, 'update'])->name('admin.custom-forms.update');
        Route::delete('/{customForm}', [CustomFormController::class, 'destroy'])->name('admin.custom-forms.destroy');
        Route::post('/{customForm}/toggle-status', [CustomFormController::class, 'toggleStatus'])->name('admin.custom-forms.toggle-status');
        Route::get('/{customForm}/export-csv', [CustomFormController::class, 'exportCsv'])->name('admin.custom-forms.export-csv');
        Route::delete('/submissions/{submission}', [CustomFormController::class, 'destroySubmission'])->name('admin.custom-forms.destroy-submission');
        Route::put('/submissions/{submission}', [CustomFormController::class, 'updateSubmission'])->name('admin.custom-forms.update-submission');
    });
});
