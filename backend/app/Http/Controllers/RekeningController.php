<?php

namespace App\Http\Controllers;

use App\Models\RekeningCategory;
use App\Models\RekeningBank;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RekeningController extends Controller
{
    public function index()
    {
        $hero = PageContent::where('page_name', 'no-rekening')->where('section_name', 'hero')->first();
        $categories = RekeningCategory::with('banks')->orderBy('order')->get();
        
        // List of bank logos from public/images/logo bank in Next.js
        // We can manually list them or try to read the directory
        $logos = [
            'bank-bsi-logo 1.svg',
            'bank mandiri.svg',
            'bank-central-asia-(bca)-logo 1.svg',
            'bank-negara-indonesia-(bni)-logo 2.svg',
            'bank-jatim-logo 1.svg',
            'bank-rakyat-indonesia-(bri)-logo 1.svg'
        ];

        return view('admin.rekening.index', compact('hero', 'categories', 'logos'));
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $content = [];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('rekening', 'nextjs_public');
            $content['image'] = Storage::disk('nextjs_public')->url($path);
        } else {
            $content['image'] = $request->input('existing_image');
        }

        PageContent::updateOrCreate(
            ['page_name' => 'no-rekening', 'section_name' => 'hero'],
            ['content' => $content]
        );

        return back()->with('success', 'Hero image updated successfully.');
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        RekeningCategory::create([
            'name' => $request->name,
            'order' => RekeningCategory::count() + 1
        ]);
        return back()->with('success', 'Category added successfully.');
    }

    public function updateCategory(Request $request, RekeningCategory $category)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category->update(['name' => $request->name]);
        return back()->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(RekeningCategory $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }

    public function storeBank(Request $request)
    {
        $request->validate([
            'rekening_category_id' => 'required|exists:rekening_categories,id',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'logo' => 'nullable|string',
        ]);

        RekeningBank::create([
            'rekening_category_id' => $request->rekening_category_id,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'logo' => $request->logo,
            'order' => RekeningBank::where('rekening_category_id', $request->rekening_category_id)->count() + 1
        ]);

        return back()->with('success', 'Bank account added successfully.');
    }

    public function updateBank(Request $request, RekeningBank $bank)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'logo' => 'nullable|string',
        ]);

        $bank->update([
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'logo' => $request->logo,
        ]);

        return back()->with('success', 'Bank account updated successfully.');
    }

    public function destroyBank(RekeningBank $bank)
    {
        $bank->delete();
        return back()->with('success', 'Bank account deleted successfully.');
    }

    public function updateOrder(Request $request)
    {
        $type = $request->input('type');
        $orders = $request->input('orders');

        if ($type === 'category') {
            foreach ($orders as $order) {
                RekeningCategory::where('id', $order['id'])->update(['order' => $order['order']]);
            }
        } elseif ($type === 'bank') {
            foreach ($orders as $order) {
                RekeningBank::where('id', $order['id'])->update(['order' => $order['order']]);
            }
        }

        return response()->json(['success' => true]);
    }

    // API for Frontend
    public function apiIndex()
    {
        $hero = PageContent::where('page_name', 'no-rekening')->where('section_name', 'hero')->first();
        $categories = RekeningCategory::with('banks')->orderBy('order')->get();
        
        return response()->json([
            'hero' => $hero ? $hero->content : null,
            'sections' => $categories->map(function($cat) {
                return [
                    'title' => $cat->name,
                    'accounts' => $cat->banks->map(function($bank) {
                        return [
                            'name' => $bank->bank_name,
                            'number' => $bank->account_number,
                            'logo' => $bank->logo ? '/images/logo bank/' . $bank->logo : null,
                            // Default width/height for common logos or we can just use object-contain
                            'width' => 140, 
                            'height' => 40
                        ];
                    })
                ];
            })
        ]);
    }
}
