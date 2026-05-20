<?php

namespace App\Http\Controllers;

use App\Models\AnnualReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnualReportController extends Controller
{
    public function index()
    {
        $reports = AnnualReport::orderBy('year', 'desc')->get();
        return view('admin.tata-kelola.annual-report.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.tata-kelola.annual-report.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'title' => 'required',
            'image' => 'nullable|image|max:2048',
            'image2' => 'nullable|image|max:2048',
            'image3' => 'nullable|image|max:2048',
            'file' => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = $request->except(['image', 'image2', 'image3', 'file']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('annual_reports', 'nextjs_public');
            $data['image'] = Storage::disk('nextjs_public')->url($path);
        }
        if ($request->hasFile('image2')) {
            $path = $request->file('image2')->store('annual_reports', 'nextjs_public');
            $data['image2'] = Storage::disk('nextjs_public')->url($path);
        }
        if ($request->hasFile('image3')) {
            $path = $request->file('image3')->store('annual_reports', 'nextjs_public');
            $data['image3'] = Storage::disk('nextjs_public')->url($path);
        }

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('annual_reports', 'nextjs_public');
            $data['file'] = Storage::disk('nextjs_public')->url($path);
        }

        AnnualReport::create($data);

        return redirect()->route('admin.tata-kelola.annual-report.index')->with('success', 'Annual Report created successfully.');
    }

    public function edit(AnnualReport $annualReport)
    {
        return view('admin.tata-kelola.annual-report.edit', compact('annualReport'));
    }

    public function update(Request $request, AnnualReport $annualReport)
    {
        $request->validate([
            'year' => 'required',
            'title' => 'required',
            'image' => 'nullable|image|max:2048',
            'image2' => 'nullable|image|max:2048',
            'image3' => 'nullable|image|max:2048',
            'file' => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = $request->except(['image', 'image2', 'image3', 'file']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('annual_reports', 'nextjs_public');
            $data['image'] = Storage::disk('nextjs_public')->url($path);
        } elseif ($request->has('remove_image_1')) {
            $data['image'] = null;
        }

        if ($request->hasFile('image2')) {
            $path = $request->file('image2')->store('annual_reports', 'nextjs_public');
            $data['image2'] = Storage::disk('nextjs_public')->url($path);
        } elseif ($request->has('remove_image_2')) {
            $data['image2'] = null;
        }

        if ($request->hasFile('image3')) {
            $path = $request->file('image3')->store('annual_reports', 'nextjs_public');
            $data['image3'] = Storage::disk('nextjs_public')->url($path);
        } elseif ($request->has('remove_image_3')) {
            $data['image3'] = null;
        }

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('annual_reports', 'nextjs_public');
            $data['file'] = Storage::disk('nextjs_public')->url($path);
        } elseif ($request->has('remove_file')) {
            $data['file'] = null;
        }

        $annualReport->update($data);

        return redirect()->route('admin.tata-kelola.annual-report.index')->with('success', 'Annual Report updated successfully.');
    }

    public function destroy(AnnualReport $annualReport)
    {
        // We don't necessarily need to delete from nextjs_public to prevent breaking if other things link to it,
        // but if we want to, we could extract the path from the URL. For simplicity, just delete DB record.
        $annualReport->delete();

        return redirect()->route('admin.tata-kelola.annual-report.index')->with('success', 'Annual Report deleted successfully.');
    }

    public function apiIndex()
    {
        $reports = AnnualReport::orderBy('year', 'desc')->get()->map(function($report) {
            $report->image_url = $report->image; // already a valid URL
            $report->image2_url = $report->image2; // already a valid URL
            $report->image3_url = $report->image3; // already a valid URL
            $report->file_url = $report->file; // already a valid URL
            return $report;
        });
        return response()->json($reports);
    }
}
