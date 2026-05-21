<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // API Routes untuk Frontend Next.js
    public function apiIndex()
    {
        $beritas = Berita::with('user:id,name')->where('is_published', true)->orderBy('created_at', 'desc')->get();
        return response()->json($beritas);
    }

    public function apiHome()
    {
        $beritas = Berita::with('user:id,name')->where('is_published', true)
            ->where('show_on_home', true)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($beritas);
    }

    public function apiShow($slug)
    {
        $berita = Berita::with('user:id,name')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        return response()->json($berita);
    }

    public function apiRelated($slug)
    {
        $current = Berita::where('slug', $slug)->firstOrFail();
        
        $related = collect();
        $limit = 2; 

        // 1. By Tags
        if ($current->tags) {
            $tags = array_map('trim', explode(',', $current->tags));
            $query = Berita::where('is_published', true)->where('id', '!=', $current->id);
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
            $byCategory = Berita::where('is_published', true)
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
            $random = Berita::where('is_published', true)
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
        $query = Berita::query();

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

        $beritas = $query->latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
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
            'is_popular' => 'boolean',
            'tags' => 'nullable|string',
        ]);

        $data = $request->except('thumbnail');
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($request->judul) . '-' . time();
        $data['is_published'] = $request->has('is_published') ? true : false;
        $data['show_on_home'] = $request->has('show_on_home') ? true : false;
        $data['is_popular'] = $request->has('is_popular') ? true : false;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $beritum)
    {

        $berita = $beritum;
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $beritum)
    {
        $berita = $beritum;
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'konten' => 'required',
            'is_published' => 'boolean',
            'show_on_home' => 'boolean',
            'is_popular' => 'boolean',
            'tags' => 'nullable|string',
        ]);

        $data = $request->except('thumbnail');
        if ($request->judul != $berita->judul) {
            $data['slug'] = Str::slug($request->judul) . '-' . time();
        }
        $data['is_published'] = $request->has('is_published') ? true : false;
        $data['show_on_home'] = $request->has('show_on_home') ? true : false;
        $data['is_popular'] = $request->has('is_popular') ? true : false;

        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail) {
                Storage::disk('public')->delete($berita->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $beritum)
    {
        $berita = $beritum;
        if ($berita->thumbnail) {
            Storage::disk('public')->delete($berita->thumbnail);
        }
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function toggleHome(Berita $berita)
    {
        $berita->update(['show_on_home' => !$berita->show_on_home]);
        $status = $berita->show_on_home ? 'ditampilkan di' : 'disembunyikan dari';
        return redirect()->back()->with('success', "Berita berhasil {$status} halaman Home.");
    }

    public function togglePublish(Berita $berita)
    {
        $berita->update(['is_published' => !$berita->is_published]);
        $status = $berita->is_published ? 'dipublikasikan' : 'di-draft';
        return redirect()->back()->with('success', "Berita berhasil {$status}.");
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->storeAs('berita/images', $fileName, 'public');

            $url = asset('storage/berita/images/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
        return response()->json(['error' => ['message' => 'No file uploaded']]);
    }
}
