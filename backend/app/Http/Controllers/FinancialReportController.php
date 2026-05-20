<?php

namespace App\Http\Controllers;

use App\Models\FinancialReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FinancialReportController extends Controller
{
    public function index()
    {
        $reports = FinancialReport::orderBy('year', 'desc')->get();
        return view('admin.tata-kelola.financial-report.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.tata-kelola.financial-report.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'title' => 'required',
            'file' => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = $request->except(['file']);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('financial_reports', 'nextjs_public');
            $data['file'] = Storage::disk('nextjs_public')->url($path);
        }

        FinancialReport::create($data);

        return redirect()->route('admin.tata-kelola.financial-report.index')->with('success', 'Financial Report created successfully.');
    }

    public function edit(FinancialReport $financialReport)
    {
        return view('admin.tata-kelola.financial-report.edit', compact('financialReport'));
    }

    public function update(Request $request, FinancialReport $financialReport)
    {
        $request->validate([
            'year' => 'required',
            'title' => 'required',
            'file' => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = $request->except(['file']);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('financial_reports', 'nextjs_public');
            $data['file'] = Storage::disk('nextjs_public')->url($path);
        } elseif ($request->has('remove_file')) {
            $data['file'] = null;
        }

        $financialReport->update($data);

        return redirect()->route('admin.tata-kelola.financial-report.index')->with('success', 'Financial Report updated successfully.');
    }

    public function destroy(FinancialReport $financialReport)
    {
        $financialReport->delete();

        return redirect()->route('admin.tata-kelola.financial-report.index')->with('success', 'Financial Report deleted successfully.');
    }

    public function apiIndex()
    {
        $reports = FinancialReport::orderBy('year', 'desc')->get()->map(function($report) {
            $report->file_url = $report->file; // already a valid URL from nextjs_public
            return $report;
        });
        return response()->json($reports);
    }
}
