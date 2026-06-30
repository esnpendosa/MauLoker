<div class="space-y-16 pb-16">
    <!-- Hero Section with Banner / Glassmorphism Search -->
    <div class="relative bg-slate-950 dark:bg-black py-20 px-4 sm:px-6 lg:px-8 overflow-hidden rounded-b-[2.5rem] shadow-2xl border-b border-slate-900">
        <!-- Background Gradients -->
        <div class="absolute inset-0 opacity-30 mix-blend-color-dodge">
            <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] rounded-full bg-primary/20 blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] rounded-full bg-emerald-500/10 blur-[100px]"></div>
        </div>

        <div class="relative max-w-5xl mx-auto text-center space-y-8 z-10">
            <div class="space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary border border-primary/20">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                    Mencari kerja kini 10x lebih cepat
                </span>
                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white">
                    Temukan Pekerjaan <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-emerald-400">Impianmu</span>
                </h1>
                <p class="text-base sm:text-lg text-slate-400 max-w-2xl mx-auto">
                    MauLoker membantu ribuan profesional Indonesia menemukan karir terbaik mereka. Ringan, cepat, ramah ATS, dan 100% gratis.
                </p>
            </div>

            <!-- Search Form -->
            <form wire:submit.prevent="search" class="p-3 bg-white/10 dark:bg-slate-900/40 backdrop-blur-md border border-white/10 rounded-2xl sm:rounded-full shadow-2xl max-w-4xl mx-auto flex flex-col sm:flex-row items-center gap-2">
                <!-- Keyword Input -->
                <div class="w-full flex items-center gap-2 px-4 py-2 border-b sm:border-b-0 sm:border-r border-white/10 text-white">
                    <i data-lucide="search" class="w-5 h-5 text-primary shrink-0"></i>
                    <input type="text" wire:model="searchQuery" placeholder="Jabatan, skill, atau kata kunci..." class="w-full bg-transparent border-0 focus:outline-none focus:ring-0 text-sm placeholder-slate-400">
                </div>

                <!-- Location Input -->
                <div class="w-full flex items-center gap-2 px-4 py-2 border-b sm:border-b-0 sm:border-r border-white/10 text-white">
                    <i data-lucide="map-pin" class="w-5 h-5 text-primary shrink-0"></i>
                    <input type="text" wire:model="searchLocation" placeholder="Kota (e.g. Jakarta, Surabaya)..." class="w-full bg-transparent border-0 focus:outline-none focus:ring-0 text-sm placeholder-slate-400">
                </div>

                <!-- Category Dropdown -->
                <div class="w-full flex items-center gap-2 px-4 py-2 text-white">
                    <i data-lucide="briefcase" class="w-5 h-5 text-primary shrink-0"></i>
                    <select wire:model="searchCategory" class="w-full bg-transparent border-0 focus:outline-none focus:ring-0 text-sm text-slate-300 [&>option]:bg-slate-900">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full sm:w-auto shrink-0 bg-primary hover:bg-primary-hover text-white font-semibold px-8 py-3.5 rounded-xl sm:rounded-full transition shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                    <span>Cari</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-[-3rem]">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 p-6 bg-white dark:bg-darkCard rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl">
            <div class="text-center p-4">
                <p class="text-3xl font-black text-primary">{{ number_format($stats['jobs']) }}</p>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mt-1">Lowongan Aktif</p>
            </div>
            <div class="text-center p-4 border-l border-slate-100 dark:border-slate-800">
                <p class="text-3xl font-black text-emerald-500 dark:text-emerald-400">{{ number_format($stats['companies']) }}</p>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mt-1">Perusahaan Aktif</p>
            </div>
            <div class="text-center p-4 border-l border-slate-100 dark:border-slate-800">
                <p class="text-3xl font-black text-indigo-500">{{ number_format($stats['candidates']) }}</p>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mt-1">Pelamar Aktif</p>
            </div>
            <div class="text-center p-4 border-l border-slate-100 dark:border-slate-800">
                <p class="text-3xl font-black text-pink-500">{{ number_format($stats['applications']) }}</p>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mt-1">Lamaran Terkirim</p>
            </div>
        </div>
    </div>

    <!-- Featured Companies Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-2 mb-8">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">Perusahaan Unggulan</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Bekerja di perusahaan terkemuka dengan reputasi dan respon terbaik.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($featuredCompanies as $company)
                <a href="/company/{{ $company->slug }}" class="p-6 bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-2xl hover:border-primary dark:hover:border-primary transition text-center flex flex-col items-center gap-3 group shadow-sm">
                    @if($company->logo)
                        <img src="{{ $company->logo }}" alt="{{ $company->name }}" class="w-12 h-12 object-contain rounded-xl">
                    @else
                        <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold text-lg">
                            {{ substr($company->name, 0, 1) }}
                        </div>
                    @endif
                    <div class="space-y-1">
                        <h4 class="font-bold text-xs text-slate-800 dark:text-slate-200 group-hover:text-primary transition line-clamp-1">{{ $company->name }}</h4>
                        <p class="text-[10px] text-slate-400 line-clamp-1">{{ $company->location }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Sponsored / Featured Jobs Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                    <span>Lowongan Unggulan</span>
                    <span class="px-2 py-0.5 rounded text-[10px] bg-amber-500 text-white font-bold uppercase tracking-wider">Sponsored</span>
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">Pekerjaan dengan kecocokan tinggi dan benefit terbaik.</p>
            </div>
            <a href="/jobs" class="text-sm font-semibold text-primary hover:underline flex items-center gap-1">
                <span>Lihat Semua</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredJobs as $job)
                <div class="p-6 bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-3xl shadow-sm hover:shadow-md transition relative flex flex-col justify-between h-full group">
                    <div class="space-y-4">
                        <!-- Top details -->
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex items-center gap-3">
                                @if($job->company->logo)
                                    <img src="{{ $job->company->logo }}" alt="{{ $job->company->name }}" class="w-12 h-12 object-contain rounded-xl">
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold text-lg shrink-0">
                                        {{ substr($job->company->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <a href="/company/{{ $job->company->slug }}" class="text-xs font-semibold text-slate-500 dark:text-slate-400 hover:text-primary transition">
                                        {{ $job->company->name }}
                                    </a>
                                    <div class="flex items-center gap-1.5 mt-0.5">
                                        @if($job->is_sponsored)
                                            <span class="px-1.5 py-0.5 text-[8px] bg-amber-100 text-amber-800 border border-amber-200 font-bold rounded uppercase">Sponsored</span>
                                        @endif
                                        @if($job->is_urgent)
                                            <span class="px-1.5 py-0.5 text-[8px] bg-rose-100 text-rose-800 border border-rose-200 font-bold rounded uppercase">Urgent</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Title and City -->
                        <div class="space-y-1">
                            <a href="/jobs/{{ $job->slug }}" class="font-bold text-slate-900 dark:text-white hover:text-primary transition text-base group-hover:text-primary block line-clamp-1">
                                {{ $job->title }}
                            </a>
                            <div class="flex items-center gap-3 text-xs text-slate-400">
                                <span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-3.5 h-3.5"></i> {{ $job->city }}</span>
                                <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3.5 h-3.5"></i> {{ $job->employment_type }}</span>
                            </div>
                        </div>

                        <!-- Salary & Match score hint -->
                        <div class="py-2.5 px-3 bg-slate-50 dark:bg-slate-900/50 rounded-xl flex items-center justify-between text-xs">
                            <span class="font-bold text-emerald-600 dark:text-emerald-400">
                                @if($job->salary_min && $job->salary_max)
                                    {{ number_format($job->salary_min/1000000, 1) }}jt - {{ number_format($job->salary_max/1000000, 1) }}jt
                                @else
                                    Kompetitif
                                @endif
                            </span>
                            <span class="text-slate-400 flex items-center gap-1">
                                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-primary"></i>
                                Match Score Engine
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <span class="text-[10px] text-slate-400">Diperbarui {{ $job->updated_at->diffForHumans() }}</span>
                        <a href="/jobs/{{ $job->slug }}" class="px-4 py-1.5 rounded-lg bg-primary/10 text-primary hover:bg-primary hover:text-white text-xs font-bold transition">
                            Detail Pekerjaan
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Inline Banner Ad -->
    @if($middleAd)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {!! $middleAd->code_content !!}
        </div>
    @endif

    <!-- Latest Jobs Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-2 mb-12">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">Lowongan Terbaru</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Peluang karir terupdate hari ini di seluruh wilayah Indonesia.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($latestJobs as $job)
                <div class="p-6 bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-3xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-primary/50 dark:hover:border-primary/50 transition shadow-sm">
                    <div class="flex items-center gap-4">
                        @if($job->company->logo)
                            <img src="{{ $job->company->logo }}" alt="{{ $job->company->name }}" class="w-14 h-14 object-contain rounded-xl shrink-0">
                        @else
                            <div class="w-14 h-14 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold text-lg shrink-0">
                                {{ substr($job->company->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="space-y-1">
                            <a href="/jobs/{{ $job->slug }}" class="font-bold text-slate-900 dark:text-white hover:text-primary transition text-base block">
                                {{ $job->title }}
                            </a>
                            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                                {{ $job->company->name }} &bull; {{ $job->city }}
                            </p>
                            <div class="flex flex-wrap items-center gap-1.5 mt-2">
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-[10px] text-slate-500 dark:text-slate-400 font-medium">{{ $job->employment_type }}</span>
                                <span class="px-2 py-0.5 rounded-full bg-primary/10 text-primary text-[10px] font-bold">{{ $job->location_type }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex sm:flex-col items-start sm:items-end justify-between sm:justify-center gap-2 border-t sm:border-t-0 pt-4 sm:pt-0">
                        <span class="text-sm font-bold text-emerald-600 dark:text-emerald-400">
                            @if($job->salary_min && $job->salary_max)
                                Rp {{ number_format($job->salary_min/1000000, 1) }}jt - {{ number_format($job->salary_max/1000000, 1) }}jt
                            @else
                                Gaji Kompetitif
                            @endif
                        </span>
                        <a href="/jobs/{{ $job->slug }}" class="px-4 py-2 bg-slate-100 hover:bg-primary hover:text-white dark:bg-slate-800 dark:hover:bg-primary text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition">
                            Lamar
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Career Categories -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-2 mb-8">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">Kategori Karir</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Jelajahi pekerjaan berdasarkan spesialisasi bidang keahlian Anda.</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
            @foreach($categories as $cat)
                <a href="/jobs?cat={{ $cat->slug }}" class="p-6 bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-3xl hover:border-primary dark:hover:border-primary transition group shadow-sm flex flex-col items-center text-center gap-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white shrink-0 shadow-lg" style="background-color: {{ $cat->color ?? '#10B981' }};">
                        <i data-lucide="{{ $cat->icon ?? 'briefcase' }}" class="w-6 h-6"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-bold text-sm text-slate-800 dark:text-slate-200 group-hover:text-primary transition">{{ $cat->name }}</h4>
                        <p class="text-[10px] text-slate-400">{{ $cat->jobs()->count() }} Lowongan Aktif</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Salary Insights & Career Roadmaps Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Salary Insights -->
        <div class="bg-white dark:bg-darkCard p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <i data-lucide="trending-up" class="text-emerald-500"></i>
                    Riset Gaji Indonesia 2026
                </h3>
                <p class="text-xs text-slate-400 mt-1">Ekspektasi rentang gaji pasar berdasarkan posisi dan kota besar.</p>
            </div>
            
            <div class="space-y-4">
                @foreach($salaryInsights as $salary)
                    <div class="flex items-center justify-between p-3.5 bg-slate-50 dark:bg-slate-900/50 rounded-2xl">
                        <div>
                            <span class="font-bold text-sm text-slate-800 dark:text-slate-200 block">{{ $salary->job_title }}</span>
                            <span class="text-[10px] text-slate-400 uppercase tracking-wide font-semibold">{{ $salary->city }}</span>
                        </div>
                        <div class="text-right">
                            <span class="font-extrabold text-sm text-emerald-600 dark:text-emerald-400 block">
                                {{ number_format($salary->salary_min/1000000, 0) }}jt - {{ number_format($salary->salary_max/1000000, 0) }}jt
                            </span>
                            <span class="text-[9px] text-slate-400">Rata-rata: {{ number_format($salary->salary_avg/1000000, 1) }}jt</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="/salary/insight" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary hover:underline">
                <span>Pelajari Riset Gaji Selengkapnya</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <!-- Career Roadmaps -->
        <div class="bg-white dark:bg-darkCard p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <i data-lucide="map" class="text-primary"></i>
                    Peta Karir (Career Roadmap)
                </h3>
                <p class="text-xs text-slate-400 mt-1">Tingkatan karir dan keterampilan yang harus dipersiapkan.</p>
            </div>
            
            <div class="space-y-4">
                @foreach($roadmaps as $road)
                    <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                            <i data-lucide="milestone" class="w-5 h-5"></i>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-bold text-sm text-slate-800 dark:text-slate-200">{{ $road->title }}</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-1">{{ $road->description }}</p>
                            <div class="flex items-center gap-1 text-[10px] text-primary font-semibold mt-2">
                                @if(is_array($road->steps))
                                    <span>{{ count($road->steps) }} Tingkat Karir</span>
                                @endif
                                <span>&bull;</span>
                                <span>Lihat Peta</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="/career/roadmap" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary hover:underline">
                <span>Pelajari Peta Karir Selengkapnya</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
    </section>

    <!-- Career Blog / Tips Karir -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">Blog Karir</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">Tips, panduan interview, CV ATS, dan berita kerja terkini.</p>
            </div>
            <a href="/blog" class="text-sm font-semibold text-primary hover:underline flex items-center gap-1">
                <span>Lihat Blog</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
                <article class="bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm flex flex-col group h-full justify-between">
                    <div>
                        <!-- Image placeholder -->
                        <div class="h-48 bg-slate-100 dark:bg-slate-900 flex items-center justify-center text-slate-300 relative">
                            <i data-lucide="image" class="w-12 h-12 text-slate-300 dark:text-slate-700"></i>
                            <span class="absolute top-4 left-4 px-2.5 py-1 bg-primary text-white text-[10px] font-bold rounded-lg uppercase">
                                {{ $blog->category->name }}
                            </span>
                        </div>
                        <div class="p-6 space-y-3">
                            <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wide">{{ $blog->created_at->format('d M Y') }}</span>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-primary transition line-clamp-2">
                                <a href="/blog/{{ $blog->slug }}">{{ $blog->title }}</a>
                            </h3>
                            <div class="text-xs text-slate-500 dark:text-slate-400 line-clamp-3">
                                {!! strip_tags($blog->content) !!}
                            </div>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2">
                        <a href="/blog/{{ $blog->slug }}" class="text-xs font-bold text-primary hover:underline inline-flex items-center gap-1">
                            <span>Baca Artikel</span>
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</div>
