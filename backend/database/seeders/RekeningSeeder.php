<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RekeningCategory;
use App\Models\RekeningBank;
use App\Models\PageContent;

class RekeningSeeder extends Seeder
{
    public function run(): void
    {
        // Initial Hero Content
        PageContent::updateOrCreate(
            ['page_name' => 'no-rekening', 'section_name' => 'hero'],
            ['content' => ['image' => '/images/gambardetaile/hero no rekening.svg']]
        );

        $sections = [
            [
                'title' => "Zakat",
                'accounts' => [
                    ['logo' => 'bank-negara-indonesia-(bni)-logo 2.svg', 'name' => "BNI", 'number' => "1900-9500-54"],
                    ['logo' => 'bank mandiri.svg', 'name' => "Mandiri", 'number' => "14100-750-750-10"],
                    ['logo' => 'bank-bsi-logo 1.svg', 'name' => "BSI", 'number' => "7900-9400-46"]
                ]
            ],
            [
                'title' => "Infaq",
                'accounts' => [
                    ['logo' => 'bank-central-asia-(bca)-logo 1.svg', 'name' => "BCA", 'number' => "271-909-5555"],
                    ['logo' => 'bank-rakyat-indonesia-(bri)-logo 1.svg', 'name' => "BRI", 'number' => "0211-0100-2263-302"],
                    ['logo' => 'bank-negara-indonesia-(bni)-logo 2.svg', 'name' => "BNI", 'number' => "0900950051"],
                    ['logo' => 'bank mandiri.svg', 'name' => "Mandiri", 'number' => "14100-750-750-02"],
                    ['logo' => 'bank-bsi-logo 1.svg', 'name' => "BSI", 'number' => "744-664-4003"]
                ]
            ],
            [
                'title' => "Jariyah",
                'accounts' => [
                    ['logo' => 'bank-bsi-logo 1.svg', 'name' => "BSI", 'number' => "7930-4482-90"]
                ]
            ]
        ];

        foreach ($sections as $catIdx => $sec) {
            $category = RekeningCategory::create([
                'name' => $sec['title'],
                'order' => $catIdx + 1
            ]);

            foreach ($sec['accounts'] as $bankIdx => $acc) {
                RekeningBank::create([
                    'rekening_category_id' => $category->id,
                    'bank_name' => $acc['name'],
                    'account_number' => $acc['number'],
                    'logo' => $acc['logo'],
                    'order' => $bankIdx + 1
                ]);
            }
        }
    }
}
