<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageContent;

class PageContentSeeder extends Seeder
{
    public function run()
    {
        $contents = [
            [
                'page_name' => 'about',
                'section_name' => 'hero',
                'content' => [
                    'image' => '/images/gambardetaile/Gemini_Generated_Image_iu64lviu64lviu64 1.svg',
                    'title' => "Hal paling sia-sia adalah \nsaat kita diam tanpa \nmelakukan apa-apa.",
                    'name' => 'H. SLAMET BUDIONO, S.H., M.M',
                    'position' => 'FOUNDER & CEO TAMAN ZAKAT',
                    'quote' => '"Semangat kami adalah memastikan setiap titipan kebaikan Anda mengalir menjadi keberkahan yang nyata bagi mereka yang paling membutuhkan."'
                ]
            ],
            [
                'page_name' => 'about',
                'section_name' => 'stats',
                'content' => [
                    'wilayah_count' => '47',
                    'wilayah_desc' => 'Lorem ipsum dolor sit amet, wilayah jangkauan meliputi berbagai pelosok negeri dengan fokus pada daerah tertinggal. Aliquam erat volutpat. Aenean varius, ipsum.',
                    'penerima_count' => '102.088',
                    'penerima_desc' => 'Curabitur pretium tincidunt lacus, penerima manfaat merupakan dhuafa dan amil yang berhak. Nulla gravida orci a odio. Nullam varius, turpis et commodo.',
                    'aksi_count' => '19',
                    'aksi_desc' => 'Suspendisse dictum feugiat nisl, aksi kebaikan meliputi pendidikan, ekonomi, dan kesehatan. Ut sem vamus vulputate eleifend. Praesent dapibus, neque id cursus.'
                ]
            ],
            [
                'page_name' => 'about',
                'section_name' => 'value',
                'content' => [
                    'title' => 'Kepuasan Anda adalah Amanah Kami',
                    'desc' => 'Setiap dana Zakat, Infaq, dan Sedekah yang Anda percayakan kepada kami akan dikelola dengan standar audit yang ketat. Kami memastikan 100% amanah disalurkan kepada program-program Al-Qur\'an, Pendidikan, Kesehatan, dan Kemanusiaan.',
                    'image' => ''
                ]
            ],
            [
                'page_name' => 'about',
                'section_name' => 'mengenal',
                'content' => [
                    'Sejarah' => [
                        'text' => "Yayasan Taman Zakat Indonesia didirikan pada 29 Desember 2018 dengan misi mulia mengentaskan umat dari kemiskinan. Semangat untuk mengalirkan kebaikan dari para donatur kepada penerima manfaat menjadi landasan kami untuk bergerak sebagai lembaga filantropi profesional dan tepercaya.\n\nBerawal dari akta No. 34 oleh notaris Wahyu Hidayat, SH, M.Kn, Taman Zakat terus berkembang hingga kini diakui sebagai LAZ Provinsi yang dipercaya oleh masyarakat luas. Kami berkomitmen menjadi tonggak gerakan kebaikan umat melalui berbagai program berkelanjutan.\n\nHingga tahun 2022, Taman Zakat Indonesia telah membersamai lebih dari 3.000 donatur untuk menyalurkan manfaat kepada lebih dari 300.000 orang di berbagai penjuru wilayah.",
                        'image' => ''
                    ],
                    'Visi Misi' => [
                        'text' => "<h4 class=\"font-bold text-[#7FC248] mb-2\">VISI</h4>\n<p class=\"italic mb-6\">&quot;Lembaga Filantropi Nasional Terpercaya Dalam Pengembangan Pendidikan, Kesehatan dan Pemberdayaan Masyarakat.&quot;</p>\n<h4 class=\"font-bold text-[#7FC248] mb-2\">MISI</h4>\n<ul class=\"list-disc pl-5 space-y-2\">\n<li>Mengoptimalkan seluruh SDM untuk Pemberdayaan Masyarakat</li>\n<li>Memfasilitasi Layanan Pendidikan dan Kesehatan Masyarakat</li>\n<li>Membangun Secara Aktif Jaringan Filantropy Nasional dan Internasional</li>\n</ul>\n<h4 class=\"font-bold text-[#7FC248] mb-2\">TUJUAN</h4>\n<ul class=\"list-disc pl-5 space-y-2\">\n<li>Mengembangkan dan menyediakan lembaga pendidikan berkualitas</li>\n<li>Mengembangkan dan membiayai layanan kesehatan masyarakat yang berkualitas</li>\n<li>Memberikan layanan sosial pemberdayaan masyarakat yang berdampak masif</li>\n</ul>"
                    ],
                    'Legalitas' => [
                        'text' => "<p class=\"mb-4\">Taman Zakat Indonesia memiliki legitimasi penuh melalui aspek legal formal berikut:</p>\n<ul class=\"list-disc pl-5 space-y-2 text-sm\">\n<li><strong>SK Dirjen Bimas Islam No. 245 Tahun 2021</strong>: Izin Lembaga Amil Zakat Skala Provinsi</li>\n<li><strong>Rekomendasi BAZNAS Indonesia</strong>: No. 617/ANG/BAZNAS/XI/2020</li>\n<li><strong>SK Kemenkumham</strong>: AHU-AH.01.06.0008536 Tahun 2021 (Perubahan)</li>\n<li><strong>SK Keanggotaan FOZ</strong>: No. 130/SK/PH-FOZ/X/2019 (NA 130.FOZ.2019)</li>\n</ul>\n<p>Legalitas ini merupakan bukti komitmen kami dalam mengelola dana zakat, infaq, dan sedekah secara amanah, transparan, dan sesuai peraturan perundang-undangan.</p>"
                    ],
                    'Profile' => [
                        'text' => "Taman Zakat merupakan Lembaga Filantropi Profesional yang berfokus pada sarana dakwah untuk pengembangan Al-Qur'an, Pendidikan, Kesehatan dan Kemanusiaan. Berdiri sejak tahun 2018, kami terus berinovasi untuk memberikan dampak maksimal.\n\nVisi kami adalah memfasilitasi perkembangan generasi yang penuh berkah. Melalui gerakan #BerbagiBersama, kami mengajak masyarakat untuk meluaskan manfaat dan menjadi mitra terbaik bagi Sobat Zakat semua.\n\nKami bermimpi menjadi salah satu tulang punggung gerakan kebaikan ummat, menghadirkan solusi nyata bagi kemiskinan dan keterdesakan sosial di Indonesia."
                    ]
                ]
            ],
            [
                'page_name' => 'about',
                'section_name' => 'kepengurusan',
                'content' => [
                    'Dewan Direksi' => [
                        ['name' => 'H. Slamet Budiono, S.H., M.M', 'role' => 'Direktur Utama', 'image' => ''],
                        ['name' => 'Nama Direktur 2', 'role' => 'Direktur Operasional', 'image' => '']
                    ],
                    'Dewan Pembina' => [
                        ['name' => 'Nama Pembina 1', 'role' => 'Ketua Dewan Pembina', 'image' => ''],
                        ['name' => 'Nama Pembina 2', 'role' => 'Anggota Dewan Pembina', 'image' => '']
                    ],
                    'Dewan Pengawas' => [
                        ['name' => 'Nama Pengawas 1', 'role' => 'Ketua Dewan Pengawas', 'image' => '']
                    ],
                    'Dewan Syariah' => [
                        ['name' => 'Nama Syariah 1', 'role' => 'Ketua Dewan Syariah', 'image' => '']
                    ],
                    'Referensi Syariah' => [
                        ['name' => 'Nama Referensi 1', 'role' => 'Anggota Referensi Syariah', 'image' => '']
                    ],
                    'Dewan Pakar' => [
                        ['name' => 'Nama Pakar 1', 'role' => 'Anggota Dewan Pakar', 'image' => '']
                    ]
                ]
            ],
            [
                'page_name' => 'about',
                'section_name' => 'penghargaan',
                'content' => [
                    ['title' => 'Fundraising Award', 'year' => '2022', 'image' => '/images/gambardetaile/fundraising award.jpg'],
                    ['title' => 'WTP Award 2023', 'year' => '2023', 'image' => '/images/gambardetaile/wtp award.jpeg'],
                    ['title' => 'WTP Award 2022', 'year' => '2022', 'image' => '/images/gambardetaile/aww 1.png']
                ]
            ],
            [
                'page_name' => 'home',
                'section_name' => 'hero',
                'content' => [
                    'images' => [
                        '/images/gambardetaile/hero home 1.svg',
                        '/images/gambardetaile/hero home 2.svg',
                        '/images/gambardetaile/hero home 3.svg',
                        '/images/gambardetaile/hero home 4.svg',
                        '/images/gambardetaile/hero home 5.svg'
                    ]
                ]
            ],
            [
                'page_name' => 'home',
                'section_name' => 'about',
                'content' => [
                    'title' => 'TENTANG KAMI',
                    'sub' => 'TAMAN ZAKAT INDONESIA',
                    'desc' => 'Kami Memfasilitasi perkembangan generasi yang penuh berkah dan kami mempunyai mimpi bisa menjadi salah satu tulang punggung gerakan kebaikan ummat.',
                    'highlight' => "Lembaga Filantropi Profesional dan terpercaya yang berfokus pada Sarana dakwah untuk Pengembangan Alqur'an, Pendidikan, Kesehatan dan Kemanusiaan"
                ]
            ],
            [
                'page_name' => 'home',
                'section_name' => 'stats',
                'content' => [
                    'title' => 'Setiap Zakat Anda Mengalirkan Keberkahan untuk Sesama',
                    'desc' => 'Taman Zakat memastikan setiap titipan kebaikan Anda tersalurkan secara tepat sasaran kepada mereka yang membutuhkan di berbagai wilayah Indonesia.',
                    'wilayah' => '47',
                    'manfaat' => '102.088',
                    'aksi' => '19'
                ]
            ],
            [
                'page_name' => 'home',
                'section_name' => 'cta',
                'content' => [
                    'title' => 'Bergabunglah Bersama Kami',
                    'desc' => 'Mari menjadi bagian dari gerakan kebaikan untuk perubahan yang lebih baik bagi ummat.',
                    'btn' => 'LIHAT SEMUA PELUANG'
                ]
            ],
            [
                'page_name' => 'home',
                'section_name' => 'testimoni',
                'content' => [
                    [
                        'name' => 'Bapak Ahmad Faisal',
                        'role' => 'Donatur Rutin',
                        'quote' => 'Taman Zakat sangat amanah dan transparan. Laporan pendayagunaannya sangat detil dan dikirimkan secara berkala kepada kami.',
                        'image' => 'https://i.pravatar.cc/150?u=ahmad'
                    ],
                    [
                        'name' => 'Ibu Siti Aminah',
                        'role' => 'Penerima Manfaat',
                        'quote' => 'Alhamdulillah, bantuan pendidikan dari Taman Zakat sangat membantu sekolah anak saya hingga lulus dengan nilai memuaskan.',
                        'image' => 'https://i.pravatar.cc/150?u=siti'
                    ],
                    [
                        'name' => 'Bapak Budi Santoso',
                        'role' => 'Tokoh Masyarakat',
                        'quote' => 'Program pemberdayaan ekonominya nyata dirasakan oleh warga kami. Banyak UMKM yang terbantu dengan modal dan pendampingannya.',
                        'image' => 'https://i.pravatar.cc/150?u=budi'
                    ]
                ]
            ]
        ];

        foreach ($contents as $data) {
            PageContent::updateOrCreate(
                ['page_name' => $data['page_name'], 'section_name' => $data['section_name']],
                ['content' => $data['content']]
            );
        }
    }
}
