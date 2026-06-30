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
            'name' => 'MauLoker Admin',
            'email' => 'admin@mauloker.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'location' => 'Jakarta',
            'bio' => 'App Administrator',
        ]);
        $adminUser->assignRole($adminRole);

        $companyUser1 = User::create([
            'name' => 'Rozitech Software',
            'email' => 'hrd@rozitech.com',
            'password' => Hash::make('password123'),
            'role' => 'company',
            'phone' => '081234567891',
            'location' => 'Surabaya',
            'bio' => 'Premium software developer house in Surabaya.',
        ]);
        $companyUser1->assignRole($companyRole);

        $companyUser2 = User::create([
            'name' => 'Goojek Indonesia',
            'email' => 'recruitment@goojek.com',
            'password' => Hash::make('password123'),
            'role' => 'company',
            'phone' => '081234567892',
            'location' => 'Jakarta',
            'bio' => 'Indonesia\'s leading on-demand service and tech company.',
        ]);
        $companyUser2->assignRole($companyRole);

        $candidateUser = User::create([
            'name' => 'Ahmad Rian',
            'email' => 'rian@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'candidate',
            'phone' => '081234567893',
            'location' => 'Jakarta',
            'bio' => 'Passionate Frontend and Laravel Developer.',
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
            'tagline' => 'Temukan pekerjaan impianmu.',
            'contact_whatsapp' => '+6281234567890',
            'contact_email' => 'support@mauloker.com',
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

        // 4. Create Theme Settings
        Theme::create([
            'name' => 'Default Emerald Theme',
            'is_active' => true,
            'primary_color' => '#10B981',
            'primary_hover' => '#059669',
            'primary_dark' => '#047857',
            'light_bg' => '#FFFFFF',
            'light_card' => '#F8FAFC',
            'dark_bg' => '#0B1220',
            'dark_card' => '#111827',
            'text_light' => '#111827',
            'text_dark' => '#F9FAFB',
            'border_radius' => '0.5rem',
            'font_family' => 'Instrument Sans',
            'button_style' => 'rounded',
            'card_style' => 'glassmorphism',
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
            'name' => 'Rozitech Hiring Banner',
            'position_code' => 'job_search_sidebar',
            'status' => true,
            'start_date' => now(),
            'end_date' => now()->addMonths(6),
            'target_device' => 'all',
            'format_type' => 'html',
            'code_content' => '<div class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white p-6 rounded-xl shadow-md text-center">
                <h4 class="font-bold text-lg mb-1">Developer Ingin Berkembang?</h4>
                <p class="text-xs mb-4">Gabung di Rozitech Software Surabaya sekarang!</p>
                <a href="/company/rozitech" class="bg-white text-emerald-600 font-semibold px-4 py-2 rounded-lg text-xs hover:bg-slate-100 transition inline-block">Lamar Sekarang</a>
            </div>',
            'priority' => 10,
        ]);

        Ad::create([
            'name' => 'Google AdSense Leaderboard',
            'position_code' => 'homepage_hero',
            'status' => true,
            'format_type' => 'google_adsense',
            'code_content' => '<!-- Google Adsense Placeholder -->
            <div class="flex items-center justify-center bg-slate-100 border border-slate-200 text-slate-400 py-3 text-xs font-mono rounded w-full h-[90px]">
                Google AdSense Banner (728x90)
            </div>',
            'priority' => 5,
        ]);

        Ad::create([
            'name' => 'Candidate Dashboard Promotion',
            'position_code' => 'dashboard_candidate',
            'status' => true,
            'format_type' => 'html',
            'code_content' => '<div class="bg-amber-50 border border-amber-200 rounded-lg p-4 flex items-center justify-between text-amber-900">
                <div>
                    <h5 class="font-bold text-sm">Mau Review CV ATS Gratis?</h5>
                    <p class="text-xs">Upgrade profile dan tingkatkan kemungkinan lolos hingga 85%.</p>
                </div>
                <a href="#cv-builder" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-3 py-1.5 rounded text-xs transition">Coba Builder</a>
            </div>',
            'priority' => 1,
        ]);

        // 7. Create Companies
        $company1 = Company::create([
            'user_id' => $companyUser1->id,
            'name' => 'Rozitech Software',
            'slug' => 'rozitech',
            'logo' => null,
            'banner' => null,
            'category' => 'Technology & IT Solutions',
            'description' => 'Rozitech Software adalah studio pengembangan aplikasi web & mobile terkemuka yang berbasis di Surabaya, Indonesia. Kami berfokus pada teknologi mutakhir seperti Laravel, VueJS, React, Flutter, dan solusi berbasis Cloud.',
            'website' => 'https://rozitech.com',
            'email' => 'contact@rozitech.com',
            'phone' => '081234567891',
            'location' => 'Surabaya',
            'address' => 'Jl. Dharmahusada No. 12, Gubeng, Surabaya, Jawa Timur 60115',
            'scale' => '10-50 karyawan',
            'verified' => true,
            'reputation_score' => 4.9,
            'response_time' => 'Fast Response',
            'top_employer' => true,
            'premium' => true,
            'status' => 'active',
        ]);

        CompanyBadge::create([
            'company_id' => $company1->id,
            'badge_name' => 'Top Employer',
            'badge_type' => 'reputation',
            'icon' => 'award',
            'color' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
        ]);
        CompanyBadge::create([
            'company_id' => $company1->id,
            'badge_name' => 'Verified',
            'badge_type' => 'status',
            'icon' => 'check-circle',
            'color' => 'bg-blue-100 text-blue-800 border-blue-200',
        ]);
        CompanyBadge::create([
            'company_id' => $company1->id,
            'badge_name' => 'Fast Response',
            'badge_type' => 'response',
            'icon' => 'zap',
            'color' => 'bg-amber-100 text-amber-800 border-amber-200',
        ]);

        $company2 = Company::create([
            'user_id' => $companyUser2->id,
            'name' => 'Goojek Indonesia',
            'slug' => 'goojek',
            'logo' => null,
            'banner' => null,
            'category' => 'Transportation & Logistics',
            'description' => 'Goojek adalah perusahaan teknologi terkemuka di Asia Tenggara yang memelopori model super-app. Kami menyediakan akses ke berbagai layanan termasuk transportasi, pengantaran makanan, pembayaran logistik, dan banyak lagi.',
            'website' => 'https://goojek.com',
            'email' => 'careers@goojek.com',
            'phone' => '081234567892',
            'location' => 'Jakarta',
            'address' => 'Pasaraya Blok M Gedung B, Jl. Iskandarsyah II No.7, Jakarta Selatan 12160',
            'scale' => '1000+ karyawan',
            'verified' => true,
            'reputation_score' => 4.8,
            'response_time' => 'Within a day',
            'top_employer' => true,
            'premium' => true,
            'status' => 'active',
        ]);

        CompanyBadge::create([
            'company_id' => $company2->id,
            'badge_name' => 'Verified',
            'badge_type' => 'status',
            'icon' => 'check-circle',
            'color' => 'bg-blue-100 text-blue-800 border-blue-200',
        ]);
        CompanyBadge::create([
            'company_id' => $company2->id,
            'badge_name' => 'Premium',
            'badge_type' => 'status',
            'icon' => 'star',
            'color' => 'bg-purple-100 text-purple-800 border-purple-200',
        ]);

        // 8. Create Job Categories
        $categoriesData = [
            ['name' => 'Programming & Software Development', 'slug' => 'programming', 'icon' => 'code-xml', 'color' => '#10B981'],
            ['name' => 'Network & Infrastructure', 'slug' => 'networking', 'icon' => 'network', 'color' => '#3B82F6'],
            ['name' => 'Design & Creative', 'slug' => 'design', 'icon' => 'palette', 'color' => '#EC4899'],
            ['name' => 'Digital Marketing', 'slug' => 'marketing', 'icon' => 'megaphone', 'color' => '#F59E0B'],
            ['name' => 'Finance & Accounting', 'slug' => 'finance', 'icon' => 'wallet', 'color' => '#8B5CF6'],
            ['name' => 'Customer Service & Operations', 'slug' => 'customer-service', 'icon' => 'headset', 'color' => '#EF4444'],
            ['name' => 'Product Management', 'slug' => 'product-management', 'icon' => 'kanban', 'color' => '#06B6D4'],
            ['name' => 'Human Resources', 'slug' => 'human-resources', 'icon' => 'users-round', 'color' => '#14B8A6'],
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

        // 9. Create Jobs
        $job1 = Job::create([
            'company_id' => $company1->id,
            'category_id' => $categoriesMap['programming'],
            'title' => 'Backend Laravel Developer',
            'slug' => 'backend-laravel-surabaya',
            'description' => 'Kami mencari Backend Developer Laravel berbakat untuk bergabung dengan tim kami di Surabaya. Anda akan bertanggung jawab untuk membangun REST API berkinerja tinggi, mengelola basis data MySQL, dan merancang logika aplikasi yang skalabel.',
            'requirements' => "• Pengalaman minimal 2 tahun menggunakan PHP & Laravel.\n• Memahami database relational seperti MySQL dengan baik.\n• Menguasai Git Version Control.\n• Memahami konsep Clean Code dan Design Patterns.\n• Bersedia bekerja onsite di Surabaya.",
            'skills' => ['Laravel', 'PHP', 'MySQL', 'Git', 'REST API', 'AlpineJS'],
            'experience_years' => 2,
            'education_level' => 'S1',
            'employment_type' => 'Full-time',
            'location_type' => 'Onsite',
            'city' => 'Surabaya',
            'salary_min' => 7000000.00,
            'salary_max' => 12000000.00,
            'benefits' => "• Gaji Kompetitif\n• BPJS Kesehatan & Ketenagakerjaan\n• Free Lunch & Coffee\n• Career Development Plan\n• Flexible Working Hours",
            'status' => 'active',
            'is_featured' => true,
            'is_sponsored' => true,
            'is_urgent' => false,
            'views_count' => 145,
            'applies_count' => 12,
        ]);

        $job2 = Job::create([
            'company_id' => $company2->id,
            'category_id' => $categoriesMap['programming'],
            'title' => 'Frontend Developer (Vue / Tailwind)',
            'slug' => 'frontend-developer-jakarta',
            'description' => 'Goojek Indonesia membuka lowongan Frontend Developer di Jakarta. Anda akan bertanggung jawab untuk merancang antarmuka pengguna super-app kami pada platform web, memastikan integrasi SEO friendly, dan kecepatan rendering yang cepat.',
            'requirements' => "• Pengalaman minimal 3 tahun di bidang Frontend Development.\n• Mahir menggunakan Vue.js, AlpineJS, atau React.\n• Menguasai TailwindCSS atau Bootstrap.\n• Memiliki pemahaman kuat mengenai Web Performance & SEO.\n• Mampu berkomunikasi dalam tim dengan baik.",
            'skills' => ['VueJS', 'AlpineJS', 'TailwindCSS', 'JavaScript', 'HTML5', 'CSS3', 'SEO'],
            'experience_years' => 3,
            'education_level' => 'S1',
            'employment_type' => 'Full-time',
            'location_type' => 'Hybrid',
            'city' => 'Jakarta',
            'salary_min' => 12000000.00,
            'salary_max' => 18000000.00,
            'benefits' => "• Annual Bonus\n• Comprehensive Health Insurance\n• Wellness allowance\n• Remote work flexibilities\n• MacBook Pro provided",
            'status' => 'active',
            'is_featured' => true,
            'is_sponsored' => false,
            'is_urgent' => true,
            'views_count' => 312,
            'applies_count' => 45,
        ]);

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
        Application::create([
            'job_id' => $job1->id,
            'candidate_id' => $candidateUser->id,
            'resume_path' => 'resumes/ahmad_rian_cv.pdf',
            'cover_letter' => 'Saya tertarik melamar posisi ini karena keahlian saya di bidang Laravel dan MySQL sangat cocok dengan kualifikasi yang dicari oleh Rozitech.',
            'match_score' => 88,
            'skill_score' => 90,
            'location_score' => 70, // candidate is in Jakarta, job is in Surabaya
            'experience_score' => 100, // candidate has 2 yrs, job needs 2 yrs
            'salary_score' => 95, // candidate expected 8.5jt, job salary is 7-12jt
            'education_score' => 100, // candidate is S1, job needs S1
            'status' => 'Applied',
            'status_history' => [
                ['status' => 'Applied', 'note' => 'Lamaran terkirim melalui platform MauLoker.', 'created_at' => now()->subDays(2)->toDateTimeString()],
            ],
        ]);

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
            'title' => 'Backend Developer Roadmap',
            'slug' => 'backend-developer',
            'description' => 'Panduan karir lengkap untuk menjadi Backend Developer di Indonesia.',
            'steps' => [
                ['level' => 'Junior Backend Developer', 'skills' => 'PHP Dasar, MySQL, Git', 'salary_range' => 'Rp 4.5jt - Rp 7jt', 'description' => 'Memahami routing dasar, database SQL, dan version control.'],
                ['level' => 'Middle Backend Developer', 'skills' => 'Laravel Advanced, OOP, Rest API, Caching', 'salary_range' => 'Rp 7jt - Rp 14jt', 'description' => 'Membangun API, optimasi query database, menerapkan middleware, dan integrasi third party.'],
                ['level' => 'Senior Backend Developer', 'skills' => 'Software Architecture, Serverless, System Design, Unit Testing', 'salary_range' => 'Rp 14jt - Rp 25jt', 'description' => 'Merancang sistem terdistribusi, memimpin tim engineering, dan mengoptimasi infrastruktur.'],
                ['level' => 'Lead Backend Engineer / Architect', 'skills' => 'Tech Stack Evaluation, Product Strategy, High Performance Architecture', 'salary_range' => 'Rp 25jt+', 'description' => 'Mengarahkan keputusan arsitektur sistem skala besar dan bekerjasama dengan VP of Engineering.'],
            ],
        ]);

        CareerRoadmap::create([
            'title' => 'Frontend Developer Roadmap',
            'slug' => 'frontend-developer',
            'description' => 'Langkah-langkah terstruktur dari pemula hingga menjadi ahli Frontend.',
            'steps' => [
                ['level' => 'Junior Frontend Developer', 'skills' => 'HTML, CSS, Vanilla JavaScript', 'salary_range' => 'Rp 4jt - Rp 6.5jt', 'description' => 'Mampu membuat antarmuka halaman web statis responsive.'],
                ['level' => 'Middle Frontend Developer', 'skills' => 'Vue.js / React, TailwindCSS, State Management, Vite', 'salary_range' => 'Rp 6.5jt - Rp 13jt', 'description' => 'Membangun Single Page Application (SPA), interaksi state dinamis, dan optimasi load speed.'],
                ['level' => 'Senior Frontend Developer', 'skills' => 'NextJS / Nuxt, SSR, Web Performance, Micro-frontend, Testing', 'salary_range' => 'Rp 13jt - Rp 22jt', 'description' => 'Arsitektur web SSR, SEO rendering, component library building, dan monitoring core web vitals.'],
            ],
        ]);

        // 14. Create Blog Categories
        $tipsCat = BlogCategory::create(['name' => 'Tips Karir', 'slug' => 'tips-karir', 'description' => 'Artikel tentang tips mencari kerja dan navigasi karir.']);
        $cvCat = BlogCategory::create(['name' => 'CV & Resume', 'slug' => 'cv-resume', 'description' => 'Panduan membuat resume ATS Friendly.']);
        $interviewCat = BlogCategory::create(['name' => 'Interview', 'slug' => 'interview', 'description' => 'Cara menjawab pertanyaan wawancara kerja.']);

        // 15. Create Blogs
        Blog::create([
            'title' => 'Cara Membuat CV ATS Friendly yang Lolos Screening HRD',
            'slug' => 'cara-membuat-cv-ats-friendly',
            'content' => '<p>CV ATS (Applicant Tracking System) Friendly adalah format resume yang dirancang agar dapat dengan mudah dibaca oleh software penyaring CV yang digunakan oleh banyak perusahaan besar.</p><h5>Langkah-langkah Membuat CV ATS Friendly:</h5><ol><li><strong>Gunakan Layout Satu Kolom:</strong> Hindari tabel bersarang atau layout multi-kolom yang rumit.</li><li><strong>Hindari Elemen Grafik Berlebihan:</strong> Jangan gunakan chart keahlian berbentuk bintang, ikon, atau diagram warna-warni.</li><li><strong>Gunakan Font Standar:</strong> Pilih font seperti Arial, Calibri, Times New Roman, atau Instrument Sans.</li><li><strong>Cantumkan Kata Kunci Relevan:</strong> Masukkan skill yang secara spesifik tercantum pada deskripsi lowongan kerja.</li></ol><p>Gunakan Resume Builder di MauLoker untuk membuat CV ATS Friendly Anda langsung jadi dalam format PDF secara gratis!</p>',
            'category_id' => $cvCat->id,
            'tags' => 'CV, ATS, Resume, Tips Karir',
            'seo_title' => 'Cara Membuat CV ATS Friendly Lolos HRD - MauLoker',
            'seo_description' => 'Mau tahu cara membuat CV ATS Friendly yang mudah lolos seleksi otomatis HRD? Simak tutorial lengkap, contoh template, dan tips karirnya di sini.',
            'view_count' => 245,
            'status' => 'published',
            'is_featured' => true,
        ]);

        Blog::create([
            'title' => 'Pertanyaan Menjebak Saat Wawancara Kerja dan Cara Menjawabnya',
            'slug' => 'pertanyaan-menjebak-saat-wawancara',
            'content' => '<p>Wawancara kerja adalah tahapan penting. Seringkali HRD mengajukan pertanyaan yang terdengar sederhana tapi sebenarnya menjebak.</p><h5>Contoh Pertanyaan dan Cara Menjawab:</h5><p><strong>1. "Apa kelemahan terbesar Anda?"</strong><br><em>Tips Menjawab:</em> Jangan pernah bilang "saya tidak punya kelemahan" atau "saya orangnya terlalu perfeksionis". Sebutkan kelemahan nyata yang tidak merusak peran utama, lalu jelaskan apa langkah yang sedang Anda lakukan untuk memperbaikinya.</p><p><strong>2. "Mengapa kami harus menerima Anda bekerja di sini?"</strong><br><em>Tips Menjawab:</em> Hubungkan keahlian Anda dengan masalah spesifik yang sedang dihadapi perusahaan yang Anda ketahui dari riset Anda.</p>',
            'category_id' => $interviewCat->id,
            'tags' => 'Interview, Wawancara, HRD, Tips Karir',
            'seo_title' => 'Tips Menjawab Pertanyaan Interview Kerja Menjebak - MauLoker',
            'seo_description' => 'Panduan lengkap cara menjawab pertanyaan jebakan interview kerja dari HRD seperti kelemahan diri, ekspektasi gaji, dan alasan resign.',
            'view_count' => 189,
            'status' => 'published',
            'is_featured' => false,
        ]);

        // 16. Create CV Templates
        CvTemplate::create([
            'name' => 'Classic ATS Simple',
            'slug' => 'classic-ats',
            'layout_blade' => 'ats_classic',
            'is_ats_friendly' => true,
            'status' => true,
        ]);

        CvTemplate::create([
            'name' => 'Modern Professional',
            'slug' => 'modern-prof',
            'layout_blade' => 'modern_professional',
            'is_ats_friendly' => true,
            'status' => true,
        ]);

        // 17. Create Menus
        Menu::create([
            'name' => 'Navbar Menu',
            'slug' => 'navbar',
            'items_json' => [
                ['label' => 'Cari Lowongan', 'url' => '/jobs'],
                ['label' => 'Blog Karir', 'url' => '/blog'],
                ['label' => 'Riset Gaji', 'url' => '/salary/insight'],
                ['label' => 'Roadmap Karir', 'url' => '/career/roadmap'],
            ],
        ]);

        // 18. Create SEO Pages
        SeoPage::create([
            'path_pattern' => '/',
            'meta_title' => 'MauLoker - Temukan Pekerjaan Impianmu di Indonesia',
            'meta_description' => 'Cari dan lamar lowongan kerja terbaik di Indonesia. MauLoker menyediakan pencarian kerja ringan, cepat, SEO-friendly, dan gratis.',
            'schema_type' => 'WebSite',
            'schema_data' => [
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => 'MauLoker',
                'url' => 'http://localhost',
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => 'http://localhost/jobs?q={search_term_string}',
                    'query-input' => 'required name=search_term_string'
                ]
            ]
        ]);

        SeoPage::create([
            'path_pattern' => '/jobs',
            'meta_title' => 'Cari Lowongan Kerja Terbaru di Indonesia - MauLoker',
            'meta_description' => 'Temukan ribuan lowongan kerja terverifikasi dari perusahaan terkemuka di Jakarta, Surabaya, dan kota lainnya di Indonesia. Filter berdasarkan gaji, remote, dan pengalaman.',
            'schema_type' => 'FAQPage',
            'schema_data' => [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => [
                    [
                        '@type' => 'Question',
                        'name' => 'Apakah melamar pekerjaan di MauLoker gratis?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Ya, seluruh fitur pencarian, CV builder, ATS score checker, dan lamaran di MauLoker 100% gratis untuk kandidat.'
                        ]
                    ]
                ]
            ]
        ]);

        // 19. Create Banners
        Banner::create([
            'title' => 'Temukan Pekerjaan Impianmu Lebih Cepat',
            'subtitle' => 'Pencarian kerja ringan, modern, PWA support, dan 100% gratis tanpa biaya perantara.',
            'image_path' => 'banners/hero_home.jpg',
            'link_url' => '/jobs',
            'position' => 'homepage_hero',
            'status' => true,
        ]);

        // 20. Create Announcements
        Announcement::create([
            'title' => 'Selamat Datang di MauLoker!',
            'content' => 'Gunakan fitur ATS Resume Builder dan Match Score kami secara gratis untuk mempermudah Anda mendapatkan pekerjaan impian.',
            'type' => 'info',
            'target_roles' => 'all',
            'status' => true,
        ]);
    }
}
