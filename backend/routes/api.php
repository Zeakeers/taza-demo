<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\PageContent;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Ambil semua konten untuk halaman tertentu
Route::get('/content/{page}', function ($page) {
    $contents = PageContent::where('page_name', $page)->get();
    
    // Transformasikan agar mudah dibaca oleh Next.js (key-value)
    $response = [];
    foreach ($contents as $item) {
        $response[$item->section_name] = $item->content;
    }
    
    return response()->json($response);
});

// Ambil semua data provinsi
Route::get('/provinces', function () {
    return response()->json(\App\Models\Province::orderBy('name')->get());
});

// Submit Permohonan Bantuan
Route::post('/permohonan-bantuan', [\App\Http\Controllers\PermohonanBantuanController::class, 'apiStore']);

// Submit Konfirmasi Donasi
Route::post('/konfirmasi-donasi', [\App\Http\Controllers\KonfirmasiDonasiController::class, 'apiStore']);

// Submit Volunteer
Route::post('/volunteer', [\App\Http\Controllers\VolunteerController::class, 'apiStore']);

// Berita
Route::get('/berita', [\App\Http\Controllers\BeritaController::class, 'apiIndex']);
Route::get('/berita/home', [\App\Http\Controllers\BeritaController::class, 'apiHome']);
Route::get('/berita/{slug}/related', [\App\Http\Controllers\BeritaController::class, 'apiRelated']);
Route::get('/berita/{slug}', [\App\Http\Controllers\BeritaController::class, 'apiShow']);

// Artikel
Route::get('/artikel', [\App\Http\Controllers\ArtikelController::class, 'apiIndex']);
Route::get('/artikel/home', [\App\Http\Controllers\ArtikelController::class, 'apiHome']);
Route::get('/artikel/editor-choice', [\App\Http\Controllers\ArtikelController::class, 'apiEditorChoice']);
Route::get('/artikel/{slug}/related', [\App\Http\Controllers\ArtikelController::class, 'apiRelated']);
Route::get('/artikel/{slug}', [\App\Http\Controllers\ArtikelController::class, 'apiShow']);

// Rekening
Route::get('/rekening', [\App\Http\Controllers\RekeningController::class, 'apiIndex']);

// Mitra
Route::get('/mitra', [\App\Http\Controllers\MitraController::class, 'apiIndex']);

// Tata Kelola
Route::prefix('tata-kelola')->group(function () {
    Route::get('/annual-report', [\App\Http\Controllers\AnnualReportController::class, 'apiIndex']);
    Route::get('/financial-report', [\App\Http\Controllers\FinancialReportController::class, 'apiIndex']);
    Route::get('/audit-iso', [\App\Http\Controllers\AuditIsoController::class, 'apiIndex']);
    Route::get('/legal-formal', [\App\Http\Controllers\LegalFormalController::class, 'apiIndex']);
});
