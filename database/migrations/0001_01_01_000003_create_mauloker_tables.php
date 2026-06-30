<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Settings Table
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        // 2. Themes Table
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(false);
            $table->string('primary_color')->default('#10B981');
            $table->string('primary_hover')->default('#059669');
            $table->string('primary_dark')->default('#047857');
            $table->string('light_bg')->default('#FFFFFF');
            $table->string('light_card')->default('#F8FAFC');
            $table->string('dark_bg')->default('#0B1220');
            $table->string('dark_card')->default('#111827');
            $table->string('text_light')->default('#111827');
            $table->string('text_dark')->default('#F9FAFB');
            $table->string('border_radius')->default('0.5rem'); // rounded-lg
            $table->string('font_family')->default('Instrument Sans');
            $table->string('button_style')->default('rounded'); // rounded, square, pill
            $table->string('card_style')->default('glassmorphism'); // glassmorphism, flat, bordered
            $table->timestamps();
        });

        // 3. Ad Positions
        Schema::create('ad_positions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // 4. Ads Table
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position_code');
            $table->boolean('status')->default(true);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('target_device')->default('all'); // all, desktop, mobile
            $table->string('target_page')->nullable(); // e.g., homepage, search, detail, blog
            $table->unsignedBigInteger('target_category_id')->nullable();
            $table->string('target_city')->nullable();
            $table->string('format_type')->default('image'); // image, html, js, google_adsense, affiliate, iframe, video, native_card
            $table->text('code_content')->nullable(); // For custom HTML, JS, Adsense script
            $table->string('image_path')->nullable();
            $table->string('destination_url')->nullable();
            $table->integer('priority')->default(0);
            $table->integer('max_impressions')->nullable();
            $table->integer('max_clicks')->nullable();
            $table->timestamps();
        });

        // 5. Ad Statistics
        Schema::create('ad_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_id')->constrained('ads')->onDelete('cascade');
            $table->date('date');
            $table->integer('impressions')->default(0);
            $table->integer('clicks')->default(0);
            $table->timestamps();
        });

        // 6. Companies Table
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable(); // City
            $table->text('address')->nullable();
            $table->string('scale')->nullable(); // Size of company, e.g. 10-50 employees
            $table->boolean('verified')->default(false);
            $table->double('reputation_score', 3, 1)->default(5.0);
            $table->string('response_time')->default('Fast Response');
            $table->boolean('top_employer')->default(false);
            $table->boolean('premium')->default(false);
            $table->string('status')->default('active'); // active, suspended
            $table->timestamps();
        });

        // 7. Company Badges
        Schema::create('company_badges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('badge_name'); // e.g. Verified, Premium, Top Employer
            $table->string('badge_type')->default('custom'); // reputation, response, status, custom
            $table->string('icon')->nullable(); // Icon class or SVG string
            $table->string('color')->nullable(); // CSS class or Hex code
            $table->timestamps();
        });

        // 8. Job Categories
        Schema::create('job_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // 9. Jobs Table (Job listings)
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('job_categories')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->text('skills')->nullable(); // JSON or comma-separated tags
            $table->integer('experience_years')->default(0);
            $table->string('education_level')->nullable(); // e.g., SMA/SMK, D3, S1, S2
            $table->string('employment_type')->default('Full-time'); // Full-time, Part-time, Contract, Internship, Freelance
            $table->string('location_type')->default('Onsite'); // Onsite, Remote, Hybrid
            $table->string('city'); // City name (e.g. Jakarta, Surabaya)
            $table->decimal('salary_min', 15, 2)->nullable();
            $table->decimal('salary_max', 15, 2)->nullable();
            $table->string('salary_currency')->default('IDR');
            $table->text('benefits')->nullable(); // JSON or comma-separated
            $table->string('status')->default('active'); // active, closed, draft
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_sponsored')->default(false);
            $table->boolean('is_urgent')->default(false);
            $table->integer('views_count')->default(0);
            $table->integer('applies_count')->default(0);
            $table->timestamps();
        });

        // 10. Applications Table
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade');
            $table->foreignId('candidate_id')->constrained('users')->onDelete('cascade');
            $table->string('resume_path')->nullable();
            $table->text('cover_letter')->nullable();
            $table->integer('match_score')->default(0);
            $table->integer('skill_score')->default(0);
            $table->integer('location_score')->default(0);
            $table->integer('experience_score')->default(0);
            $table->integer('salary_score')->default(0);
            $table->integer('education_score')->default(0);
            $table->string('status')->default('Applied'); // Applied, Reviewed, Interview, Accepted, Rejected
            $table->json('status_history')->nullable(); // JSON timeline tracker
            $table->timestamps();
        });

        // 11. Messages Table (Realtime Chat Polling)
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('job_id')->nullable()->constrained('jobs')->onDelete('set null');
            $table->text('message')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_type')->nullable(); // image, cv, etc.
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        // 12. Salary Insights
        Schema::create('salary_insights', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('city');
            $table->decimal('salary_min', 15, 2);
            $table->decimal('salary_max', 15, 2);
            $table->decimal('salary_avg', 15, 2);
            $table->json('benchmark_data')->nullable();
            $table->timestamps();
        });

        // 13. Career Roadmaps
        Schema::create('career_roadmaps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->json('steps'); // List of steps Junior -> Middle -> Senior...
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 14. Blog Categories
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 15. Blogs Table
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->foreignId('category_id')->constrained('blog_categories')->onDelete('cascade');
            $table->string('tags')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->integer('view_count')->default(0);
            $table->string('status')->default('published'); // draft, published
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        // 16. SEO Pages
        Schema::create('seo_pages', function (Blueprint $table) {
            $table->id();
            $table->string('path_pattern')->unique(); // e.g. '/jobs', '/company/*', '/jobs/{slug}'
            $table->string('meta_title');
            $table->text('meta_description');
            $table->string('og_image')->nullable();
            $table->string('canonical')->nullable();
            $table->string('schema_type')->nullable(); // JobPosting, Organization, Article, WebSite, FAQPage, BreadcrumbList
            $table->json('schema_data')->nullable();
            $table->timestamps();
        });

        // 17. Menus
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->json('items_json'); // JSON array of menu links
            $table->timestamps();
        });

        // 18. Banners
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('image_path');
            $table->string('link_url')->nullable();
            $table->string('target')->default('_self'); // _self, _blank
            $table->string('position')->default('homepage_hero');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // 19. Announcements
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('type')->default('info'); // info, warning, danger
            $table->string('target_roles')->default('all'); // all, candidate, company
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // 20. CV Templates
        Schema::create('cv_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->string('layout_blade'); // Blade view file name
            $table->boolean('is_ats_friendly')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // 21. Match Rules
        Schema::create('match_rules', function (Blueprint $table) {
            $table->id();
            $table->integer('skill_weight')->default(40);
            $table->integer('location_weight')->default(15);
            $table->integer('salary_weight')->default(15);
            $table->integer('education_weight')->default(10);
            $table->integer('experience_weight')->default(20);
            $table->integer('certification_weight')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 22. Analytics
        Schema::create('analytics', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->json('event_data')->nullable(); // details about pages visited, click coordinate, CTR, ad clicks, etc.
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics');
        Schema::dropIfExists('match_rules');
        Schema::dropIfExists('cv_templates');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('seo_pages');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_categories');
        Schema::dropIfExists('career_roadmaps');
        Schema::dropIfExists('salary_insights');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('applications');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_categories');
        Schema::dropIfExists('company_badges');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('ad_statistics');
        Schema::dropIfExists('ads');
        Schema::dropIfExists('ad_positions');
        Schema::dropIfExists('themes');
        Schema::dropIfExists('settings');
    }
};
