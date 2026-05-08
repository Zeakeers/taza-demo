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
