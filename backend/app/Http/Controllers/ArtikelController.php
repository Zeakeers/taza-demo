<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    // API Routes untuk Frontend Next.js
    public function apiIndex()
    {
        $artikels = Artikel::with('user:id,name')->where('is_published', true)->orderBy('created_at', 'desc')->get();
        return response()->json($artikels);
    }

    public function apiHome()
    {
        $artikels = Artikel::with('user:id,name')->where('is_published', true)
            ->where('show_on_home', true)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($artikels);
    }

    public function apiShow($slug)
    {
        $artikel = Artikel::with('user:id,name')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        return response()->json($artikel);
    }
    
    public function apiEditorChoice()
    {
        $artikel = Artikel::with('user:id,name')->where('is_published', true)
            ->where('is_editor_choice', true)
            ->first();
        return response()->json($artikel);
    }

    public function apiRelated($slug)
    {
        $current = Artikel::where('slug', $slug)->firstOrFail();
        
        $related = collect();
        $limit = 2; 

        // 1. By Tags
        if ($current->tags) {
            $tags = array_map('trim', explode(',', $current->tags));
            $query = Artikel::where('is_published', true)->where('id', '!=', $current->id);
            $query->where(function ($q) use ($tags) {
                foreach ($tags as $tag) {
                    $q->orWhere('tags', 'LIKE', '%' . $tag . '%');
                }
            });
            $related = $query->inRandomOrder()->take($limit)->get();
        }

        // 2. By Category
        if ($related->count() < $limit) {
            $needed = $limit - $related->count();
            $byCategory = Artikel::where('is_published', true)
                ->where('id', '!=', $current->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->where('kategori', $current->kategori)
                ->inRandomOrder()
                ->take($needed)
                ->get();
            $related = $related->merge($byCategory);
        }

        // 3. Random
        if ($related->count() < $limit) {
            $needed = $limit - $related->count();
            $random = Artikel::where('is_published', true)
                ->where('id', '!=', $current->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->inRandomOrder()
                ->take($needed)
                ->get();
            $related = $related->merge($random);
        }

        return response()->json($related);
    }

    // Admin Routes
    public function index(Request $request)
    {
        $query = Artikel::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
            });
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $artikels = $query->latest()->get();
        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'konten' => 'required',
            'is_published' => 'boolean',
            'show_on_home' => 'boolean',
            'is_editor_choice' => 'boolean',
            'tags' => 'nullable|string',
        ]);

        $data = $request->except('thumbnail');
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($request->judul) . '-' . time();
        $data['is_published'] = $request->has('is_published') ? true : false;
        $data['show_on_home'] = $request->has('show_on_home') ? true : false;
        $data['is_editor_choice'] = $request->has('is_editor_choice') ? true : false;

        if ($data['is_editor_choice']) {
            Artikel::where('is_editor_choice', true)->update(['is_editor_choice' => false]);
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('artikel', 'public');
        }

        Artikel::create($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'konten' => 'required',
            'is_published' => 'boolean',
            'show_on_home' => 'boolean',
            'is_editor_choice' => 'boolean',
            'tags' => 'nullable|string',
        ]);

        $data = $request->except('thumbnail');
        if ($request->judul != $artikel->judul) {
            $data['slug'] = Str::slug($request->judul) . '-' . time();
        }
        $data['is_published'] = $request->has('is_published') ? true : false;
        $data['show_on_home'] = $request->has('show_on_home') ? true : false;
        $data['is_editor_choice'] = $request->has('is_editor_choice') ? true : false;

        if ($data['is_editor_choice']) {
            Artikel::where('id', '!=', $artikel->id)->where('is_editor_choice', true)->update(['is_editor_choice' => false]);
        }

        if ($request->hasFile('thumbnail')) {
            if ($artikel->thumbnail) {
                Storage::disk('public')->delete($artikel->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('artikel', 'public');
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->thumbnail) {
            Storage::disk('public')->delete($artikel->thumbnail);
        }
        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function toggleHome(Artikel $artikel)
    {
        $artikel->update(['show_on_home' => !$artikel->show_on_home]);
        $status = $artikel->show_on_home ? 'ditampilkan di' : 'disembunyikan dari';
        return redirect()->back()->with('success', "Artikel berhasil {$status} halaman Home.");
    }

    public function togglePublish(Artikel $artikel)
    {
        $artikel->update(['is_published' => !$artikel->is_published]);
        $status = $artikel->is_published ? 'dipublikasikan' : 'di-draft';
        return redirect()->back()->with('success', "Artikel berhasil {$status}.");
    }

    public function toggleEditorChoice(Artikel $artikel)
    {
        $newValue = !$artikel->is_editor_choice;
        
        if ($newValue) {
            // Set all other to false first
            Artikel::where('is_editor_choice', true)->update(['is_editor_choice' => false]);
        }

        $artikel->update(['is_editor_choice' => $newValue]);
        $status = $newValue ? 'dijadikan Pilihan Editor' : 'dihapus dari Pilihan Editor';
        return redirect()->back()->with('success', "Artikel berhasil {$status}.");
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->storeAs('artikel/images', $fileName, 'public');

            $url = asset('storage/artikel/images/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
        return response()->json(['error' => ['message' => 'No file uploaded']]);
    }
}
