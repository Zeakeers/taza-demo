<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Models\PageContent;
use Illuminate\Support\Facades\Storage;
use App\Models\CustomForm;

class VolunteerController extends Controller
{
    // API Route untuk Next.js
    public function apiStore(Request $request)
    {
        // Define core fixed fields
        $coreFields = ['nama', 'no_hp', 'email', 'kontribusi', 'keterangan'];
        
        $data = $request->all();
        $coreData = [];
        $additionalData = [];
        
        foreach ($data as $key => $value) {
            if (in_array($key, $coreFields)) {
                $coreData[$key] = $value;
            } else {
                $additionalData[$key] = $value;
            }
        }
        
        // Ensure default fallbacks for required core fields if missing
        $coreData['nama'] = $coreData['nama'] ?? 'Guest';
        $coreData['no_hp'] = $coreData['no_hp'] ?? '-';
        $coreData['email'] = $coreData['email'] ?? 'guest@example.com';

        $coreData['additional_data'] = empty($additionalData) ? null : $additionalData;

        $volunteer = Volunteer::create($coreData);

        return response()->json([
            'message' => 'Pendaftaran volunteer berhasil dikirim',
            'data' => $volunteer
        ], 201);
    }

    // Admin Routes
    public function editPage()
    {
        $page = PageContent::where('page_name', 'volunteer')->where('section_name', 'main')->first();
        return view('admin.volunteer.page', compact('page'));
    }

    public function updatePage(Request $request)
    {
        $content = $request->input('content', []);

        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');
            if ($file->isValid()) {
                $path = $file->store('volunteer', 'nextjs_public');
                $content['hero_image'] = Storage::disk('nextjs_public')->url($path);
            }
        } elseif ($request->input('remove_hero_image') === '1') {
            $content['hero_image'] = '';
        } else {
            $content['hero_image'] = $request->input('existing_hero_image', '');
        }

        PageContent::updateOrCreate(
            ['page_name' => 'volunteer', 'section_name' => 'main'],
            ['content' => $content]
        );

        return back()->with('success', 'Halaman Volunteer berhasil diperbarui!');
    }

    public function index()
    {
        $volunteers = Volunteer::latest()->get();
        
        $page = PageContent::where('page_name', 'volunteer')->where('section_name', 'main')->first();
        $form_fields = $page->content['form_fields'] ?? [
            ['name' => 'nama', 'label' => 'Nama Lengkap'],
            ['name' => 'no_hp', 'label' => 'No WhatsApp'],
            ['name' => 'kontribusi', 'label' => 'Bidang Kontribusi']
        ];
        
        return view('admin.volunteer.index', compact('volunteers', 'form_fields'));
    }

    public function show(Volunteer $volunteer)
    {
        $page = PageContent::where('page_name', 'volunteer')->where('section_name', 'main')->first();
        $form_fields = $page->content['form_fields'] ?? [];
        return view('admin.volunteer.show', compact('volunteer', 'form_fields'));
    }

    public function edit(Volunteer $volunteer)
    {
        $page = PageContent::where('page_name', 'volunteer')->where('section_name', 'main')->first();
        $form_fields = $page->content['form_fields'] ?? [];
        return view('admin.volunteer.edit', compact('volunteer', 'form_fields'));
    }

    public function update(Request $request, Volunteer $volunteer)
    {
        $request->validate(['status' => 'required|in:pending,diterima,ditolak']);
        
        $coreFields = ['nama', 'no_hp', 'email', 'kontribusi', 'keterangan', 'status'];
        $data = $request->all();
        $coreData = [];
        $additionalData = [];
        
        foreach ($data as $key => $value) {
            if (in_array($key, $coreFields)) {
                $coreData[$key] = $value;
            } elseif ($key != '_token' && $key != '_method') {
                $additionalData[$key] = $value;
            }
        }
        
        $coreData['additional_data'] = empty($additionalData) ? null : $additionalData;

        $volunteer->update($coreData);

        return redirect()->route('admin.volunteer.index')->with('success', 'Data volunteer berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Volunteer $volunteer)
    {
        $request->validate(['status' => 'required|in:pending,diterima,ditolak']);
        $volunteer->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();
        return redirect()->route('admin.volunteer.index')->with('success', 'Data volunteer berhasil dihapus.');
    }
}
