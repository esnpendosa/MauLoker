<div class="space-y-24 pb-24 bg-slate-50/30 dark:bg-slate-950/20 font-sans">
    <!-- 1. Hero Section (Light & Airy Premium Design) -->
    <div class="relative overflow-hidden bg-gradient-to-br from-primary/5 via-white to-slate-50/50 dark:from-slate-950 dark:via-slate-900 dark:to-black py-16 sm:py-24 border-b border-slate-100 dark:border-slate-800">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 opacity-40 dark:opacity-10 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-primary/10 blur-[100px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[400px] h-[400px] rounded-full bg-emerald-200/30 blur-[80px]"></div>
        </div>
        <!-- Islamic geometric pattern accent -->
        <div class="absolute top-0 right-0 opacity-5 dark:opacity-[0.03] pointer-events-none">
            <svg width="400" height="400" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <pattern id="islamic-geo" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M20 0L40 20L20 40L0 20Z" fill="none" stroke="currentColor" class="text-primary" stroke-width="0.5"/>
                    <circle cx="20" cy="20" r="8" fill="none" stroke="currentColor" class="text-primary" stroke-width="0.5"/>
                </pattern>
                <rect width="400" height="400" fill="url(#islamic-geo)"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Column: Copy & Call to Action -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <span class="inline-flex items-center gap-2 text-xs font-bold tracking-widest text-primary dark:text-primary uppercase">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        MULAI KARIR TERBAIKMU DI SINI!
                    </span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white leading-tight">
                        Siap Cari <span class="text-primary">Kerja</span>?<br class="hidden sm:inline" />
                        Temukan Loker <span class="text-emerald-600 dark:text-emerald-400">Impianmu!</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm sm:text-base leading-relaxed max-w-xl mx-auto lg:mx-0">
                        Platform pencarian kerja terpercaya untuk masyarakat Indonesia. Ribuan lowongan kerja dari perusahaan terverifikasi, proses mudah, cepat, dan transparan. Berkah dalam berkarir!
                    </p>
                    <!-- Trust badges -->
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 text-xs text-slate-500 dark:text-slate-400">
                        <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> {{ $stats['companies'] }} Perusahaan Terverifikasi</span>
                        <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5 text-primary" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg> {{ $stats['candidates'] }} Pencari Kerja</span>
                        <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg> {{ $stats['jobs'] }} Lowongan Aktif</span>
                    </div>
                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="/jobs" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-sm font-bold text-white bg-primary hover:bg-primary-hover rounded-xl transition shadow-lg shadow-primary/20 group">
                            <span>Cari Lowongan Sekarang</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="/register" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-sm font-bold text-primary dark:text-primary bg-primary/10 hover:bg-primary/20 rounded-xl transition border border-primary/20">
                            Daftar Gratis
                        </a>
                    </div>
                </div>

                <!-- Right Column: Muslim Couple Professional Photo & Floating Cards -->
                <div class="lg:col-span-5 relative flex items-center justify-center py-10 lg:py-0">
                    <!-- Concentric decorative circle lines -->
                    <div class="absolute w-[360px] h-[360px] sm:w-[440px] sm:h-[440px] rounded-full border border-slate-200/80 dark:border-slate-800/80 pointer-events-none"></div>
                    <div class="absolute w-[280px] h-[280px] sm:w-[340px] sm:h-[340px] rounded-full border border-dashed border-primary/30 pointer-events-none"></div>
                    <div class="absolute w-[200px] h-[200px] sm:w-[240px] sm:h-[240px] rounded-full border border-slate-200/50 dark:border-slate-800/50 pointer-events-none"></div>

                    <!-- Hero Main Photo - Muslim Couple -->
                    <div class="relative z-10 w-[280px] sm:w-[350px] aspect-square rounded-full overflow-hidden border-4 border-white dark:border-slate-800 shadow-2xl">
                        <img src="{{ asset('images/hero_muslim_duo.png') }}" alt="Profesional Muslim Pria dan Wanita mencari kerja" class="w-full h-full object-cover object-top"
                             onerror="this.src='{{ asset('images/hero_muslim.png') }}'">
                    </div>

                    <!-- Floating Card 1: Offer Success (Top Left) -->
                    <div class="absolute top-2 left-[-20px] sm:left-[-40px] bg-white dark:bg-darkCard border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-xl p-3 flex items-center gap-3 z-20 animate-bounce" style="animation-duration: 4s;">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase">Selamat!</p>
                            <p class="text-xs font-extrabold text-slate-800 dark:text-white">Lamaran Diterima!</p>
                        </div>
                    </div>

                    <!-- Floating Card 2: Muslim Candidates (Middle Right) -->
                    <div class="absolute right-[-20px] sm:right-[-30px] top-[40%] bg-white dark:bg-darkCard border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-xl p-3 space-y-1.5 z-20">
                        <p class="text-[9px] font-bold text-slate-400 dark:text-slate-500">Pelamar Masuk</p>
                        <div class="flex items-center -space-x-2">
                            @php
                                $candidateColors = [
                                    'bg-primary/10 text-primary',
                                    'bg-emerald-100 text-emerald-600',
                                    'bg-amber-100 text-amber-600'
                                ];
                            @endphp
                            @foreach($latestCandidates as $idx => $initials)
                                <div class="w-6 h-6 rounded-full border-2 border-white dark:border-slate-800 {{ $candidateColors[$idx % count($candidateColors)] }} flex items-center justify-center text-[8px] font-bold">{{ $initials }}</div>
                            @endforeach
                            @if($stats['candidates'] > 3)
                                <div class="w-6 h-6 rounded-full bg-slate-100 dark:bg-slate-800 border-2 border-white dark:border-slate-800 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                    +{{ $stats['candidates'] - 3 }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Floating Card 3: Salary Info (Bottom Left) -->
                    <div class="absolute bottom-[-10px] left-[-30px] sm:left-[-50px] bg-white dark:bg-darkCard border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-xl p-3 max-w-[200px] z-20">
                        <div class="flex items-start gap-2.5">
                            <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center mt-0.5 shrink-0">
                                <i data-lucide="trending-up" class="w-3 h-3 text-primary"></i>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-slate-400">Gaji Rata-rata</p>
                                <p class="text-[10px] leading-snug text-slate-600 dark:text-slate-300 font-extrabold">
                                    Rp {{ number_format($minSalary/1000000, 0) }}Jt - {{ number_format($maxSalary/1000000, 0) }}Jt / bulan
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Islamic badge -->
                    <div class="absolute bottom-[20%] right-[-10px] bg-emerald-500 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg shadow-emerald-500/20 z-20 text-[9px] font-black">
                        ✓
                    </div>
                </div>

            </div>
        </div>
    </div>
 
    <!-- 2. Categories Section (One Platform Many Solutions) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-3 mb-12">
            <span class="text-xs font-extrabold tracking-widest text-primary uppercase">KATEGORI</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">Satu Platform Banyak <span class="text-primary">Solusi</span></h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 max-w-md mx-auto">Jelajahi berbagai lowongan pekerjaan di berbagai sektor industri.</p>
        </div>
 
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories->take(6) as $index => $cat)
                @php
                    // Highlight the Customer Support Care category (usually index 4 or slug customer-service) to match reference design
                    $isHighlighted = ($cat->slug === 'customer-service');
                @endphp
                <a href="/jobs?cat={{ $cat->slug }}" 
                   class="group flex items-center gap-5 p-6 rounded-2xl border transition duration-300 shadow-sm hover:shadow-lg
                          {{ $isHighlighted 
                             ? 'bg-primary border-primary text-white hover:bg-primary-hover hover:border-primary-hover' 
                             : 'bg-white dark:bg-darkCard border-slate-100 dark:border-slate-800 text-slate-800 dark:text-slate-100 hover:bg-primary hover:border-primary hover:text-white dark:hover:bg-primary dark:hover:border-primary dark:hover:text-white' }}">
                    
                    <!-- Icon Wrapper -->
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 transition-colors duration-300
                                {{ $isHighlighted 
                                   ? 'bg-white/10 text-white' 
                                   : 'bg-primary/10 text-primary group-hover:bg-white/10 group-hover:text-white' }}"
                          style="{{ !$isHighlighted ? 'background-color: '.($cat->color).'15; color: '.$cat->color.';' : '' }}">
                        <i data-lucide="{{ $cat->icon ?? 'briefcase' }}" class="w-6 h-6"></i>
                    </div>
 
                    <!-- Text Contents -->
                    <div class="space-y-1">
                        <h4 class="font-extrabold text-base transition-colors duration-300">{{ $cat->name }}</h4>
                        <p class="text-xs transition-colors duration-300
                                  {{ $isHighlighted 
                                     ? 'text-white/80' 
                                     : 'text-slate-400 dark:text-slate-500 group-hover:text-white/80' }}">
                            {{ $cat->jobs()->count() }} Lowongan Tersedia
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
 
    <!-- 3. Synergy Section (Illustration Mockup & Copy) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Side: Interactive Mockup Card Illustration -->
            <div class="lg:col-span-5 relative flex items-center justify-center">
                <!-- Outer glow wrapper -->
                <div class="absolute inset-0 bg-gradient-to-tr from-primary/10 to-emerald-500/10 dark:from-slate-900 dark:to-primary/20 rounded-3xl filter blur-2xl scale-95 pointer-events-none"></div>
                <!-- Main Card Canvas Mockup -->
                <div class="relative w-full max-w-[400px] bg-white dark:bg-darkCard border border-slate-100 dark:border-slate-800/80 rounded-3xl shadow-xl p-6 space-y-6 z-10">
                    <!-- Fake Search Bar Mockup -->
                    <div class="flex items-center justify-between px-4 py-3 bg-slate-50 dark:bg-slate-900/60 rounded-xl border border-slate-100 dark:border-slate-800/80">
                        <span class="text-xs font-semibold text-slate-400">Cari pelamar...</span>
                        <i data-lucide="search" class="w-4 h-4 text-primary shrink-0"></i>
                    </div>
 
                    <!-- Candidate Card "Junaid" -->
                    <div class="border border-slate-100 dark:border-slate-800/80 rounded-2xl p-4 space-y-4 shadow-sm bg-white dark:bg-slate-900/40 relative">
                        <div class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop&crop=face" class="w-12 h-12 rounded-full object-cover" alt="Junaid">
                            <div>
                                <div class="flex items-center gap-1">
                                    <span class="font-extrabold text-sm text-slate-800 dark:text-white">Junaid</span>
                                    <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-500 fill-current"></i>
                                </div>
                                <p class="text-xs text-slate-400 font-medium">Software Engineer</p>
                            </div>
                        </div>
 
                        <!-- Rating Stars -->
                        <div class="flex items-center gap-1">
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400 text-amber-400"></i>
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400 text-amber-400"></i>
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400 text-amber-400"></i>
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400 text-amber-400"></i>
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400 text-amber-400"></i>
                            <span class="text-xs font-bold text-slate-500 dark:text-slate-400 ml-1">5.0</span>
                        </div>
 
                        <!-- View Profile Button -->
                        <button class="w-full py-2.5 text-xs font-bold text-primary dark:text-primary bg-primary/10 dark:bg-primary/20 rounded-xl hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white transition">
                            Lihat Profil
                        </button>
                    </div>
 
                    <!-- Tiny overlay floating verified candidate -->
                    <div class="flex items-center gap-2 p-2 bg-emerald-500 text-white rounded-lg absolute -top-4 -right-4 shadow-lg text-[9px] font-bold">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Kandidat Terverifikasi
                    </div>
                </div>
            </div>
 
            <!-- Right Side: Copywriting -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white leading-tight">
                    Mendorong Sinergi Antara Industri dan Pengembangan Korporat
                </h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm sm:text-base leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Kami memfasilitasi integrasi karir dengan mencocokkan keterampilan teknis kandidat dan kebutuhan spesifik perusahaan untuk menciptakan ekosistem kerja yang produktif dan dinamis.
                </p>
                <div class="pt-2">
                    <a href="/jobs" class="inline-flex items-center justify-center px-8 py-3.5 text-sm font-bold text-white bg-primary hover:bg-primary-hover rounded-xl transition shadow-md shadow-primary/10">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
 
        </div>
    </section>
 
    <!-- 4. Latest Job Listing Section (4 Columns Grid) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-3 mb-16">
            <span class="text-xs font-extrabold tracking-widest text-primary uppercase">LOWONGAN KERJA</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">Lowongan Kerja Terbaru</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 max-w-md mx-auto">Jelajahi berbagai posisi yang baru dipublikasikan dari perusahaan-perusahaan terpercaya.</p>
        </div>
 
        <!-- Job Cards Grid (4 Columns on Desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($latestJobs as $job)
                <div class="bg-white dark:bg-darkCard border border-slate-100 dark:border-slate-800 rounded-[2rem] p-6 shadow-sm hover:shadow-lg hover:border-primary/20 transition-all duration-300 flex flex-col justify-between h-[360px] relative group">
                    <div>
                        <!-- Top Row: Verification & Brand Logo -->
                        <div class="flex items-start justify-between gap-4">
                            @if($job->company->verified)
                                <span class="px-2.5 py-1 text-[9px] font-black bg-primary/10 text-primary rounded-md border border-primary/20 uppercase tracking-wide">
                                    Terverifikasi
                                </span>
                            @else
                                <span class="px-2.5 py-1 text-[9px] font-bold bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 rounded-md uppercase tracking-wide">
                                    Tertunda
                                </span>
                            @endif
 
                            @if($job->company->logo)
                                <img src="{{ $job->company->logo }}" alt="{{ $job->company->name }}" class="w-10 h-10 object-contain rounded-lg shrink-0">
                            @else
                                <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-sm shrink-0">
                                    {{ substr($job->company->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
 
                        <!-- Job Title & Location -->
                        <div class="mt-6 space-y-1">
                            <a href="/jobs/{{ $job->slug }}" class="font-extrabold text-lg text-slate-800 dark:text-white hover:text-primary transition line-clamp-1">
                                {{ $job->title }}
                            </a>
                            <p class="text-xs text-slate-400 dark:text-slate-500 font-semibold flex items-center gap-1">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-primary shrink-0"></i>
                                <span>{{ $job->city }}</span>
                            </p>
                        </div>
 
                        <!-- Truncated Description -->
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-4 leading-relaxed line-clamp-3">
                            {{ $job->description }}
                        </p>
                    </div>
 
                    <!-- Bottom Details & View Details Button -->
                    <div class="mt-6 border-t border-slate-50 dark:border-slate-800/80 pt-4 space-y-4">
                        <div class="flex items-center justify-between text-xs">
                            <span class="px-2.5 py-1 rounded-md bg-slate-50 dark:bg-slate-900 text-slate-500 dark:text-slate-400 font-bold">
                                {{ $job->employment_type }}
                            </span>
                            <span class="font-extrabold text-primary">
                                @if($job->salary_min && $job->salary_max)
                                    Rp {{ number_format($job->salary_min/1000000, 1) }}Jt - Rp {{ number_format($job->salary_max/1000000, 1) }}Jt
                                @else
                                    Gaji Kompetitif
                                @endif
                            </span>
                        </div>
 
                        <a href="/jobs/{{ $job->slug }}" class="inline-flex items-center text-xs font-black text-rose-500 hover:text-rose-600 dark:text-rose-400 dark:hover:text-rose-500 transition-colors group-hover:translate-x-1 duration-200">
                            <span>Lihat Detail</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
 </div>
