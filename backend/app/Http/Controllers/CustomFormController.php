<?php

namespace App\Http\Controllers;

use App\Models\CustomForm;
use App\Models\CustomFormField;
use App\Models\CustomFormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CustomFormController extends Controller
{
    /**
     * Display the main custom forms dashboard.
     */
    public function index(Request $request)
    {
        $forms = CustomForm::withCount('submissions')
            ->latest()
            ->get();

        // Get search/filter parameters for submissions view
        $selectedFormId = $request->input('form_id');
        $searchName = $request->input('search');
        $searchDate = $request->input('date');

        $selectedForm = null;
        $submissions = collect();

        if ($selectedFormId) {
            $selectedForm = CustomForm::with('fields')
                ->where('id', $selectedFormId)
                ->first();

            if ($selectedForm) {
                $query = CustomFormSubmission::where('custom_form_id', $selectedFormId)
                    ->latest();

                if ($searchDate) {
                    $query->whereDate('created_at', $searchDate);
                }

                $submissions = $query->paginate(15)->appends($request->query());
            }
        }

        return view('admin.custom-forms.index', compact(
            'forms', 'selectedForm', 'submissions', 'searchName', 'searchDate', 'selectedFormId'
        ));
    }

    /**
     * Show the form builder page.
     */
    public function create()
    {
        return view('admin.custom-forms.create');
    }

    /**
     * Store a new custom form.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fields' => 'required|array|min:1',
            'fields.*.label' => 'required|string|max:255',
            'fields.*.type' => 'required|string|in:text,email,number,date,textarea,select,radio,checkbox,file',
            'fields.*.is_required' => 'nullable',
            'fields.*.options' => 'nullable|string',
        ]);

        $slug = Str::slug($request->title) . '-' . Str::random(6);

        // Ensure slug uniqueness
        while (CustomForm::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->title) . '-' . Str::random(6);
        }

        $form = CustomForm::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $slug,
            'created_by' => auth()->id(),
            'is_active' => true,
        ]);

        foreach ($request->fields as $index => $fieldData) {
            $options = null;
            if (!empty($fieldData['options'])) {
                $options = array_map('trim', explode(',', $fieldData['options']));
            }

            CustomFormField::create([
                'custom_form_id' => $form->id,
                'label' => $fieldData['label'],
                'type' => $fieldData['type'],
                'options' => $options,
                'is_required' => isset($fieldData['is_required']),
                'sort_order' => $index,
            ]);
        }

        return redirect()->route('admin.custom-forms.index')
            ->with('success', 'Form "' . $form->title . '" berhasil dibuat!');
    }

    /**
     * Show the form edit page.
     */
    public function edit(CustomForm $customForm)
    {

        $customForm->load('fields');
        return view('admin.custom-forms.edit', compact('customForm'));
    }

    /**
     * Update an existing custom form.
     */
    public function update(Request $request, CustomForm $customForm)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fields' => 'required|array|min:1',
            'fields.*.label' => 'required|string|max:255',
            'fields.*.type' => 'required|string|in:text,email,number,date,textarea,select,radio,checkbox,file',
            'fields.*.is_required' => 'nullable',
            'fields.*.options' => 'nullable|string',
        ]);

        $customForm->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Delete existing fields and recreate
        $customForm->fields()->delete();

        foreach ($request->fields as $index => $fieldData) {
            $options = null;
            if (!empty($fieldData['options'])) {
                $options = array_map('trim', explode(',', $fieldData['options']));
            }

            CustomFormField::create([
                'custom_form_id' => $customForm->id,
                'label' => $fieldData['label'],
                'type' => $fieldData['type'],
                'options' => $options,
                'is_required' => isset($fieldData['is_required']),
                'sort_order' => $index,
            ]);
        }

        return redirect()->route('admin.custom-forms.index')
            ->with('success', 'Form "' . $customForm->title . '" berhasil diperbarui!');
    }

    /**
     * Toggle form active status.
     */
    public function toggleStatus(CustomForm $customForm)
    {

        $customForm->update(['is_active' => !$customForm->is_active]);

        $status = $customForm->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', 'Form "' . $customForm->title . '" berhasil ' . $status . '.');
    }

    /**
     * Delete a custom form.
     */
    public function destroy(CustomForm $customForm)
    {

        $title = $customForm->title;
        $customForm->delete();

        return redirect()->route('admin.custom-forms.index')
            ->with('success', 'Form "' . $title . '" berhasil dihapus.');
    }

    /**
     * Export submissions as CSV.
     */
    public function exportCsv(CustomForm $customForm)
    {

        $customForm->load('fields', 'submissions');

        $headers = ['No', 'Tanggal'];
        foreach ($customForm->fields as $field) {
            $headers[] = $field->label;
        }

        $rows = [];
        foreach ($customForm->submissions as $index => $submission) {
            $row = [$index + 1, $submission->created_at->format('d/m/Y H:i')];
            foreach ($customForm->fields as $field) {
                $value = $submission->data[$field->label] ?? '';
                if (is_array($value)) {
                    $value = implode(', ', $value);
                }
                $row[] = $value;
            }
            $rows[] = $row;
        }

        $filename = Str::slug($customForm->title) . '_data_' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($headers, $rows) {
            $file = fopen('php://output', 'w');
            // UTF-8 BOM for Excel
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, $headers);
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    // ========================================
    // PUBLIC FORM ROUTES (No auth required)
    // ========================================

    /**
     * Show the public form page.
     */
    public function showPublicForm(string $slug)
    {
        $form = CustomForm::with('fields')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.custom-form', compact('form'));
    }

    /**
     * Handle public form submission.
     */
    public function submitPublicForm(Request $request, string $slug)
    {
        $form = CustomForm::with('fields')
            ->where('slug', $slug)
            ->firstOrFail();

        if (!$form->is_active) {
            abort(403, 'Mohon maaf, formulir ini sudah ditutup.');
        }

        // Build validation rules dynamically
        $rules = [];
        foreach ($form->fields as $field) {
            $fieldKey = 'field_' . $field->id;
            $fieldRules = [];

            if ($field->is_required) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }

            switch ($field->type) {
                case 'email':
                    $fieldRules[] = 'email';
                    break;
                case 'number':
                    $fieldRules[] = 'numeric';
                    break;
                case 'file':
                    $fieldRules[] = 'file';
                    $fieldRules[] = 'max:2048';
                    break;
                case 'checkbox':
                    $fieldRules = [$field->is_required ? 'required' : 'nullable', 'array'];
                    break;
            }

            $rules[$fieldKey] = $fieldRules;
        }

        $request->validate($rules);

        // Collect submission data
        $data = [];
        foreach ($form->fields as $field) {
            $fieldKey = 'field_' . $field->id;

            if ($field->type === 'file' && $request->hasFile($fieldKey)) {
                $path = $request->file($fieldKey)->store('form_uploads', 'nextjs_public');
                $data[$field->label] = Storage::disk('nextjs_public')->url($path);
            } elseif ($field->type === 'checkbox') {
                $data[$field->label] = $request->input($fieldKey, []);
            } else {
                $data[$field->label] = $request->input($fieldKey, '');
            }
        }

        CustomFormSubmission::create([
            'custom_form_id' => $form->id,
            'data' => $data,
        ]);

        return back()->with('success', 'Terima kasih! Data Anda berhasil dikirim.');
    }

    /**
     * Delete an individual submission.
     */
    public function destroySubmission(CustomFormSubmission $submission)
    {
        $form = $submission->form;
        if ($form->created_by !== auth()->id() && auth()->user()->role !== 'dev') {
            abort(403);
        }

        $submission->delete();

        return back()->with('success', 'Data respons berhasil dihapus.');
    }

    /**
     * Update an individual submission's data.
     */
    public function updateSubmission(Request $request, CustomFormSubmission $submission)
    {
        $form = $submission->form;
        if ($form->created_by !== auth()->id() && auth()->user()->role !== 'dev') {
            abort(403);
        }

        $data = $request->input('data', []);
        $submission->update(['data' => $data]);

        return back()->with('success', 'Data respons berhasil diperbarui.');
    }
}
