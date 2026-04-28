<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            ['id' => 'ID-AC', 'name' => 'Aceh'],
            ['id' => 'ID-BA', 'name' => 'Bali'],
            ['id' => 'ID-BB', 'name' => 'Bangka Belitung'],
            ['id' => 'ID-BE', 'name' => 'Bengkulu'],
            ['id' => 'ID-BT', 'name' => 'Banten'],
            ['id' => 'ID-GO', 'name' => 'Gorontalo'],
            ['id' => 'ID-JA', 'name' => 'Jambi'],
            ['id' => 'ID-JB', 'name' => 'Jawa Barat'],
            ['id' => 'ID-JI', 'name' => 'Jawa Timur'],
            ['id' => 'ID-JK', 'name' => 'DKI Jakarta'],
            ['id' => 'ID-JT', 'name' => 'Jawa Tengah'],
            ['id' => 'ID-KB', 'name' => 'Kalimantan Barat'],
            ['id' => 'ID-KT', 'name' => 'Kalimantan Tengah'],
            ['id' => 'ID-KI', 'name' => 'Kalimantan Timur'],
            ['id' => 'ID-KS', 'name' => 'Kalimantan Selatan'],
            ['id' => 'ID-KU', 'name' => 'Kalimantan Utara'],
            ['id' => 'ID-KR', 'name' => 'Kepulauan Riau'],
            ['id' => 'ID-LA', 'name' => 'Lampung'],
            ['id' => 'ID-MA', 'name' => 'Maluku'],
            ['id' => 'ID-MU', 'name' => 'Maluku Utara'],
            ['id' => 'ID-NB', 'name' => 'Nusa Tenggara Barat'],
            ['id' => 'ID-NT', 'name' => 'Nusa Tenggara Timur'],
            ['id' => 'ID-PA', 'name' => 'Papua'],
            ['id' => 'ID-PB', 'name' => 'Papua Barat'],
            ['id' => 'ID-RI', 'name' => 'Riau'],
            ['id' => 'ID-SA', 'name' => 'Sulawesi Utara'],
            ['id' => 'ID-ST', 'name' => 'Sulawesi Tengah'],
            ['id' => 'ID-SG', 'name' => 'Sulawesi Tenggara'],
            ['id' => 'ID-SN', 'name' => 'Sulawesi Selatan'],
            ['id' => 'ID-SR', 'name' => 'Sulawesi Barat'],
            ['id' => 'ID-SB', 'name' => 'Sumatera Barat'],
            ['id' => 'ID-SS', 'name' => 'Sumatera Selatan'],
            ['id' => 'ID-SU', 'name' => 'Sumatera Utara'],
            ['id' => 'ID-YO', 'name' => 'DI Yogyakarta'],
        ];

        $activeData = [
            "ID-AC" => ["beneficiaries" => "12,450", "funds" => "Rp 1.2M", "images" => ["/images/campaign/1.jpg", "/images/campaign/2.jpg", "/images/campaign/3.jpg", "/images/campaign/4.jpg"]],
            "ID-SU" => ["beneficiaries" => "18,200", "funds" => "Rp 1.8M", "images" => ["/images/campaign/5.jpg", "/images/campaign/6.jpg", "/images/campaign/7.jpg"]],
            "ID-SB" => ["beneficiaries" => "9,800", "funds" => "Rp 950JT", "images" => ["/images/campaign/1.jpg", "/images/campaign/4.jpg", "/images/campaign/7.jpg"]],
            "ID-JK" => ["beneficiaries" => "45,000", "funds" => "Rp 4.5M", "images" => ["/images/campaign/2.jpg", "/images/campaign/3.jpg", "/images/campaign/5.jpg", "/images/campaign/6.jpg"]],
            "ID-JB" => ["beneficiaries" => "32,100", "funds" => "Rp 3.1M", "images" => ["/images/campaign/1.jpg", "/images/campaign/3.jpg", "/images/campaign/6.jpg"]],
            "ID-JT" => ["beneficiaries" => "28,400", "funds" => "Rp 2.7M", "images" => ["/images/campaign/4.jpg", "/images/campaign/2.jpg", "/images/campaign/7.jpg"]],
            "ID-JI" => ["beneficiaries" => "38,900", "funds" => "Rp 3.8M", "images" => ["/images/campaign/1.jpg", "/images/campaign/5.jpg", "/images/campaign/3.jpg", "/images/campaign/6.jpg"]],
            "ID-BA" => ["beneficiaries" => "7,500", "funds" => "Rp 800JT", "images" => ["/images/campaign/6.jpg", "/images/campaign/7.jpg"]],
            "ID-SS" => ["beneficiaries" => "11,200", "funds" => "Rp 1.1M", "images" => ["/images/campaign/2.jpg", "/images/campaign/4.jpg"]],
        ];

        foreach ($provinces as $province) {
            $isActive = array_key_exists($province['id'], $activeData);
            $data = $isActive ? $activeData[$province['id']] : null;

            Province::updateOrCreate(
                ['id' => $province['id']],
                [
                    'name' => $province['name'],
                    'is_active' => $isActive,
                    'beneficiaries' => $data ? $data['beneficiaries'] : null,
                    'funds' => $data ? $data['funds'] : null,
                    'quote' => $isActive ? "Setiap rupiah yang Anda salurkan menjadi harapan baru bagi saudara-saudara kita di {$province['name']}." : null,
                    'images' => $data ? $data['images'] : null,
                ]
            );
        }
    }
}
