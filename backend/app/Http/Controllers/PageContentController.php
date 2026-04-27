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
        $about = PageContent::where('page_name', 'home')->where('section_name', 'about')->first();
        $stats = PageContent::where('page_name', 'home')->where('section_name', 'stats')->first();
        $cta = PageContent::where('page_name', 'home')->where('section_name', 'cta')->first();

        return view('admin.pages.home', compact('hero', 'about', 'stats', 'cta'));
    }

    public function updateHome(Request $request)
    {
        $section = $request->input('section');
        $content = $request->input('content', []);

        // Handle File Uploads for Hero Slider
        if ($section === 'hero') {
            $existingImages = $request->input('existing_images', []);
            $uploadedImages = [];

            if ($request->hasFile('new_images')) {
                foreach ($request->file('new_images') as $file) {
                    $path = $file->store('page_contents', 'public');
                    $uploadedImages[] = Storage::url($path);
                }
            }

            // Gabungkan gambar lama yang tetap disimpan dengan yang baru di-upload
            $content['images'] = array_merge($existingImages, $uploadedImages);
        }

        PageContent::updateOrCreate(
            ['page_name' => 'home', 'section_name' => $section],
            ['content' => $content]
        );

        return back()->with('success', 'Konten berhasil diperbarui!');
    }
}
