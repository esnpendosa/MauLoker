<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
    <!-- Top Ad Banner -->
    @if($topAd)
        <div class="w-full">
            {!! $topAd->code_content !!}
        </div>
    @endif

    <!-- Header Search Bar -->
    <div class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col md:flex-row gap-4 items-center">
        <div class="w-full relative flex items-center">
            <i data-lucide="search" class="w-5 h-5 text-primary absolute left-4 shrink-0"></i>
            <input type="text" wire:model.live.debounce.300ms="q" placeholder="Cari posisi, kata kunci, atau perusahaan..." class="w-full bg-slate-50 dark:bg-slate-900 border-0 rounded-2xl pl-12 pr-4 py-3.5 text-sm focus:outline-none focus:ring-1 focus:ring-primary text-slate-800 dark:text-slate-200">
        </div>
        <div class="w-full md:w-72 relative flex items-center">
            <i data-lucide="map-pin" class="w-5 h-5 text-primary absolute left-4 shrink-0"></i>
            <input type="text" wire:model.live.debounce.300ms="loc" placeholder="Lokasi (e.g. Jakarta)..." class="w-full bg-slate-50 dark:bg-slate-900 border-0 rounded-2xl pl-12 pr-4 py-3.5 text-sm focus:outline-none focus:ring-1 focus:ring-primary text-slate-800 dark:text-slate-200">
        </div>
        <button wire:click="resetFilters" class="w-full md:w-auto shrink-0 px-6 py-3.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold rounded-2xl text-sm transition">
            Reset Filter
        </button>
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
        
        <!-- Sidebar Filters -->
        <aside class="space-y-6 lg:sticky lg:top-24">
            <div class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                    <h3 class="font-bold text-slate-950 dark:text-white flex items-center gap-2">
                        <i data-lucide="sliders-horizontal" class="w-4 h-4 text-primary"></i>
                        Filter Lowongan
                    </h3>
                </div>

                <!-- Category -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori Pekerjaan</label>
                    <select wire:model.live="cat" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Employment Type -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jenis Kontrak</label>
                    <select wire:model.live="type" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Semua Jenis</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Kontrak</option>
                        <option value="Internship">Magang</option>
                        <option value="Freelance">Lepas Waktu / Freelance</option>
                    </select>
                </div>

                <!-- Work Mode -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Metode Kerja</label>
                    <select wire:model.live="locationType" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Semua Metode</option>
                        <option value="Onsite">Bekerja di Kantor (Onsite)</option>
                        <option value="Remote">Bekerja dari Rumah (Remote)</option>
                        <option value="Hybrid">Campuran (Hybrid)</option>
                    </select>
                </div>

                <!-- Experience -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pengalaman</label>
                    <select wire:model.live="exp" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Semua Tingkat</option>
                        <option value="entry">Fresh Graduate / Kurang 1 thn</option>
                        <option value="mid">Menengah (2 - 4 thn)</option>
                        <option value="senior">Senior (>= 5 thn)</option>
                    </select>
                </div>

                <!-- Education -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pendidikan Minimal</label>
                    <select wire:model.live="edu" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Semua Pendidikan</option>
                        <option value="SMA">SMA / SMK</option>
                        <option value="D3">Diploma (D3)</option>
                        <option value="S1">Sarjana (S1)</option>
                        <option value="S2">Magister (S2)</option>
                    </select>
                </div>

                <!-- Minimum Salary -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Batas Gaji Maksimal (Min. Rp)</label>
                    <select wire:model.live="min_salary" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Semua Gaji</option>
                        <option value="3000000">Diatas Rp 3 Juta</option>
                        <option value="5000000">Diatas Rp 5 Juta</option>
                        <option value="8000000">Diatas Rp 8 Juta</option>
                        <option value="12000000">Diatas Rp 12 Juta</option>
                        <option value="15000000">Diatas Rp 15 Juta</option>
                    </select>
                </div>
            </div>

            <!-- Sidebar Ad Placement -->
            @if($sidebarAd)
                <div class="w-full">
                    {!! $sidebarAd->code_content !!}
                </div>
            @endif
        </aside>

        <!-- Search Results List -->
        <main class="lg:col-span-3 space-y-6">
            
            <!-- Sorting and statistics info -->
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">
                    Menampilkan {{ $jobs->total() }} Lowongan Pekerjaan
                </span>
                
                <!-- Sort Dropdown -->
                <div class="flex items-center gap-2">
                    <span class="text-xs text-slate-400">Urutkan:</span>
                    <select wire:model.live="sort" class="bg-transparent border-0 text-xs font-bold text-primary focus:ring-0 cursor-pointer">
                        <option value="newest">Terbaru</option>
                        <option value="highest_salary">Gaji Tertinggi</option>
                        <option value="most_applied">Pelamar Terbanyak</option>
                    </select>
                </div>
            </div>

            <!-- Job cards list -->
            <div class="space-y-4">
                @forelse($jobs as $job)
                    <div class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm hover:border-primary/40 dark:hover:border-primary/40 transition flex flex-col md:flex-row md:items-center justify-between gap-6 relative group">
                        
                        <!-- Left Details -->
                        <div class="flex items-start gap-4">
                            @if($job->company->logo)
                                <img src="{{ $job->company->logo }}" alt="{{ $job->company->name }}" class="w-14 h-14 object-contain rounded-2xl shrink-0 border border-slate-100 dark:border-slate-800">
                            @else
                                <div class="w-14 h-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold text-xl shrink-0">
                                    {{ substr($job->company->name, 0, 1) }}
                                </div>
                            @endif

                            <div class="space-y-1">
                                <div class="flex flex-wrap items-center gap-1.5">
                                    <a href="/jobs/{{ $job->slug }}" class="font-bold text-slate-900 dark:text-white hover:text-primary transition text-base block group-hover:text-primary leading-tight">
                                        {{ $job->title }}
                                    </a>
                                    @if($job->is_sponsored)
                                        <span class="px-1.5 py-0.5 rounded text-[8px] bg-amber-100 text-amber-800 border border-amber-200 font-extrabold uppercase">Sponsored</span>
                                    @endif
                                    @if($job->is_urgent)
                                        <span class="px-1.5 py-0.5 rounded text-[8px] bg-rose-100 text-rose-800 border border-rose-200 font-extrabold uppercase">Urgent</span>
                                    @endif
                                </div>
                                
                                <div class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400">
                                    <a href="/company/{{ $job->company->slug }}" class="hover:underline font-semibold text-slate-600 dark:text-slate-300">{{ $job->company->name }}</a>
                                    <span>&bull;</span>
                                    <span class="flex items-center gap-0.5"><i data-lucide="map-pin" class="w-3.5 h-3.5"></i> {{ $job->city }}</span>
                                </div>

                                <div class="flex flex-wrap items-center gap-1.5 pt-2">
                                    <span class="px-2.5 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-[10px] text-slate-500 dark:text-slate-400 font-semibold">{{ $job->employment_type }}</span>
                                    <span class="px-2.5 py-0.5 rounded-full bg-primary/10 text-primary text-[10px] font-bold">{{ $job->location_type }}</span>
                                    <span class="px-2.5 py-0.5 rounded-full bg-indigo-50 dark:bg-indigo-950/20 text-indigo-600 dark:text-indigo-400 text-[10px] font-semibold">{{ $job->education_level ?: 'Semua Pendidikan' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right details (Salary, Match Score, Action) -->
                        <div class="flex md:flex-col items-start md:items-end justify-between md:justify-center gap-3 border-t md:border-t-0 pt-4 md:pt-0">
                            <div class="text-left md:text-right">
                                <span class="font-extrabold text-sm sm:text-base text-emerald-600 dark:text-emerald-400 block">
                                    @if($job->salary_min && $job->salary_max)
                                        Rp {{ number_format($job->salary_min/1000000, 1) }}jt - {{ number_format($job->salary_max/1000000, 1) }}jt
                                    @else
                                        Gaji Kompetitif
                                    @endif
                                </span>
                                <span class="text-[10px] text-slate-400">Diperbarui {{ $job->updated_at->diffForHumans() }}</span>
                            </div>

                            <a href="/jobs/{{ $job->slug }}" class="px-5 py-2.5 bg-primary hover:bg-primary-hover text-white text-xs font-bold rounded-xl transition shadow-md shadow-primary/15 flex items-center gap-1">
                                <span>Lamar</span>
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-white dark:bg-darkCard rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                        <div class="w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-900 flex items-center justify-center mx-auto text-slate-400">
                            <i data-lucide="folder-search" class="w-8 h-8"></i>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-bold text-slate-900 dark:text-white">Pencarian Tidak Ditemukan</h4>
                            <p class="text-xs text-slate-500 max-w-sm mx-auto">Coba cari dengan kata kunci lain atau ubah pengaturan filter untuk hasil pencarian yang lebih luas.</p>
                        </div>
                        <button wire:click="resetFilters" class="px-5 py-2.5 bg-primary hover:bg-primary-hover text-white text-xs font-bold rounded-xl transition">
                            Reset Pencarian
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Links -->
            <div class="pt-6">
                {{ $jobs->links() }}
            </div>
        </main>
    </div>
</div>
