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

    public function editAbout()
    {
        $hero = PageContent::where('page_name', 'about')->where('section_name', 'hero')->first();
        $stats = PageContent::where('page_name', 'about')->where('section_name', 'stats')->first();
        $value = PageContent::where('page_name', 'about')->where('section_name', 'value')->first();
        $kepengurusan = PageContent::where('page_name', 'about')->where('section_name', 'kepengurusan')->first();
        $mengenal = PageContent::where('page_name', 'about')->where('section_name', 'mengenal')->first();
        $penghargaan = PageContent::where('page_name', 'about')->where('section_name', 'penghargaan')->first();

        return view('admin.pages.about', compact('hero', 'stats', 'value', 'kepengurusan', 'mengenal', 'penghargaan'));
    }

    public function updateAbout(Request $request)
    {
        $section = $request->input('section');
        
        if (!$section) {
            return back()->with('error', 'Gagal memproses.');
        }

        $content = $request->input('content', []);

        // Handle File Upload for Hero Image
        if ($section === 'hero' && $request->hasFile('new_image')) {
            $file = $request->file('new_image');
            if ($file->isValid()) {
                $path = $file->store('page_contents', 'nextjs_public');
                $content['image'] = Storage::disk('nextjs_public')->url($path);
            }
        } elseif ($section === 'hero') {
            $content['image'] = $request->input('existing_image', '');
        }

        // Handle File Upload for Value Image
        if ($section === 'value') {
            if ($request->input('remove_image_value') === '1') {
                $content['image'] = '';
            } elseif ($request->hasFile('new_image')) {
                $file = $request->file('new_image');
                if ($file->isValid()) {
                    $path = $file->store('page_contents', 'nextjs_public');
                    $content['image'] = Storage::disk('nextjs_public')->url($path);
                }
            } else {
                $content['image'] = $request->input('existing_image', '');
            }
        }

        // Handle File Uploads for Mengenal (Sejarah Image)
        if ($section === 'mengenal') {
            if ($request->input('remove_image_sejarah') === '1') {
                $content['Sejarah']['image'] = '';
            } elseif ($request->hasFile('new_image_sejarah')) {
                $file = $request->file('new_image_sejarah');
                if ($file->isValid()) {
                    $path = $file->store('page_contents', 'nextjs_public');
                    $content['Sejarah']['image'] = Storage::disk('nextjs_public')->url($path);
                }
            } else {
                $content['Sejarah']['image'] = $content['Sejarah']['existing_image'] ?? '';
            }
            
            // Clean up existing_image keys
            unset($content['Sejarah']['existing_image']);
        }

        // Handle File Uploads for Kepengurusan
        if ($section === 'kepengurusan') {
            $kepengurusanData = $request->input('content', []);
            $newImages = $request->file('new_images', []);

            $cleanedData = [];
            foreach ($kepengurusanData as $catIndex => $categoryData) {
                $catName = $categoryData['category'] ?? 'Untitled';
                $members = $categoryData['members'] ?? [];
                
                $cleanedMembers = [];
                if (is_array($members)) {
                    foreach ($members as $memIndex => $member) {
                        if (isset($newImages[$catIndex]['members'][$memIndex]) && $newImages[$catIndex]['members'][$memIndex]->isValid()) {
                            $path = $newImages[$catIndex]['members'][$memIndex]->store('page_contents', 'nextjs_public');
                            $member['image'] = Storage::disk('nextjs_public')->url($path);
                        } else {
                            $member['image'] = $member['existing_image'] ?? '';
                        }
                        unset($member['existing_image']); // Clean up
                        $cleanedMembers[] = $member;
                    }
                }
                
                $cleanedData[$catName] = $cleanedMembers;
            }
            $content = $cleanedData;
        }

        // Handle File Uploads for Penghargaan
        if ($section === 'penghargaan') {
            $penghargaanData = $request->input('content', []);
            $newImages = $request->file('new_images', []);

            $cleanedPenghargaan = [];
            foreach ($penghargaanData as $index => &$item) {
                if (isset($newImages[$index]) && $newImages[$index]->isValid()) {
                    $path = $newImages[$index]->store('page_contents', 'nextjs_public');
                    $item['image'] = Storage::disk('nextjs_public')->url($path);
                } else {
                    $item['image'] = $item['existing_image'] ?? '';
                }
                unset($item['existing_image']); // Clean up
                $cleanedPenghargaan[] = $item;
            }
            $content = $cleanedPenghargaan;
        }

        PageContent::updateOrCreate(
            ['page_name' => 'about', 'section_name' => $section],
            ['content' => $content]
        );

        return back()->with([
            'success' => 'Konten Tentang Kami berhasil diperbarui!',
            'active_tab' => $section
        ]);
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
