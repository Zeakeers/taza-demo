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

        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $path = $file->store('provinces', 'public');
                $uploadedImages[] = Storage::url($path);
            }
        }

        $data['images'] = array_merge($existingImages, $uploadedImages);

        $province->update($data);

        return redirect()->route('admin.home.edit', ['tab' => 'stats'])->with('success', 'Data provinsi berhasil diperbarui!');
    }
}
