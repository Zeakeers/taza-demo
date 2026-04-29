<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageContentController extends Controller
{
    public function editHome()
    {
        $hero = PageContent::where('page_name', 'home')->where('section_name', 'hero')->first();
        $programs = PageContent::where('page_name', 'home')->where('section_name', 'programs')->first();
        $about = PageContent::where('page_name', 'home')->where('section_name', 'about')->first();
        $stats = PageContent::where('page_name', 'home')->where('section_name', 'stats')->first();
        $cta = PageContent::where('page_name', 'home')->where('section_name', 'cta')->first();
        $provinces = \App\Models\Province::orderBy('name')->get();

        return view('admin.pages.home', compact('hero', 'programs', 'about', 'stats', 'cta', 'provinces'));
    }

    public function updateHome(Request $request)
    {
        $section = $request->input('section');
        
        if (!$section) {
            return back()->with('error', 'Gagal memproses. Ukuran file gambar yang Anda upload melebihi batas maksimal server (Maks 8MB).');
        }

        $content = $request->input('content', []);

        // Handle File Uploads for Hero Slider
        if ($section === 'hero') {
            $existingImages = $request->input('existing_images', []);
            $uploadedImages = [];

            if ($request->hasFile('new_images')) {
                foreach ($request->file('new_images') as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('page_contents', 'nextjs_public');
                        $uploadedImages[] = Storage::disk('nextjs_public')->url($path);
                    } else {
                        return back()->with('error', 'Gagal upload gambar. Ukuran file mungkin terlalu besar (Maks 2MB) atau file rusak.');
                    }
                }
            }

            // Gabungkan gambar lama yang tetap disimpan dengan yang baru di-upload
            $content['images'] = array_merge($existingImages, $uploadedImages);
        }

        // Handle File Uploads for Programs Section
        if ($section === 'programs') {
            $programsData = $request->input('content.programs', []);

            if ($request->hasFile('new_program_images')) {
                foreach ($request->file('new_program_images') as $index => $file) {
                    if ($file->isValid()) {
                        $path = $file->store('page_contents', 'nextjs_public');
                        $programsData[$index]['image'] = Storage::disk('nextjs_public')->url($path);
                    } else {
                        return back()->with('error', 'Gagal upload gambar untuk program. Ukuran file mungkin terlalu besar atau rusak.');
                    }
                }
            }

            $content['programs'] = $programsData;
        }

        PageContent::updateOrCreate(
            ['page_name' => 'home', 'section_name' => $section],
            ['content' => $content]
        );

        return back()->with('success', 'Konten berhasil diperbarui!');
    }
}
