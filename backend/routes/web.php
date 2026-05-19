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

    // Konfirmasi Donasi routes
    Route::resource('konfirmasi-donasi', App\Http\Controllers\KonfirmasiDonasiController::class, [
        'as' => 'admin'
    ]);
    Route::post('konfirmasi-donasi/{konfirmasi_donasi}/update-status', [App\Http\Controllers\KonfirmasiDonasiController::class, 'updateStatus'])->name('admin.konfirmasi-donasi.update-status');

    // Permohonan Bantuan
    Route::resource('permohonan-bantuan', \App\Http\Controllers\PermohonanBantuanController::class)
        ->names('admin.permohonan-bantuan');
    Route::post('permohonan-bantuan/{permohonanBantuan}/status', [\App\Http\Controllers\PermohonanBantuanController::class, 'updateStatus'])
        ->name('admin.permohonan-bantuan.update-status');

    // Volunteer
    Route::get('volunteer/page', [\App\Http\Controllers\VolunteerController::class, 'editPage'])->name('admin.volunteer.page.edit');
    Route::post('volunteer/page', [\App\Http\Controllers\VolunteerController::class, 'updatePage'])->name('admin.volunteer.page.update');
    Route::resource('volunteer', \App\Http\Controllers\VolunteerController::class)
        ->names('admin.volunteer');
    Route::post('volunteer/{volunteer}/status', [\App\Http\Controllers\VolunteerController::class, 'updateStatus'])
        ->name('admin.volunteer.update-status');

    // Berita
    Route::resource('berita', \App\Http\Controllers\BeritaController::class)
        ->names('admin.berita');
    Route::post('berita/{beritum}/toggle-home', [\App\Http\Controllers\BeritaController::class, 'toggleHome'])
        ->name('admin.berita.toggle-home');
    Route::post('berita/{beritum}/toggle-publish', [\App\Http\Controllers\BeritaController::class, 'togglePublish'])
        ->name('admin.berita.toggle-publish');
    Route::post('berita/upload-image', [\App\Http\Controllers\BeritaController::class, 'uploadImage'])
        ->name('admin.berita.upload-image');

    // Artikel
    Route::resource('artikel', \App\Http\Controllers\ArtikelController::class)
        ->names('admin.artikel');
    Route::post('artikel/{artikel}/toggle-home', [\App\Http\Controllers\ArtikelController::class, 'toggleHome'])
        ->name('admin.artikel.toggle-home');
    Route::post('artikel/{artikel}/toggle-publish', [\App\Http\Controllers\ArtikelController::class, 'togglePublish'])
        ->name('admin.artikel.toggle-publish');
    Route::post('artikel/{artikel}/toggle-editor-choice', [\App\Http\Controllers\ArtikelController::class, 'toggleEditorChoice'])
        ->name('admin.artikel.toggle-editor-choice');
    Route::post('artikel/upload-image', [\App\Http\Controllers\ArtikelController::class, 'uploadImage'])
        ->name('admin.artikel.upload-image');

    // Program Management
    Route::prefix('program')->name('admin.program.')->group(function () {
        Route::get('/{program}', [\App\Http\Controllers\Admin\ProgramController::class, 'edit'])->name('edit');
        Route::post('/{program}', [\App\Http\Controllers\Admin\ProgramController::class, 'update'])->name('update');
    });

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

    // Manajemen No Rekening
    Route::get('/rekening', [\App\Http\Controllers\RekeningController::class, 'index'])->name('admin.rekening.index');
    Route::post('/rekening/hero', [\App\Http\Controllers\RekeningController::class, 'updateHero'])->name('admin.rekening.update-hero');
    Route::post('/rekening/category', [\App\Http\Controllers\RekeningController::class, 'storeCategory'])->name('admin.rekening.category.store');
    Route::put('/rekening/category/{category}', [\App\Http\Controllers\RekeningController::class, 'updateCategory'])->name('admin.rekening.category.update');
    Route::delete('/rekening/category/{category}', [\App\Http\Controllers\RekeningController::class, 'destroyCategory'])->name('admin.rekening.category.destroy');
    Route::post('/rekening/bank', [\App\Http\Controllers\RekeningController::class, 'storeBank'])->name('admin.rekening.bank.store');
    Route::put('/rekening/bank/{bank}', [\App\Http\Controllers\RekeningController::class, 'updateBank'])->name('admin.rekening.bank.update');
    Route::delete('/rekening/bank/{bank}', [\App\Http\Controllers\RekeningController::class, 'destroyBank'])->name('admin.rekening.bank.destroy');
    Route::post('/rekening/update-order', [\App\Http\Controllers\RekeningController::class, 'updateOrder'])->name('admin.rekening.update-order');

    // Manajemen Mitra
    Route::get('/mitra', [\App\Http\Controllers\MitraController::class, 'index'])->name('admin.mitra.index');
    Route::post('/mitra/section', [\App\Http\Controllers\MitraController::class, 'storeSection'])->name('admin.mitra.section.store');
    Route::put('/mitra/section/{section}', [\App\Http\Controllers\MitraController::class, 'updateSection'])->name('admin.mitra.section.update');
    Route::delete('/mitra/section/{section}', [\App\Http\Controllers\MitraController::class, 'destroySection'])->name('admin.mitra.section.destroy');
    Route::post('/mitra/logo', [\App\Http\Controllers\MitraController::class, 'storeLogo'])->name('admin.mitra.logo.store');
    Route::put('/mitra/logo/{logo}', [\App\Http\Controllers\MitraController::class, 'updateLogo'])->name('admin.mitra.logo.update');
    Route::delete('/mitra/logo/{logo}', [\App\Http\Controllers\MitraController::class, 'destroyLogo'])->name('admin.mitra.logo.destroy');
    Route::post('/mitra/update-order', [\App\Http\Controllers\MitraController::class, 'updateOrder'])->name('admin.mitra.update-order');
    // Manajemen Halaman Layanan (Sub-pages)
    Route::get('/layanan-pages/qrcode', [\App\Http\Controllers\LayananPageController::class, 'editQrCode'])->name('admin.layanan-pages.qrcode');
    Route::post('/layanan-pages/qrcode', [\App\Http\Controllers\LayananPageController::class, 'updateQrCode'])->name('admin.layanan-pages.qrcode.update');

    Route::get('/layanan-pages/kantor', [\App\Http\Controllers\LayananPageController::class, 'editKantor'])->name('admin.layanan-pages.kantor');
    Route::post('/layanan-pages/kantor', [\App\Http\Controllers\LayananPageController::class, 'updateKantor'])->name('admin.layanan-pages.kantor.update');

    Route::get('/layanan-pages/faq', [\App\Http\Controllers\LayananPageController::class, 'editFaq'])->name('admin.layanan-pages.faq');
    Route::post('/layanan-pages/faq', [\App\Http\Controllers\LayananPageController::class, 'updateFaq'])->name('admin.layanan-pages.faq.update');

    Route::get('/layanan-pages/hitung-zakat', [\App\Http\Controllers\LayananPageController::class, 'editHitungZakat'])->name('admin.layanan-pages.hitung-zakat');
    Route::post('/layanan-pages/hitung-zakat', [\App\Http\Controllers\LayananPageController::class, 'updateHitungZakat'])->name('admin.layanan-pages.hitung-zakat.update');
});
