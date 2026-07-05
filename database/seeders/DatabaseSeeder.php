<?php
 
namespace Database\Seeders;
 
use App\Models\User;
use App\Models\Setting;
use App\Models\Theme;
use App\Models\AdPosition;
use App\Models\Ad;
use App\Models\Company;
use App\Models\CompanyBadge;
use App\Models\JobCategory;
use App\Models\Job;
use App\Models\Application;
use App\Models\SalaryInsight;
use App\Models\CareerRoadmap;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\SeoPage;
use App\Models\Menu;
use App\Models\Banner;
use App\Models\Announcement;
use App\Models\CvTemplate;
use App\Models\MatchRule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
 
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Spatie Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $companyRole = Role::firstOrCreate(['name' => 'company', 'guard_name' => 'web']);
        $candidateRole = Role::firstOrCreate(['name' => 'candidate', 'guard_name' => 'web']);
 
        // 2. Create Default Users
        $adminUser = User::create([
            'name' => 'Admin MauLoker',
            'email' => 'admin@mauloker.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'location' => 'Jakarta Pusat, DKI Jakarta',
            'bio' => 'Administrator Platform MauLoker',
        ]);
        $adminUser->assignRole($adminRole);
 
        $candidateUser = User::create([
            'name' => 'Ahmad Rian',
            'email' => 'rian@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'candidate',
            'phone' => '081234567893',
            'location' => 'Jakarta Selatan, DKI Jakarta',
            'bio' => 'Developer Frontend & Laravel yang berdedikasi tinggi.',
            'skills' => ['Laravel', 'VueJS', 'TailwindCSS', 'AlpineJS', 'Livewire', 'MySQL'],
            'education_level' => 'S1',
            'experience_years' => 2,
            'expected_salary' => 8500000.00,
            'resume_strength' => 85,
            'cv_ats_score' => 88
        ]);
        $candidateUser->assignRole($candidateRole);
 
        // 3. Create Settings
        $settings = [
            'website_name' => 'MauLoker',
            'tagline' => 'Siap Pindah Kerja? Mulai Karir Impianmu!',
            'contact_whatsapp' => '+6281234567890',
            'contact_email' => 'support@mauloker.id',
            'google_adsense_client' => 'ca-pub-1234567890123456',
            'google_adsense_status' => 'true',
            'whatsapp_status' => 'true',
            'maintenance_mode' => 'false',
            'pwa_status' => 'true',
            'logo_url' => '',
            'favicon_url' => '',
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => '2525',
            'smtp_user' => 'null',
            'smtp_pass' => 'null',
        ];
        foreach ($settings as $key => $value) {
            Setting::create(['key' => $key, 'value' => $value, 'group' => 'general']);
        }
 
        // 4. Create Theme Settings (indigo/emerald palette for MauLoker)
        Theme::create([
            'name' => 'Tema Indigo MauLoker',
            'is_active' => true,
            'primary_color' => '#3F51F5',
            'primary_hover' => '#2b3fd4',
            'primary_dark' => '#1e2ea3',
            'light_bg' => '#FFFFFF',
            'light_card' => '#F8FAFC',
            'dark_bg' => '#0B1220',
            'dark_card' => '#111827',
            'text_light' => '#111827',
            'text_dark' => '#F9FAFB',
            'border_radius' => '1rem',
            'font_family' => 'Outfit',
            'button_style' => 'rounded-xl',
            'card_style' => 'flat',
        ]);
 
        // 5. Create Ad Positions
        $adPositions = [
            ['code' => 'homepage_hero', 'name' => 'Homepage Hero Banner (728x90)'],
            ['code' => 'homepage_middle', 'name' => 'Homepage Middle Section (300x250)'],
            ['code' => 'homepage_footer', 'name' => 'Homepage Footer Banner (728x90)'],
            ['code' => 'job_search_top', 'name' => 'Job Search Results Top (728x90)'],
            ['code' => 'job_search_sidebar', 'name' => 'Job Search Sidebar Ad (300x250)'],
            ['code' => 'job_search_bottom', 'name' => 'Job Search Results Bottom (728x90)'],
            ['code' => 'job_detail_top', 'name' => 'Job Detail Top Ad (728x90)'],
            ['code' => 'job_detail_sidebar', 'name' => 'Job Detail Sidebar Ad (300x250)'],
            ['code' => 'job_detail_bottom', 'name' => 'Job Detail Bottom Ad (728x90)'],
            ['code' => 'company_page', 'name' => 'Company Profile Ad (300x250)'],
            ['code' => 'blog_top', 'name' => 'Blog List Top Ad (728x90)'],
            ['code' => 'blog_middle', 'name' => 'Blog Article Middle Ad (300x250)'],
            ['code' => 'blog_bottom', 'name' => 'Blog Article Bottom Ad (728x90)'],
            ['code' => 'dashboard_candidate', 'name' => 'Candidate Dashboard Ad (320x100)'],
            ['code' => 'dashboard_company', 'name' => 'Company Dashboard Ad (320x100)'],
        ];
        foreach ($adPositions as $pos) {
            AdPosition::create($pos);
        }
 
        // 6. Create Ads
        Ad::create([
            'name' => 'Microsoft Hiring Ad',
            'position_code' => 'job_search_sidebar',
            'status' => true,
            'start_date' => now(),
            'end_date' => now()->addMonths(6),
            'target_device' => 'all',
            'format_type' => 'html',
            'code_content' => '<div class="bg-gradient-to-r from-indigo-600 to-blue-700 text-white p-6 rounded-xl shadow-md text-center">
                <h4 class="font-bold text-lg mb-1">Developer Ingin Berkembang?</h4>
                <p class="text-xs mb-4">Gabung di Microsoft Corporation sekarang!</p>
                <a href="/jobs" class="bg-white text-indigo-600 font-semibold px-4 py-2 rounded-lg text-xs hover:bg-slate-100 transition inline-block">Lamar Sekarang</a>
            </div>',
            'priority' => 10,
        ]);
 
        // 7. Create Job Categories
        $categoriesData = [
            ['name' => 'Pemasaran & Hubungan Masyarakat', 'slug' => 'marketing', 'icon' => 'megaphone', 'color' => '#FF7676'],
            ['name' => 'Desain & Pengembangan UI/UX', 'slug' => 'design', 'icon' => 'palette', 'color' => '#3B82F6'],
            ['name' => 'Sumber Daya Manusia (HRD)', 'slug' => 'human-resources', 'icon' => 'users-round', 'color' => '#10B981'],
            ['name' => 'Bisnis & Konsultasi Manajemen', 'slug' => 'business', 'icon' => 'trending-up', 'color' => '#8B5CF6'],
            ['name' => 'Layanan Pelanggan & Support', 'slug' => 'customer-service', 'icon' => 'headset', 'color' => '#FFB947'],
            ['name' => 'Manajemen Proyek & Produk', 'slug' => 'product-management', 'icon' => 'kanban', 'color' => '#EC4899'],
            ['name' => 'Pemrograman & Teknologi Informasi', 'slug' => 'programming', 'icon' => 'code-xml', 'color' => '#14B8A6'],
            ['name' => 'Keuangan & Akuntansi Pajak', 'slug' => 'finance', 'icon' => 'wallet', 'color' => '#06B6D4'],
        ];
        $categoriesMap = [];
        foreach ($categoriesData as $cat) {
            $createdCat = JobCategory::create([
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'icon' => $cat['icon'],
                'color' => $cat['color'],
                'seo_title' => 'Lowongan Kerja ' . $cat['name'] . ' Terbaru 2026',
                'seo_description' => 'Cari lowongan kerja ' . $cat['name'] . ' terbaik di Indonesia. Lamar online hari ini dan dapatkan karir impian Anda.',
                'status' => true
            ]);
            $categoriesMap[$cat['slug']] = $createdCat->id;
        }
 
        // 8. Create Companies (exactly matching reference screenshots)
        $companiesInfo = [
            [
                'name' => 'GitLab',
                'email' => 'hr@gitlab.com',
                'slug' => 'gitlab',
                'logo' => 'https://img.icons8.com/color/120/000000/gitlab.png',
                'location' => 'Jakarta Selatan, DKI Jakarta',
                'verified' => false,
                'category' => 'Software & Teknologi',
                'top_employer' => false,
                'premium' => false
            ],
            [
                'name' => 'Microsoft Corp.',
                'email' => 'hr@microsoft.com',
                'slug' => 'microsoft',
                'logo' => 'https://img.icons8.com/color/120/000000/microsoft.png',
                'location' => 'Sudirman, Jakarta Pusat',
                'verified' => true,
                'category' => 'Software & Solusi Teknologi',
                'top_employer' => true,
                'premium' => true
            ],
            [
                'name' => 'Behance Net',
                'email' => 'hr@behance.net',
                'slug' => 'behance',
                'logo' => 'https://img.icons8.com/color/120/000000/behance.png',
                'location' => 'Bandung, Jawa Barat',
                'verified' => false,
                'category' => 'Platform Kreatif & Desain',
                'top_employer' => false,
                'premium' => false
            ],
            [
                'name' => 'Discord Corp.',
                'email' => 'hr@discord.com',
                'slug' => 'discord',
                'logo' => 'https://img.icons8.com/color/120/000000/discord-new-ui.png',
                'location' => 'Surabaya, Jawa Timur',
                'verified' => true,
                'category' => 'Teknologi Komunikasi & Voice',
                'top_employer' => true,
                'premium' => true
            ],
            [
                'name' => 'Vizzavi',
                'email' => 'hr@vizzavi.com',
                'slug' => 'vizzavi',
                'logo' => 'https://img.icons8.com/color/120/000000/globe.png',
                'location' => 'Yogyakarta, DIY',
                'verified' => false,
                'category' => 'Telekomunikasi',
                'top_employer' => false,
                'premium' => false
            ],
            [
                'name' => 'Microsoft Edge',
                'email' => 'hr@edge.com',
                'slug' => 'ms-edge',
                'logo' => 'https://img.icons8.com/color/120/000000/ms-edge-new.png',
                'location' => 'Tangerang, Banten',
                'verified' => true,
                'category' => 'Web Browser & Teknologi',
                'top_employer' => true,
                'premium' => true
            ],
            [
                'name' => 'Wells Fargo',
                'email' => 'hr@wellsfargo.com',
                'slug' => 'wells-fargo',
                'logo' => 'https://img.icons8.com/color/120/000000/bank.png',
                'location' => 'Medan, Sumatera Utara',
                'verified' => false,
                'category' => 'Perbankan & Keuangan',
                'top_employer' => false,
                'premium' => false
            ],
            [
                'name' => 'BMA Group',
                'email' => 'hr@bmagroup.com',
                'slug' => 'bma-group',
                'logo' => 'https://img.icons8.com/color/120/000000/briefcase.png',
                'location' => 'Semarang, Jawa Tengah',
                'verified' => true,
                'category' => 'Sumber Daya Manusia & Konsultan',
                'top_employer' => true,
                'premium' => true
            ]
        ];
 
        $companiesMap = [];
        foreach ($companiesInfo as $idx => $comp) {
            $user = User::create([
                'name' => $comp['name'],
                'email' => $comp['email'],
                'password' => Hash::make('password123'),
                'role' => 'company',
                'phone' => '08123456780' . $idx,
                'location' => $comp['location'],
                'bio' => 'Perekrutan resmi untuk ' . $comp['name'],
            ]);
            $user->assignRole($companyRole);
 
            $company = Company::create([
                'user_id' => $user->id,
                'name' => $comp['name'],
                'slug' => $comp['slug'],
                'logo' => $comp['logo'],
                'category' => $comp['category'],
                'description' => 'Perusahaan terkemuka yang berdedikasi untuk menghubungkan talenta terbaik dengan peluang karir ideal mereka. Kami berkomitmen untuk membantu Anda sukses di dunia kerja.',
                'website' => 'https://' . $comp['slug'] . '.com',
                'email' => $comp['email'],
                'phone' => '08123456780' . $idx,
                'location' => $comp['location'],
                'verified' => $comp['verified'],
                'top_employer' => $comp['top_employer'],
                'premium' => $comp['premium'],
                'status' => 'active',
            ]);
            
            $companiesMap[$comp['slug']] = $company->id;
 
            if ($comp['verified']) {
                CompanyBadge::create([
                    'company_id' => $company->id,
                    'badge_name' => 'Perusahaan Terverifikasi',
                    'badge_type' => 'status',
                    'icon' => 'check-circle',
                    'color' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                ]);
            }
        }
 
        // 9. Create Jobs (Exactly matching user's reference screenshot with Rupiah)
        $jobsInfo = [
            [
                'company' => 'gitlab',
                'category' => 'design',
                'title' => 'UI/UX Designer',
                'slug' => 'ui-designer-gitlab',
                'employment_type' => 'Magang',
                'salary_min' => 4500000,
                'salary_max' => 6000000,
                'city' => 'Jakarta Selatan, DKI Jakarta',
                'description' => 'Kami mencari Desain Grafis / UI Designer yang kreatif dan bersemangat untuk merancang antarmuka pengguna yang intuitif, modern, dan fungsional.',
                'requirements' => "• Latar belakang pendidikan relevan atau portofolio desain yang kuat.\n• Menguasai Figma, Adobe XD, atau aplikasi desain sejenis.\n• Mampu berkomunikasi dan bekerja sama dengan tim developer.\n• Disiplin, kreatif, dan berorientasi pada detail."
            ],
            [
                'company' => 'microsoft',
                'category' => 'customer-service',
                'title' => 'Administrasi Data Operasional',
                'slug' => 'mail-convertor-microsoft',
                'employment_type' => 'Full Time',
                'salary_min' => 5000000,
                'salary_max' => 7000000,
                'city' => 'Sudirman, Jakarta Pusat',
                'description' => 'Membantu pengelolaan surat menyurat, pengolahan data, pengarsipan dokumen operasional, serta memastikan alur kerja administrasi kantor berjalan lancar.',
                'requirements' => "• Pendidikan minimal SMA/SMK atau Diploma.\n• Menguasai Microsoft Office (Word, Excel, PowerPoint).\n• Teliti, rapi, dan cepat dalam pemrosesan data.\n• Mampu beradaptasi dengan sistem administrasi digital."
            ],
            [
                'company' => 'behance',
                'category' => 'design',
                'title' => 'Front-end Developer & UX',
                'slug' => 'ux-engineer-behance',
                'employment_type' => 'Part Time',
                'salary_min' => 5500000,
                'salary_max' => 8000000,
                'city' => 'Bandung, Jawa Barat',
                'description' => 'Menggabungkan keahlian desain interaksi dengan pemrograman web front-end. Bertanggung jawab membangun komponen UI yang interaktif dan responsif.',
                'requirements' => "• Pengalaman menggunakan HTML, CSS, JavaScript, dan framework seperti Vue/React.\n• Memahami prinsip-prinsip User Experience (UX) dan responsive design.\n• Terbiasa bekerja dengan version control Git.\n• Mampu bekerja mandiri maupun dalam kolaborasi tim."
            ],
            [
                'company' => 'discord',
                'category' => 'programming',
                'title' => 'Spesialis Verifikasi Data',
                'slug' => 'data-verification-discord',
                'employment_type' => 'Full Time',
                'salary_min' => 5000000,
                'salary_max' => 7500000,
                'city' => 'Surabaya, Jawa Timur',
                'description' => 'Melakukan pemeriksaan keakuratan data, validasi informasi profil pengguna, verifikasi dokumen, serta melaporkan inkonsistensi data secara teratur.',
                'requirements' => "• Detail-oriented dan memiliki kemampuan analisis yang baik.\n• Mampu mengoperasikan spreadsheet dan database internal.\n• Berbahasa Indonesia dengan baik secara tulisan dan lisan.\n• Memiliki integritas tinggi dalam menjaga kerahasiaan data."
            ],
            [
                'company' => 'vizzavi',
                'category' => 'programming',
                'title' => 'Backend Laravel Engineer',
                'slug' => 'backend-engineer-vizzavi',
                'employment_type' => 'Full Time',
                'salary_min' => 8000000,
                'salary_max' => 14000000,
                'city' => 'Yogyakarta, DIY',
                'description' => 'Mengembangkan arsitektur server, API endpoints, manajemen database relasional, serta melakukan optimasi performa backend sistem.',
                'requirements' => "• Pengalaman dengan Node.js, PHP (Laravel), atau Go.\n• Memahami database MySQL/PostgreSQL dan caching Redis.\n• Mengerti arsitektur Restful API dan keamanan sistem.\n• Terbiasa dengan Docker dan deployment di server Linux."
            ],
            [
                'company' => 'ms-edge',
                'category' => 'programming',
                'title' => 'Web Extension Engineer',
                'slug' => 'edge-extension-developer-edge',
                'employment_type' => 'Full Time',
                'salary_min' => 9000000,
                'salary_max' => 16000000,
                'city' => 'Tangerang, Banten',
                'description' => 'Mengembangkan add-on dan ekstensi peramban web yang meningkatkan fungsionalitas browser, berkeamanan tinggi, dan hemat memori.',
                'requirements' => "• Mahir dalam JavaScript (ES6+), HTML, dan CSS.\n• Berpengalaman dengan APIs ekstensi browser (Chrome/Edge extension APIs).\n• Mengerti teknik optimasi performa skrip latar belakang (background scripts).\n• Komunikasi yang baik dan fasih berbahasa Inggris teknis."
            ],
            [
                'company' => 'wells-fargo',
                'category' => 'finance',
                'title' => 'Analis Keuangan Perusahaan',
                'slug' => 'financial-analyst-wells-fargo',
                'employment_type' => 'Full Time',
                'salary_min' => 8500000,
                'salary_max' => 13000000,
                'city' => 'Medan, Sumatera Utara',
                'description' => 'Melakukan analisis laporan laba rugi, merancang perkiraan anggaran keuangan perusahaan, serta memberikan rekomendasi investasi strategis.',
                'requirements' => "• Lulusan S1 Keuangan, Akuntansi, atau bidang bisnis terkait.\n• Memiliki sertifikasi keuangan (CFA/FRM) menjadi nilai tambah.\n• Mampu mengolah data finansial kompleks dengan Excel tingkat lanjut.\n• Keterampilan presentasi dan komunikasi yang sangat baik."
            ],
            [
                'company' => 'bma-group',
                'category' => 'human-resources',
                'title' => 'Koordinator Perekrutan (HRD)',
                'slug' => 'recruiting-coordinator-bma',
                'employment_type' => 'Kontrak',
                'salary_min' => 5500000,
                'salary_max' => 8500000,
                'city' => 'Semarang, Jawa Tengah',
                'description' => 'Mengoordinasikan jadwal interview kandidat dengan manajer divisi, mengelola database pelamar kerja di platform ATS, dan membantu proses onboarding karyawan baru.',
                'requirements' => "• Pendidikan minimal Diploma (D3) semua jurusan (diutamakan Psikologi/Manajemen).\n• Komunikatif, ramah, dan memiliki kemampuan interpersonal yang baik.\n• Teratur, rapi, dan terbiasa dengan tools administrasi perkantoran.\n• Mampu bekerja di bawah tekanan dengan jadwal yang dinamis."
            ]
        ];
 
        $firstJob = null;
        foreach ($jobsInfo as $idx => $job) {
            $createdJob = Job::create([
                'company_id' => $companiesMap[$job['company']],
                'category_id' => $categoriesMap[$job['category']],
                'title' => $job['title'],
                'slug' => $job['slug'],
                'description' => $job['description'],
                'requirements' => $job['requirements'],
                'skills' => ['Komunikasi', 'Kerja Sama Tim', 'Analisis Masalah'],
                'experience_years' => 1,
                'education_level' => 'S1',
                'employment_type' => $job['employment_type'],
                'location_type' => 'Remote',
                'city' => $job['city'],
                'salary_min' => $job['salary_min'],
                'salary_max' => $job['salary_max'],
                'salary_currency' => 'IDR',
                'status' => 'active',
                'is_featured' => true,
                'is_sponsored' => false,
                'is_urgent' => false,
            ]);
 
            if ($idx === 0) {
                $firstJob = $createdJob;
            }
        }
 
        // 10. Create Match Rule
        MatchRule::create([
            'skill_weight' => 40,
            'location_weight' => 15,
            'salary_weight' => 15,
            'education_weight' => 10,
            'experience_weight' => 20,
            'certification_weight' => 0,
            'is_active' => true,
        ]);
 
        // 11. Create Applications
        if ($firstJob) {
            Application::create([
                'job_id' => $firstJob->id,
                'candidate_id' => $candidateUser->id,
                'resume_path' => 'resumes/ahmad_rian_cv.pdf',
                'cover_letter' => 'Saya tertarik melamar posisi ini karena keahlian saya sangat cocok dengan kualifikasi yang dicari.',
                'match_score' => 88,
                'skill_score' => 90,
                'location_score' => 70,
                'experience_score' => 100,
                'salary_score' => 95,
                'education_score' => 100,
                'status' => 'Applied',
                'status_history' => [
                    ['status' => 'Applied', 'note' => 'Lamaran terkirim melalui platform MauLoker.', 'created_at' => now()->subDays(2)->toDateTimeString()],
                ],
            ]);
        }
 
        // 12. Create Salary Insights
        $salaryData = [
            ['job_title' => 'Frontend Developer', 'city' => 'Jakarta', 'salary_min' => 8000000.00, 'salary_max' => 18000000.00, 'salary_avg' => 12500000.00],
            ['job_title' => 'Frontend Developer', 'city' => 'Surabaya', 'salary_min' => 5000000.00, 'salary_max' => 10000000.00, 'salary_avg' => 7500000.00],
            ['job_title' => 'Backend Developer', 'city' => 'Jakarta', 'salary_min' => 9000000.00, 'salary_max' => 20000000.00, 'salary_avg' => 14000000.00],
            ['job_title' => 'Backend Developer', 'city' => 'Surabaya', 'salary_min' => 6000000.00, 'salary_max' => 12000000.00, 'salary_avg' => 8500000.00],
            ['job_title' => 'Mobile Developer', 'city' => 'Jakarta', 'salary_min' => 9500000.00, 'salary_max' => 22000000.00, 'salary_avg' => 15000000.00],
            ['job_title' => 'UI/UX Designer', 'city' => 'Jakarta', 'salary_min' => 6000000.00, 'salary_max' => 12000000.00, 'salary_avg' => 9000000.00],
        ];
        foreach ($salaryData as $sal) {
            SalaryInsight::create([
                'job_title' => $sal['job_title'],
                'city' => $sal['city'],
                'salary_min' => $sal['salary_min'],
                'salary_max' => $sal['salary_max'],
                'salary_avg' => $sal['salary_avg'],
                'benchmark_data' => [
                    'growth_rate' => '12%',
                    'fresh_graduate_average' => $sal['salary_min'] * 0.9,
                    'senior_level_average' => $sal['salary_max'] * 1.5,
                ]
            ]);
        }
 
        // 13. Create Career Roadmaps
        CareerRoadmap::create([
            'title' => 'Peta Jalan Karir Backend Developer',
            'slug' => 'backend-developer',
            'description' => 'Panduan karir lengkap untuk menjadi Backend Developer di Indonesia.',
            'steps' => [
                ['level' => 'Junior Backend Developer', 'skills' => 'PHP Dasar, MySQL, Git', 'salary_range' => 'Rp 4.5jt - Rp 7jt', 'description' => 'Memahami routing dasar, database SQL, dan version control Git.'],
                ['level' => 'Middle Backend Developer', 'skills' => 'Laravel Advanced, OOP, Rest API, Caching', 'salary_range' => 'Rp 7jt - Rp 14jt', 'description' => 'Membangun API, optimasi query database, menerapkan middleware, dan integrasi third party.'],
                ['level' => 'Senior Backend Developer', 'skills' => 'Software Architecture, Serverless, System Design, Unit Testing', 'salary_range' => 'Rp 14jt - Rp 25jt', 'description' => 'Merancang sistem terdistribusi, memimpin tim engineering, dan mengoptimasi infrastruktur.'],
            ],
        ]);

        CareerRoadmap::create([
            'title' => 'Peta Jalan Karir Frontend Developer',
            'slug' => 'frontend-developer',
            'description' => 'Panduan karir lengkap untuk menjadi Frontend Developer di Indonesia.',
            'steps' => [
                ['level' => 'Junior Frontend Developer', 'skills' => 'HTML, CSS, JavaScript, Git', 'salary_range' => 'Rp 4.5jt - Rp 6.5jt', 'description' => 'Membuat halaman web responsif, manipulasi DOM, dan menggunakan git untuk kolaborasi.'],
                ['level' => 'Middle Frontend Developer', 'skills' => 'VueJS / ReactJS, TailwindCSS, State Management, Vite', 'salary_range' => 'Rp 7jt - Rp 12jt', 'description' => 'Membangun Single Page Application (SPA), optimasi performa aset, dan integrasi API backend.'],
                ['level' => 'Senior Frontend Developer', 'skills' => 'NextJS / NuxtJS, TypeScript, Webpack, Unit Testing, CI/CD', 'salary_range' => 'Rp 12jt - Rp 22jt', 'description' => 'Merancang arsitektur micro-frontend, rendering SSR/SSG, memimpin tim frontend, dan standardisasi kode.'],
            ],
        ]);

        CareerRoadmap::create([
            'title' => 'Peta Jalan Karir UI/UX Designer',
            'slug' => 'ui-ux-designer',
            'description' => 'Panduan langkah demi langkah menjadi Desainer Produk Digital profesional.',
            'steps' => [
                ['level' => 'Junior UI/UX Designer', 'skills' => 'Figma, Wireframing, Prinsip Desain, Copywriting', 'salary_range' => 'Rp 4.5jt - Rp 6.5jt', 'description' => 'Membuat wireframe, mendesain mockup sederhana, dan berkolaborasi dalam prototyping produk.'],
                ['level' => 'Middle UI/UX Designer', 'skills' => 'User Research, Usability Testing, Design System, Interaction Design', 'salary_range' => 'Rp 7jt - Rp 11.5jt', 'description' => 'Melakukan riset pengguna, merancang framework desain sistem perusahaan, dan melakukan uji usabilitas produk.'],
                ['level' => 'Senior Product Designer', 'skills' => 'Product Strategy, UX Metrics, Stakeholder Management, Mentorship', 'salary_range' => 'Rp 11.5jt - Rp 20jt', 'description' => 'Menyelaraskan strategi desain dengan tujuan bisnis, menetapkan KPI desain, dan memimpin arah visual produk.'],
            ],
        ]);

        CareerRoadmap::create([
            'title' => 'Peta Jalan Karir Digital Marketer',
            'slug' => 'digital-marketer',
            'description' => 'Jalur karir lengkap menjadi ahli pemasaran digital terkemuka.',
            'steps' => [
                ['level' => 'Junior Digital Marketing', 'skills' => 'Copywriting, Social Media Admin, Canva, Basic SEO', 'salary_range' => 'Rp 4jt - Rp 6jt', 'description' => 'Mengelola konten media sosial harian, menulis caption menarik, dan melakukan riset kata kunci dasar.'],
                ['level' => 'Digital Marketing Specialist', 'skills' => 'Google Ads, Facebook Ads, Google Analytics, SEO Advanced', 'salary_range' => 'Rp 6.5jt - Rp 12jt', 'description' => 'Merancang kampanye iklan berbayar (PPC), mengoptimasi SEO on-page & off-page, serta menganalisis conversion rate.'],
                ['level' => 'Digital Marketing Manager', 'skills' => 'Growth Hacking, Marketing Strategy, Budget Management, Leadership', 'salary_range' => 'Rp 12.5jt - Rp 22.5jt', 'description' => 'Memimpin tim marketing kreatif, mengatur alokasi budget bulanan, dan merancang strategi akuisisi pengguna berskala nasional.'],
            ],
        ]);

        // 14. Create Blog Categories
        $tipsCat = BlogCategory::create(['name' => 'Tips Karir', 'slug' => 'tips-karir', 'description' => 'Artikel tentang tips mencari kerja dan navigasi karir.']);
        $cvCat = BlogCategory::create(['name' => 'CV & Resume', 'slug' => 'cv-resume', 'description' => 'Panduan membuat resume ATS Friendly.']);
        $interviewCat = BlogCategory::create(['name' => 'Persiapan Wawancara', 'slug' => 'persiapan-wawancara', 'description' => 'Tips sukses menjawab pertanyaan HRD saat interview kerja.']);

        // 15. Create Blogs
        Blog::create([
            'title' => 'Cara Membuat CV ATS Friendly yang Lolos Screening HRD',
            'slug' => 'cara-membuat-cv-ats-friendly',
            'content' => '<p>CV ATS (Applicant Tracking System) Friendly adalah format resume yang dirancang agar dapat dengan mudah dibaca oleh software penyaring CV yang digunakan oleh banyak perusahaan besar.</p><p>Untuk membuat CV yang lolos screening ini, pastikan menggunakan font standar seperti Arial atau Calibri, hindari penggunaan grafik/tabel yang kompleks, dan selalu gunakan kata kunci yang relevan dengan deskripsi pekerjaan yang Anda lamar.</p>',
            'category_id' => $cvCat->id,
            'tags' => 'CV, ATS, Resume, Tips Karir',
            'seo_title' => 'Cara Membuat CV ATS Friendly Lolos HRD - MauLoker',
            'seo_description' => 'Mau tahu cara membuat CV ATS Friendly yang mudah lolos seleksi otomatis HRD?',
            'view_count' => 245,
            'status' => 'published',
            'is_featured' => true,
        ]);

        Blog::create([
            'title' => '5 Pertanyaan Jebakan saat Wawancara Kerja dan Cara Menjawabnya',
            'slug' => 'pertanyaan-jebakan-wawancara-kerja',
            'content' => '<p>Wawancara kerja seringkali diisi dengan pertanyaan yang terlihat sederhana namun sebenarnya adalah jebakan untuk menguji kepribadian dan kompetensi Anda.</p><p>Misalnya, pertanyaan "Apa kelemahan terbesar Anda?". Cara terbaik untuk menjawabnya adalah dengan menyebutkan kelemahan yang nyata namun segera diikuti dengan solusi atau upaya konkret yang sedang Anda lakukan untuk memperbaikinya.</p>',
            'category_id' => $interviewCat->id,
            'tags' => 'Interview, Wawancara, HRD, Tips Karir',
            'seo_title' => 'Tips Menjawab Pertanyaan Jebakan Wawancara Kerja - MauLoker',
            'seo_description' => 'Pelajari cara menjawab pertanyaan interview jebakan dari HRD secara cerdas dan profesional.',
            'view_count' => 189,
            'status' => 'published',
            'is_featured' => false,
        ]);

        Blog::create([
            'title' => 'Pentingnya Etika Berkomunikasi Profesional Melalui WhatsApp',
            'slug' => 'etika-komunikasi-whatsapp-professional',
            'content' => '<p>Di era digital, komunikasi bisnis dan rekrutmen sering kali beralih ke WhatsApp. Namun, banyak pencari kerja lupa menjaga profesionalitas saat mengirim pesan ke HRD.</p><p>Selalu perkenalkan diri terlebih dahulu, gunakan bahasa yang sopan dan formal, hindari mengirim pesan di luar jam kerja, serta jangan pernah mengirim file lamaran tanpa pengantar pesan yang jelas.</p>',
            'category_id' => $tipsCat->id,
            'tags' => 'Etika, WhatsApp, Komunikasi, Rekrutmen',
            'seo_title' => 'Etika Mengirim Pesan WhatsApp ke HRD - MauLoker',
            'seo_description' => 'Tips menjaga etika berkomunikasi profesional saat melamar pekerjaan melalui WhatsApp.',
            'view_count' => 312,
            'status' => 'published',
            'is_featured' => true,
        ]);

        // 16. Create CV Templates
        CvTemplate::create([
            'name' => 'Classic ATS Simple',
            'slug' => 'classic-ats',
            'layout_blade' => 'ats_classic',
            'is_ats_friendly' => true,
            'status' => true,
        ]);

        // 17. Create Menus
        Menu::create([
            'name' => 'Navbar Menu',
            'slug' => 'navbar',
            'items_json' => [
                ['label' => 'Beranda', 'url' => '/'],
                ['label' => 'Cari Lowongan', 'url' => '/jobs'],
                ['label' => 'Blog Karir', 'url' => '/blog'],
            ],
        ]);
 
        // 18. Create SEO Pages
        SeoPage::create([
            'path_pattern' => '/',
            'meta_title' => 'MauLoker - Temukan Loker Halalmu! Portal Kerja Indonesia',
            'meta_description' => 'Cari dan lamar lowongan kerja terbaik di Indonesia.',
            'schema_type' => 'WebSite',
            'schema_data' => [
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => 'MauLoker',
                'url' => 'http://localhost',
            ]
        ]);
 
        // 19. Create Banners
        Banner::create([
            'title' => 'Siap Pindah Kerja? Mulai Karir Impianmu!',
            'subtitle' => 'MULAI KARIR TERBAIKMU DI SINI!',
            'image_path' => '/images/hero_muslim_duo.png',
            'link_url' => '/jobs',
            'position' => 'homepage_hero',
            'status' => true,
        ]);
 
        // 20. Create Announcements
        Announcement::create([
            'title' => 'Selamat Datang di MauLoker',
            'content' => 'Temukan pekerjaan impian Anda atau pasang lowongan gratis sekarang.',
            'type' => 'info',
            'target_roles' => 'all',
            'status' => true,
        ]);
    }
}

