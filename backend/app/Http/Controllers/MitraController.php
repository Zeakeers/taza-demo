<?php

namespace App\Http\Controllers;

use App\Models\MitraSection;
use App\Models\MitraLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MitraController extends Controller
{
    public function index()
    {
        $sections = MitraSection::with('logos')->orderBy('order')->get();
        return view('admin.mitra.index', compact('sections'));
    }

    // --- Section CRUD ---

    public function storeSection(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        MitraSection::create([
            'name' => $request->name,
            'order' => MitraSection::count() + 1
        ]);
        return back()->with('success', 'Section mitra berhasil ditambahkan.');
    }

    public function updateSection(Request $request, MitraSection $section)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $section->update(['name' => $request->name]);
        return back()->with('success', 'Section mitra berhasil diperbarui.');
    }

    public function destroySection(MitraSection $section)
    {
        // Delete all logos in this section from storage
        foreach ($section->logos as $logo) {
            if ($logo->logo && Storage::disk('nextjs_public')->exists($logo->logo)) {
                Storage::disk('nextjs_public')->delete($logo->logo);
            }
        }
        $section->delete();
        return back()->with('success', 'Section mitra berhasil dihapus.');
    }

    // --- Logo CRUD ---

    public function storeLogo(Request $request)
    {
        $request->validate([
            'mitra_section_id' => 'required|exists:mitra_sections,id',
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $file = $request->file('logo');
        $path = $file->store('mitra', 'nextjs_public');

        MitraLogo::create([
            'mitra_section_id' => $request->mitra_section_id,
            'name' => $request->name,
            'logo' => $path,
            'order' => MitraLogo::where('mitra_section_id', $request->mitra_section_id)->count() + 1
        ]);

        return back()->with('success', 'Logo mitra berhasil ditambahkan.');
    }

    public function updateLogo(Request $request, MitraLogo $logo)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('logo')) {
            // Delete old file
            if ($logo->logo && Storage::disk('nextjs_public')->exists($logo->logo)) {
                Storage::disk('nextjs_public')->delete($logo->logo);
            }
            $file = $request->file('logo');
            $data['logo'] = $file->store('mitra', 'nextjs_public');
        }

        $logo->update($data);

        return back()->with('success', 'Logo mitra berhasil diperbarui.');
    }

    public function destroyLogo(MitraLogo $logo)
    {
        if ($logo->logo && Storage::disk('nextjs_public')->exists($logo->logo)) {
            Storage::disk('nextjs_public')->delete($logo->logo);
        }
        $logo->delete();
        return back()->with('success', 'Logo mitra berhasil dihapus.');
    }

    public function updateOrder(Request $request)
    {
        $type = $request->input('type');
        $orders = $request->input('orders');

        if ($type === 'section') {
            foreach ($orders as $order) {
                MitraSection::where('id', $order['id'])->update(['order' => $order['order']]);
            }
        } elseif ($type === 'logo') {
            foreach ($orders as $order) {
                MitraLogo::where('id', $order['id'])->update(['order' => $order['order']]);
            }
        }

        return response()->json(['success' => true]);
    }

    // --- API for Frontend ---

    public function apiIndex()
    {
        $sections = MitraSection::with('logos')->orderBy('order')->get();

        return response()->json([
            'sections' => $sections->map(function ($section) {
                return [
                    'id' => $section->id,
                    'name' => $section->name,
                    'logos' => $section->logos->map(function ($logo) {
                        return [
                            'id' => $logo->id,
                            'name' => $logo->name,
                            'logo' => '/uploads/' . $logo->logo,
                        ];
                    })
                ];
            })
        ]);
    }
}
