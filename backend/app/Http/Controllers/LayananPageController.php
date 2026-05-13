<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananPageController extends Controller
{
    /**
     * Edit QR Code Donasi page.
     */
    public function editQrCode()
    {
        $qrcode = PageContent::where('page_name', 'layanan')->where('section_name', 'qrcode')->first();

        return view('admin.layanan-pages.qrcode', compact('qrcode'));
    }

    /**
     * Update QR Code Donasi page.
     */
    public function updateQrCode(Request $request)
    {
        $content = $request->input('content', []);

        // Handle QR image upload
        if ($request->hasFile('qr_image')) {
            $file = $request->file('qr_image');
            if ($file->isValid()) {
                $path = $file->store('layanan', 'nextjs_public');
                $content['qr_image'] = Storage::disk('nextjs_public')->url($path);
            }
        } elseif ($request->input('remove_qr_image') === '1') {
            $content['qr_image'] = '';
        } else {
            $content['qr_image'] = $request->input('existing_qr_image', '');
        }

        PageContent::updateOrCreate(
            ['page_name' => 'layanan', 'section_name' => 'qrcode'],
            ['content' => $content]
        );

        return back()->with('success', 'Halaman QR Code Donasi berhasil diperbarui!');
    }

    /**
     * Edit Kantor Pelayanan page.
     */
    public function editKantor()
    {
        $kantor = PageContent::where('page_name', 'layanan')->where('section_name', 'kantor')->first();

        return view('admin.layanan-pages.kantor', compact('kantor'));
    }

    /**
     * Update Kantor Pelayanan page.
     */
    public function updateKantor(Request $request)
    {
        $content = $request->input('content', []);

        // Clean up header section
        $headerData = [
            'title' => $content['header']['title'] ?? 'Kantor Layanan',
            'description' => $content['header']['description'] ?? '',
        ];

        // Clean up offices
        $offices = [];
        if (isset($content['offices']) && is_array($content['offices'])) {
            foreach ($content['offices'] as $office) {
                if (!empty($office['name'])) {
                    $offices[] = [
                        'name' => $office['name'] ?? '',
                        'address' => $office['address'] ?? '',
                        'phone' => $office['phone'] ?? '',
                        'email' => $office['email'] ?? '',
                        'whatsapp' => $office['whatsapp'] ?? '',
                        'map_embed' => $office['map_embed'] ?? '',
                    ];
                }
            }
        }

        $finalContent = [
            'header' => $headerData,
            'offices' => $offices,
        ];

        PageContent::updateOrCreate(
            ['page_name' => 'layanan', 'section_name' => 'kantor'],
            ['content' => $finalContent]
        );

        return back()->with('success', 'Halaman Kantor Pelayanan berhasil diperbarui!');
    }

    /**
     * Edit FAQ page.
     */
    public function editFaq()
    {
        $faq = PageContent::where('page_name', 'layanan')->where('section_name', 'faq')->first();

        return view('admin.layanan-pages.faq', compact('faq'));
    }

    /**
     * Update FAQ page.
     */
    public function updateFaq(Request $request)
    {
        $content = $request->input('content', []);

        // Clean up header
        $headerData = [
            'title' => $content['header']['title'] ?? '',
            'search_placeholder' => $content['header']['search_placeholder'] ?? '',
        ];

        // Clean up FAQ items
        $items = [];
        if (isset($content['items']) && is_array($content['items'])) {
            foreach ($content['items'] as $item) {
                if (!empty($item['question'])) {
                    $items[] = [
                        'question' => $item['question'] ?? '',
                        'answer' => $item['answer'] ?? '',
                    ];
                }
            }
        }

        // Clean up popular topics
        $topics = [];
        if (isset($content['topics']) && is_array($content['topics'])) {
            foreach ($content['topics'] as $topic) {
                if (!empty($topic)) {
                    $topics[] = $topic;
                }
            }
        }

        $finalContent = [
            'header' => $headerData,
            'items' => $items,
            'topics' => $topics,
        ];

        PageContent::updateOrCreate(
            ['page_name' => 'layanan', 'section_name' => 'faq'],
            ['content' => $finalContent]
        );

        return back()->with('success', 'Halaman FAQ berhasil diperbarui!');
    }

    /**
     * Edit Hitung Zakat page.
     */
    public function editHitungZakat()
    {
        $hitungZakat = PageContent::where('page_name', 'layanan')->where('section_name', 'hitung_zakat')->first();

        return view('admin.layanan-pages.hitung-zakat', compact('hitungZakat'));
    }

    /**
     * Update Hitung Zakat page.
     */
    public function updateHitungZakat(Request $request)
    {
        $content = $request->input('content', []);

        PageContent::updateOrCreate(
            ['page_name' => 'layanan', 'section_name' => 'hitung_zakat'],
            ['content' => $content]
        );

        return back()->with('success', 'Halaman Hitung Zakat berhasil diperbarui!');
    }
}
