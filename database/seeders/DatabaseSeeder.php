<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        DB::table('users')->insertOrIgnore([
            'name'       => 'Faris Isnawan',
            'email'      => 'esensialtraining@gmail.com',
            'password'   => Hash::make('esensial2024!'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Site settings defaults
        $settings = [
            // Hero
            'hero_title'       => 'ESENSIAL TRAINING & CONSULTING',
            'hero_tagline'     => 'Professional Skills Excellent',
            'hero_description' => 'Lembaga jasa pelatihan profesional yang melayani berbagai instansi mulai dari swasta hingga perusahaan. Didirikan pada 06 September 2017 oleh Faris Isnawan.',
            'hero_cta_text'    => 'Lihat Program',
            'hero_cta_link'    => '#program',
            // Founder
            'founder_name'      => 'Faris Isnawan, S.Pd., M.Pd.',
            'founder_position'  => 'Founder & CEO',
            'founder_instagram' => 'faris_isnawan',
            'founder_whatsapp'  => '6285713014064',
            // Experience stats
            'stat_corporate'   => '35+',
            'stat_government'  => '60+',
            'stat_education'   => '200+',
            // Contact
            'contact_whatsapp'  => '6285713014064',
            'contact_instagram' => 'esensial.trainingconsulting',
            'contact_email'     => 'esensialtraining@gmail.com',
            'contact_address'   => 'Jl. Srikoyo, Kemasan, Ngadirejo, Kec. Kartasura, Kab. Sukoharjo, Jawa Tengah 57163',
            // Appearance
            'font_heading'     => 'Playfair Display',
            'font_body'        => 'DM Sans',
            'font_size'        => '16',
            'color_primary'    => '#04599A',
            'color_accent'     => '#0ea5e9',
            'color_background' => '#072d52',
            'color_text'       => '#ffffff',
            // SEO
            'site_title'       => 'Esensial Training & Consulting',
            'site_description' => 'Lembaga jasa pelatihan profesional yang melayani berbagai instansi mulai dari swasta hingga perusahaan.',
        ];

        foreach ($settings as $key => $value) {
            DB::table('site_settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value, 'updated_at' => now(), 'created_at' => now()]
            );
        }

        // Workshop Intensif
DB::table('workshop_intensifs')->updateOrInsert(
    ['id' => 1],
    [
        'description' => 'Pelatihan yang diikuti oleh berbagai instansi untuk dapat mewujudkan sebuah pelayanan yang memuaskan dan tak terlupakan bagi para client, serta meningkatkan citra positif instansi di antara para kompetitor yang ada.',
        
        'taglines' => json_encode([
            'Pelayanan Prima',
            'Citra Positif',
            'Kompetitif',
            'Profesional'
        ]),

        'is_visible' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ]
);

        // Programs
        $programs = [
            ['name' => 'Pelatihan TIK Swasta',            'icon' => 'monitor',      'description' => 'Pelatihan Kerja Teknologi Informasi dan Komunikasi untuk instansi swasta',           'sort_order' => 1],
            ['name' => 'Pelatihan TIK Perusahaan',         'icon' => 'cpu',          'description' => 'Pelatihan Kerja Teknologi Informasi dan Komunikasi untuk perusahaan',                  'sort_order' => 2],
            ['name' => 'Bisnis & Manajemen Swasta',        'icon' => 'bar-chart-2',  'description' => 'Pelatihan Kerja Bisnis dan Manajemen untuk instansi swasta',                          'sort_order' => 3],
            ['name' => 'Bisnis & Manajemen Perusahaan',    'icon' => 'building-2',   'description' => 'Pelatihan Kerja Bisnis dan Manajemen untuk perusahaan',                               'sort_order' => 4],
            ['name' => 'Pelatihan Swasta & Perusahaan',   'icon' => 'settings',     'description' => 'Pelatihan Kerja Swasta dan Perusahaan lainnya',                                       'sort_order' => 5],
            ['name' => 'Event Khusus',                     'icon' => 'calendar',     'description' => 'Jasa Penyelenggara Event Khusus yang profesional dan berkualitas',                    'sort_order' => 6],
            ['name' => 'Pendidikan Pemerintah',            'icon' => 'landmark',     'description' => 'Pendidikan Lainnya untuk instansi Pemerintah',                                        'sort_order' => 7],
            ['name' => 'Manajemen & Perbankan',            'icon' => 'graduation-cap','description' => 'Jasa Pendidikan Manajemen dan Perbankan',                                             'sort_order' => 8],
        ];

        foreach ($programs as $p) {
            DB::table('programs')->updateOrInsert(
                ['name' => $p['name']],
                array_merge($p, [
                    'is_active'  => true,
                    'updated_at' => now(),
                ])
            );
        }

        // Partners
        $partners = [
            'PT. Mitaka',
            'PT. Chickin Indonesia',
            'Kementerian PUPR',
            'UIN Riau',
            'MAN 1 Surakarta',
            'Yayasan Al Abidin',
        ];

        foreach ($partners as $i => $name) {
            DB::table('partners')->updateOrInsert(
                ['name' => $name],
                [
                    'is_visible' => true,
                    'sort_order' => $i + 1,
                    'updated_at' => now(),
                ]
            );
        }

        // Certifications
        $certs = [
            'Certified Professional Trainer – BNSP RI',
            'Certified Trainer & Master Neo NLP',
            'Certified Hypnotist & Hypnotherapist',
            'Certified Praktisi Talents Mapping',
            'Certified Master Service Excellence',
            'Certified Public Speaking',
        ];

        foreach ($certs as $i => $title) {
            DB::table('certifications')->updateOrInsert(
                ['title' => $title],
                [
                    'sort_order' => $i + 1,
                    'is_visible' => true,
                    'updated_at' => now(),
                ]
            );
        }

        // Blog posts (sample)
        $posts = [
            [
                'title'        => 'Workshop Service Excellence di Kementerian PUPR',
                'slug'         => 'workshop-service-excellence-kementerian-pupr',
                'category'     => 'Workshop',
                'excerpt'      => 'Pelatihan service excellence bersama Kementerian PUPR untuk meningkatkan kualitas pelayanan publik.',
                'content'      => '<p>Pelatihan service excellence bersama Kementerian PUPR untuk meningkatkan kualitas pelayanan publik.</p>',
                'status'       => 'published',
                'published_at' => now(),
            ],
            [
                'title'        => 'Pelatihan SDM di PT. Chickin Indonesia',
                'slug'         => 'pelatihan-sdm-pt-chickin-indonesia',
                'category'     => 'Training',
                'excerpt'      => 'Program pengembangan sumber daya manusia untuk meningkatkan produktivitas perusahaan.',
                'content'      => '<p>Program pengembangan sumber daya manusia untuk meningkatkan produktivitas perusahaan.</p>',
                'status'       => 'published',
                'published_at' => now(),
            ],
            [
                'title'        => 'Seminar Motivasi di SMK Negeri 6 Surakarta',
                'slug'         => 'seminar-motivasi-smk-negeri-6-surakarta',
                'category'     => 'Pendidikan',
                'excerpt'      => 'Membangun semangat dan motivasi siswa melalui program pelatihan yang inspiratif.',
                'content'      => '<p>Membangun semangat dan motivasi siswa melalui program pelatihan yang inspiratif.</p>',
                'status'       => 'draft',
                'published_at' => null,
            ],
        ];

        foreach ($posts as $post) {
            DB::table('blog_posts')->insertOrIgnore(array_merge($post, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}