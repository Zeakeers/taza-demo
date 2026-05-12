<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    private function getConfig()
    {
        return [
            'dakwah' => [
                'title' => 'Program Dakwah',
                'sections' => [
                    'hero' => [
                        'label' => 'Bagian Hero',
                        'fields' => [
                            ['name' => 'hero_title', 'type' => 'text', 'label' => 'Judul Hero'],
                            ['name' => 'hero_image', 'type' => 'image', 'label' => 'Background Hero']
                        ]
                    ],
                    'slider_banner' => [
                        'label' => 'Banner Slider Hitam',
                        'fields' => [
                            ['name' => 'slider_title', 'type' => 'text', 'label' => 'Judul Atas Banner'],
                            ['name' => 'slider_subtitle', 'type' => 'text', 'label' => 'Teks Bawah Banner']
                        ]
                    ],
                    'programs' => [
                        'label' => 'Daftar Program Dakwah',
                        'is_repeater' => true,
                        'repeater_name' => 'programs',
                        'repeater_fields' => [
                            ['name' => 'title', 'type' => 'text', 'label' => 'Nama Program'],
                            ['name' => 'image', 'type' => 'image', 'label' => 'Gambar Program'],
                            ['name' => 'description', 'type' => 'textarea', 'label' => 'Deskripsi Program']
                        ]
                    ],
                    'collage' => [
                        'label' => 'Bagian Kolase (Dari Amanah Menjadi Manfaat)',
                        'fields' => [
                            ['name' => 'collage_title', 'type' => 'text', 'label' => 'Judul Kolase'],
                            ['name' => 'collage_desc', 'type' => 'textarea', 'label' => 'Deskripsi Kolase'],
                            ['name' => 'collage_images', 'type' => 'multiple_images', 'label' => 'Gambar Kolase']
                        ]
                    ]
                ]
            ],
            'ekonomi' => [
                'title' => 'Program Ekonomi',
                'sections' => [
                    'hero' => [
                        'label' => 'Bagian Hero',
                        'fields' => [
                            ['name' => 'hero_title', 'type' => 'text', 'label' => 'Judul Hero'],
                            ['name' => 'hero_image', 'type' => 'image', 'label' => 'Background Hero']
                        ]
                    ],
                    'intro' => [
                        'label' => 'Bagian Intro Program',
                        'fields' => [
                            ['name' => 'intro_title', 'type' => 'text', 'label' => 'Judul Intro'],
                            ['name' => 'intro_desc', 'type' => 'textarea', 'label' => 'Deskripsi Intro'],
                            ['name' => 'intro_image', 'type' => 'image', 'label' => 'Gambar Intro']
                        ]
                    ],
                    'programs' => [
                        'label' => 'Daftar Program Ekonomi',
                        'is_repeater' => true,
                        'repeater_name' => 'programs',
                        'repeater_fields' => [
                            ['name' => 'title', 'type' => 'text', 'label' => 'Nama Program'],
                            ['name' => 'image', 'type' => 'image', 'label' => 'Gambar Program'],
                            ['name' => 'description', 'type' => 'textarea', 'label' => 'Deskripsi Program']
                        ]
                    ],
                    'collage' => [
                        'label' => 'Bagian Kolase (Dari Amanah Menjadi Manfaat)',
                        'fields' => [
                            ['name' => 'collage_title', 'type' => 'text', 'label' => 'Judul Kolase'],
                            ['name' => 'collage_desc', 'type' => 'textarea', 'label' => 'Deskripsi Kolase'],
                            ['name' => 'collage_images', 'type' => 'multiple_images', 'label' => 'Gambar Kolase']
                        ]
                    ],
                    'sedekah_beras' => [
                        'label' => 'Bagian Sedekah Beras Dhuafa',
                        'fields' => [
                            ['name' => 'sedekah_title', 'type' => 'text', 'label' => 'Judul Sedekah Beras'],
                            ['name' => 'sedekah_desc', 'type' => 'textarea', 'label' => 'Deskripsi Sedekah Beras'],
                            ['name' => 'sedekah_image', 'type' => 'image', 'label' => 'Gambar Sedekah Beras']
                        ]
                    ]
                ]
            ],
            'kemanusiaan' => [
                'title' => 'Program Kemanusiaan',
                'sections' => [
                    'hero' => [
                        'label' => 'Bagian Hero',
                        'fields' => [
                            ['name' => 'hero_title', 'type' => 'text', 'label' => 'Judul Hero'],
                            ['name' => 'hero_image', 'type' => 'image', 'label' => 'Background Hero']
                        ]
                    ],
                    'slider_banner' => [
                        'label' => 'Banner Slider Hitam',
                        'fields' => [
                            ['name' => 'slider_title', 'type' => 'text', 'label' => 'Judul Atas Banner'],
                            ['name' => 'slider_subtitle', 'type' => 'text', 'label' => 'Teks Bawah Banner']
                        ]
                    ],
                    'programs' => [
                        'label' => 'Daftar Program Kemanusiaan',
                        'is_repeater' => true,
                        'repeater_name' => 'programs',
                        'repeater_fields' => [
                            ['name' => 'title', 'type' => 'text', 'label' => 'Nama Program'],
                            ['name' => 'image', 'type' => 'image', 'label' => 'Gambar Program'],
                            ['name' => 'description', 'type' => 'textarea', 'label' => 'Deskripsi Program']
                        ]
                    ],
                    'collage' => [
                        'label' => 'Bagian Kolase (Dari Amanah Menjadi Manfaat)',
                        'fields' => [
                            ['name' => 'collage_title', 'type' => 'text', 'label' => 'Judul Kolase'],
                            ['name' => 'collage_desc', 'type' => 'textarea', 'label' => 'Deskripsi Kolase'],
                            ['name' => 'collage_images', 'type' => 'multiple_images', 'label' => 'Gambar Kolase']
                        ]
                    ]
                ]
            ],
            'kesehatan' => [
                'title' => 'Program Kesehatan',
                'sections' => [
                    'hero' => [
                        'label' => 'Bagian Hero',
                        'fields' => [
                            ['name' => 'hero_title', 'type' => 'text', 'label' => 'Judul Hero'],
                            ['name' => 'hero_image', 'type' => 'image', 'label' => 'Background Hero']
                        ]
                    ],
                    'intro' => [
                        'label' => 'Bagian Intro Program',
                        'fields' => [
                            ['name' => 'intro_title', 'type' => 'text', 'label' => 'Judul Intro'],
                            ['name' => 'intro_desc', 'type' => 'textarea', 'label' => 'Deskripsi Intro'],
                            ['name' => 'intro_image', 'type' => 'image', 'label' => 'Gambar Intro']
                        ]
                    ],
                    'programs' => [
                        'label' => 'Daftar Program Kesehatan',
                        'is_repeater' => true,
                        'repeater_name' => 'programs',
                        'repeater_fields' => [
                            ['name' => 'title', 'type' => 'text', 'label' => 'Nama Program'],
                            ['name' => 'image', 'type' => 'image', 'label' => 'Gambar Program'],
                            ['name' => 'description', 'type' => 'textarea', 'label' => 'Deskripsi Program']
                        ]
                    ]
                ]
            ],
            'pendidikan' => [
                'title' => 'Program Pendidikan',
                'sections' => [
                    'hero' => [
                        'label' => 'Bagian Hero',
                        'fields' => [
                            ['name' => 'hero_title', 'type' => 'text', 'label' => 'Judul Hero'],
                            ['name' => 'hero_image', 'type' => 'image', 'label' => 'Background Hero']
                        ]
                    ],
                    'slider_banner' => [
                        'label' => 'Banner Slider Hitam',
                        'fields' => [
                            ['name' => 'slider_title', 'type' => 'text', 'label' => 'Judul Atas Banner'],
                            ['name' => 'slider_subtitle', 'type' => 'text', 'label' => 'Teks Bawah Banner']
                        ]
                    ],
                    'programs' => [
                        'label' => 'Daftar Program Pendidikan',
                        'is_repeater' => true,
                        'repeater_name' => 'programs',
                        'repeater_fields' => [
                            ['name' => 'title', 'type' => 'text', 'label' => 'Nama Program'],
                            ['name' => 'image', 'type' => 'image', 'label' => 'Gambar Program'],
                            ['name' => 'description', 'type' => 'textarea', 'label' => 'Deskripsi Program']
                        ]
                    ],
                    'collage' => [
                        'label' => 'Bagian Kolase (Dari Amanah Menjadi Manfaat)',
                        'fields' => [
                            ['name' => 'collage_title', 'type' => 'text', 'label' => 'Judul Kolase'],
                            ['name' => 'collage_desc', 'type' => 'textarea', 'label' => 'Deskripsi Kolase'],
                            ['name' => 'collage_images', 'type' => 'multiple_images', 'label' => 'Gambar Kolase']
                        ]
                    ]
                ]
            ]
        ];
    }

    public function edit($program)
    {
        $configs = $this->getConfig();
        if (!isset($configs[$program])) {
            abort(404);
        }

        $config = $configs[$program];
        $contentRecord = PageContent::where('page_name', 'program_' . $program)
            ->where('section_name', 'content')
            ->first();

        $data = [];
        if ($contentRecord) {
            $data = is_array($contentRecord->content) ? $contentRecord->content : json_decode($contentRecord->content, true) ?? [];
        }

        return view('admin.programs.manage', compact('program', 'config', 'data'));
    }

    public function update(Request $request, $program)
    {
        $configs = $this->getConfig();
        if (!isset($configs[$program])) {
            abort(404);
        }
        
        $config = $configs[$program];
        $contentRecord = PageContent::firstOrCreate(
            ['page_name' => 'program_' . $program, 'section_name' => 'content'],
            ['content' => []]
        );
        $data = is_array($contentRecord->content) ? $contentRecord->content : json_decode($contentRecord->content, true) ?? [];

        foreach ($config['sections'] as $secKey => $section) {
            if (isset($section['is_repeater']) && $section['is_repeater']) {
                $repeaterName = $section['repeater_name'];
                $items = $request->input($repeaterName, []);
                $files = $request->file($repeaterName) ?? [];
                
                $parsedItems = [];
                // Sort by keys just in case
                ksort($items);
                
                foreach ($items as $index => $item) {
                    $parsedItem = [];
                    foreach ($section['repeater_fields'] as $field) {
                        $fName = $field['name'];
                        if ($field['type'] === 'image') {
                            if ($request->input("remove_{$repeaterName}_{$index}_{$fName}") == '1') {
                                $parsedItem[$fName] = '';
                            } elseif (isset($files[$index][$fName]) && $files[$index][$fName]->isValid()) {
                                $path = $files[$index][$fName]->store("page_contents/programs/{$program}", 'nextjs_public');
                                $parsedItem[$fName] = Storage::disk('nextjs_public')->url($path);
                            } else {
                                $parsedItem[$fName] = $request->input("existing_{$repeaterName}_{$index}_{$fName}", '');
                            }
                        } else {
                            $parsedItem[$fName] = $item[$fName] ?? '';
                        }
                    }
                    $parsedItems[] = $parsedItem;
                }
                $data[$repeaterName] = array_values($parsedItems); // re-index sequentially
            } else {
                foreach ($section['fields'] as $field) {
                    $fName = $field['name'];
                    if ($field['type'] === 'image') {
                        if ($request->input("remove_{$fName}") == '1') {
                            $data[$fName] = '';
                        } elseif ($request->hasFile($fName)) {
                            $path = $request->file($fName)->store("page_contents/programs/{$program}", 'nextjs_public');
                            $data[$fName] = Storage::disk('nextjs_public')->url($path);
                        } else {
                            $data[$fName] = $request->input("existing_{$fName}", $data[$fName] ?? '');
                        }
                    } elseif ($field['type'] === 'multiple_images') {
                        $existingArr = $request->input("existing_{$fName}", []);
                        if (!is_array($existingArr)) $existingArr = json_decode($existingArr, true) ?? [];
                        
                        $removals = $request->input("remove_{$fName}", []);
                        if (is_array($removals)) {
                            foreach ($removals as $remIdx => $val) {
                                if ($val == '1' && isset($existingArr[$remIdx])) {
                                    unset($existingArr[$remIdx]);
                                }
                            }
                        }
                        $existingArr = array_values($existingArr);
                        
                        if ($request->hasFile($fName)) {
                            foreach ($request->file($fName) as $file) {
                                if ($file->isValid()) {
                                    $path = $file->store("page_contents/programs/{$program}", 'nextjs_public');
                                    $existingArr[] = Storage::disk('nextjs_public')->url($path);
                                }
                            }
                        }
                        $data[$fName] = $existingArr;
                    } else {
                        $data[$fName] = $request->input($fName, $data[$fName] ?? '');
                    }
                }
            }
        }

        $contentRecord->content = $data;
        $contentRecord->save();

        return back()->with('success', 'Konten ' . $config['title'] . ' berhasil diperbarui!');
    }
}
