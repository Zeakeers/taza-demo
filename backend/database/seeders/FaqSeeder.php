<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        PageContent::updateOrCreate(
            ['page_name' => 'layanan', 'section_name' => 'faq'],
            ['content' => [
                'header' => [
                    'title' => 'Haloo, ada yang bisa kami bantu?',
                    'search_placeholder' => 'Cari bantuan disini ...',
                ],
                'items' => [
                    [
                        'question' => "Saya sudah transfer, tapi status donasi masih 'Belum Dibayar', apa yang harus saya lakukan?",
                        'answer' => 'Harap tunggu 5-10 menit, pastikan nominal sesuai kode unik, lalu unggah bukti transfer di menu konfirmasi atau hubungi admin WhatsApp.',
                    ],
                    [
                        'question' => 'Bagaimana cara melakukan donasi melalui QR Code?',
                        'answer' => 'Anda dapat memindai QR Code yang tersedia di halaman QR Code Donasi menggunakan aplikasi mobile banking atau e-wallet. Setelah pembayaran berhasil, lakukan konfirmasi donasi melalui menu Konfirmasi Donasi.',
                    ],
                    [
                        'question' => 'Apakah donasi saya bisa digunakan untuk zakat?',
                        'answer' => 'Ya, Taman Zakat menyediakan berbagai program zakat termasuk zakat maal, zakat penghasilan, dan zakat fitrah. Anda dapat memilih program yang sesuai saat melakukan donasi.',
                    ],
                    [
                        'question' => 'Berapa nisab zakat penghasilan saat ini?',
                        'answer' => 'Nisab zakat penghasilan setara dengan 85 gram emas. Anda dapat menggunakan Kalkulator Zakat kami untuk menghitung kewajiban zakat berdasarkan harga emas terkini.',
                    ],
                    [
                        'question' => 'Apakah saya akan mendapatkan bukti pembayaran zakat?',
                        'answer' => 'Ya, setelah donasi Anda dikonfirmasi, kami akan mengirimkan bukti pembayaran zakat melalui WhatsApp atau email yang Anda daftarkan.',
                    ],
                    [
                        'question' => 'Bagaimana cara menghubungi customer service Taman Zakat?',
                        'answer' => 'Anda dapat menghubungi kami melalui WhatsApp di nomor 082230099009, email di mail@tamanzakat.org, atau langsung mengunjungi kantor pelayanan kami.',
                    ],
                    [
                        'question' => 'Apakah Taman Zakat memiliki legalitas resmi?',
                        'answer' => 'Ya, Taman Zakat adalah Lembaga Amil Zakat (LAZ) yang telah memiliki legalitas resmi dan diakui oleh berbagai pihak berwenang, baik di tingkat daerah maupun nasional.',
                    ],
                    [
                        'question' => 'Apakah donasi saya bisa diantar langsung ke kantor?',
                        'answer' => 'Tentu, Anda dapat mengunjungi kantor pelayanan kami di Sidoarjo, Surabaya, atau Probolinggo. Informasi alamat lengkap tersedia di halaman Kantor Pelayanan.',
                    ],
                ],
                'topics' => [
                    'Konfirmasi Donasi',
                    'Zakat Penghasilan',
                    'QR Code Donasi',
                    'Kalkulator Zakat',
                    'Rekening Bank',
                    'Kantor Pelayanan',
                    'Zakat Fitrah',
                    'Legalitas LAZ',
                ],
            ]]
        );
    }
}
