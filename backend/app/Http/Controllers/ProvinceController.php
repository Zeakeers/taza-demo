<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Province;
use Illuminate\Support\Facades\Storage;

class ProvinceController extends Controller
{
    public function edit(Province $province)
    {
        return view('admin.provinces.edit', compact('province'));
    }

    public function update(Request $request, Province $province)
    {
        $data = $request->validate([
            'is_active' => 'nullable',
            'beneficiaries' => 'nullable|string',
            'funds' => 'nullable|string',
            'quote' => 'nullable|string',
        ]);
        
        $data['is_active'] = $request->has('is_active');

        $existingImages = $request->input('existing_images', []);
        $uploadedImages = [];
        $newTitles = $request->input('new_images_titles', []);
        $newDescriptions = $request->input('new_images_descriptions', []);

        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $index => $file) {
                if ($file->isValid()) {
                    $path = $file->store('provinces', 'nextjs_public');
                    // nextjs_public usually maps to public/uploads
                    $url = Storage::disk('nextjs_public')->url($path);
                    
                    $uploadedImages[] = [
                        'url' => $url,
                        'title' => $newTitles[$index] ?? '',
                        'description' => $newDescriptions[$index] ?? ''
                    ];
                }
            }
        }

        // Format existing images to ensure backwards compatibility and proper structure
        $formattedExisting = [];
        if (is_array($existingImages)) {
            foreach ($existingImages as $img) {
                if (is_array($img)) {
                    $formattedExisting[] = [
                        'url' => $img['url'] ?? '',
                        'title' => $img['title'] ?? '',
                        'description' => $img['description'] ?? ''
                    ];
                } else {
                    // Backwards compatibility for old string-only images
                    $formattedExisting[] = [
                        'url' => $img,
                        'title' => '',
                        'description' => ''
                    ];
                }
            }
        }

        $data['images'] = array_merge($formattedExisting, $uploadedImages);

        $province->update($data);

        return redirect()->route('admin.home.edit', ['tab' => 'stats'])->with('success', 'Data provinsi berhasil diperbarui!');
    }
}
