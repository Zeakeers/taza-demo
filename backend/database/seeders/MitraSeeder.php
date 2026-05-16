<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MitraSection;
use App\Models\MitraLogo;
use Illuminate\Support\Facades\File;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        MitraLogo::truncate();
        MitraSection::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Section 1: Stakeholder Support & Partners
        $stakeholder = MitraSection::create([
            'name' => 'Stakeholder Support & Partners',
            'order' => 1,
        ]);

        $stakeholderLogos = [
            'AL-USWAH 1.png' => 'AL-USWAH',
            'Beras Super Tani OK (1)_page-0002 1.png' => 'Beras Super Tani',
            'Lambang_Bea_dan_Cukai.svg 1.png' => 'Bea dan Cukai',
            'POTENSI Logo OK color 1.png' => 'POTENSI',
            'RSQ-removebg-preview 1.png' => 'RSQ',
            'SIZ 1.png' => 'SIZ',
            'agrofarm 1.png' => 'Agrofarm',
            'ayo cerdas indo 1.png' => 'Ayo Cerdas Indo',
            'bisesa.png' => 'Bisesa',
            'bsi maslahat 1.png' => 'BSI Maslahat',
            'cropped-Logo-FLP-Web 1.png' => 'FLP',
            'eyelink-group-1024x389-1 1.png' => 'Eyelink Group',
            'genpro.png' => 'Genpro',
            'klinik mata 1.png' => 'Klinik Mata',
            'lawang 1.png' => 'Lawang',
            'lazia 1.png' => 'Lazia',
            'logo baba rafi 1.png' => 'Baba Rafi',
            'logobarudjp-removebg-preview 1.png' => 'DJP',
            'muslim 1.png' => 'Muslim',
            'nlc 1.png' => 'NLC',
            'nsb 1.png' => 'NSB',
            'oshilo 1.png' => 'Oshilo',
            'pasmira 1.png' => 'Pasmira',
            'pelindo 3 1.png' => 'Pelindo',
            'perindu surga 1.png' => 'Perindu Surga',
            'rs woyung 1.png' => 'RS Woyung',
            'shalahudin.png' => 'Shalahudin',
            'sier 1.png' => 'SIER',
            'sotokudus.png' => 'Soto Kudus',
            'wika beton 1.png' => 'Wika Beton',
            'ybm-logo2 1.png' => 'YBM',
            'young enter 1.png' => 'Young Enterprise',
            'zamzam.png' => 'Zamzam',
        ];

        $order = 1;
        $sourceDir = base_path('../public/images/Stakeholder Support & Partners');
        $destDir = base_path('../public/uploads/mitra');

        // Ensure destination directory exists
        if (!File::isDirectory($destDir)) {
            File::makeDirectory($destDir, 0755, true);
        }

        foreach ($stakeholderLogos as $filename => $name) {
            $sourcePath = $sourceDir . '/' . $filename;
            if (File::exists($sourcePath)) {
                // Copy file to uploads/mitra
                $newFilename = 'stakeholder_' . $order . '_' . str_replace(' ', '_', $filename);
                $destPath = $destDir . '/' . $newFilename;
                File::copy($sourcePath, $destPath);

                MitraLogo::create([
                    'mitra_section_id' => $stakeholder->id,
                    'name' => $name,
                    'logo' => 'mitra/' . $newFilename,
                    'order' => $order,
                ]);
                $order++;
            }
        }

        // Section 2: Media Partner
        $media = MitraSection::create([
            'name' => 'Media Partner',
            'order' => 2,
        ]);

        $mediaLogos = [
            'beritametro.png' => 'Berita Metro',
            'cropped-logo-1 1.png' => 'Cropped Logo',
            'inewsjatim.png' => 'iNews Jatim',
            'jatimnetwork.png' => 'Jatim Network',
            'jatimnow.png' => 'Jatim Now',
            'logo-lenteratoday 1.png' => 'Lentera Today',
            'logo_ant_jatim 1.png' => 'Antara Jatim',
            'suarasurabaya.png' => 'Suara Surabaya',
            'surabayanetwork.png' => 'Surabaya Network',
            'tribunjatim.png' => 'Tribun Jatim',
        ];

        $order = 1;
        $sourceDir = base_path('../public/images/Media Partner');

        foreach ($mediaLogos as $filename => $name) {
            $sourcePath = $sourceDir . '/' . $filename;
            if (File::exists($sourcePath)) {
                $newFilename = 'media_' . $order . '_' . str_replace(' ', '_', $filename);
                $destPath = $destDir . '/' . $newFilename;
                File::copy($sourcePath, $destPath);

                MitraLogo::create([
                    'mitra_section_id' => $media->id,
                    'name' => $name,
                    'logo' => 'mitra/' . $newFilename,
                    'order' => $order,
                ]);
                $order++;
            }
        }

        // Section 3: Mitra Payment
        $payment = MitraSection::create([
            'name' => 'Mitra Payment',
            'order' => 3,
        ]);

        $bankLogos = [
            'bank-negara-indonesia-(bni)-logo 2.svg' => 'BNI',
            'bank-rakyat-indonesia-(bri)-logo 1.svg' => 'BRI',
            'bank-central-asia-(bca)-logo 1.svg' => 'BCA',
            'bank-bsi-logo 1.svg' => 'BSI',
            'bank mandiri.svg' => 'Mandiri',
            'bank-jatim-logo 1.svg' => 'Bank Jatim',
        ];

        $order = 1;
        $sourceDir = base_path('../public/images/logo bank');

        foreach ($bankLogos as $filename => $name) {
            $sourcePath = $sourceDir . '/' . $filename;
            if (File::exists($sourcePath)) {
                $newFilename = 'bank_' . $order . '_' . str_replace(' ', '_', $filename);
                $destPath = $destDir . '/' . $newFilename;
                File::copy($sourcePath, $destPath);

                MitraLogo::create([
                    'mitra_section_id' => $payment->id,
                    'name' => $name,
                    'logo' => 'mitra/' . $newFilename,
                    'order' => $order,
                ]);
                $order++;
            }
        }

        $this->command->info('Mitra sections and logos seeded successfully!');
    }
}
