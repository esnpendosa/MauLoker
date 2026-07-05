<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Sidebar Kiri (Gaya RightWork.inc) -->
        <aside class="lg:col-span-3 space-y-6">
            <!-- Profile Info Box -->
            <div class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm text-center">
                @if($company->logo)
                    <img src="{{ $company->logo }}" alt="{{ $company->name }}" class="w-16 h-16 mx-auto rounded-2xl object-cover bg-white/10 border border-white/10 p-1 mb-3 shadow-md">
                @else
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-emerald-500 to-primary flex items-center justify-center font-bold text-2xl shadow-lg text-white mb-3">
                        {{ substr($company->name, 0, 1) }}
                    </div>
                @endif
                <h2 class="text-base font-black text-slate-900 dark:text-white leading-snug">{{ $company->name }}</h2>
                <p class="text-xs text-slate-400 mt-1">Pemberi Kerja &bull; {{ $company->category ?: 'Industri belum diisi' }}</p>
                <div class="flex flex-col gap-1.5 mt-3">
                    <span class="px-2.5 py-1 rounded-lg bg-emerald-600/20 border border-emerald-500/20 text-[10px] text-emerald-300 font-bold mx-auto">
                        Reputasi: {{ $company->reputation_score }} / 5.0
                    </span>
                    @if($company->verified)
                        <span class="px-2.5 py-1 rounded-lg bg-primary/20 border border-primary/20 text-[10px] text-primary-hover font-bold uppercase tracking-wider mx-auto flex items-center gap-1">
                            <i data-lucide="shield-check" class="w-3 h-3"></i> Terverifikasi
                        </span>
                    @endif
                </div>
            </div>

            <!-- Sidebar Navigation Menu -->
            <nav class="bg-white dark:bg-darkCard rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm p-4 space-y-1">
                @php
                    $companyMenu = [
                        'dashboard' => ['label' => 'Ringkasan', 'icon' => 'bar-chart-2'],
                        'manage_jobs' => ['label' => 'Lowongan Anda', 'icon' => 'briefcase'],
                        'applicants' => ['label' => 'Pelamar Masuk', 'icon' => 'users'],
                        'profile' => ['label' => 'Profil Perusahaan', 'icon' => 'building-2'],
                    ];
                @endphp
                @foreach($companyMenu as $key => $labelItem)
                    <button wire:click="$set('activeTab', '{{ $key }}')" 
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition text-left group
                        {{ $activeTab === $key 
                            ? 'bg-primary/10 text-primary border-l-4 border-primary' 
                            : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-900/50 hover:text-slate-900 dark:hover:text-white' 
                        }}">
                        <i data-lucide="{{ $labelItem['icon'] }}" class="w-4.5 h-4.5 shrink-0 transition {{ $activeTab === $key ? 'text-primary' : 'text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}"></i>
                        <span>{{ $labelItem['label'] }}</span>
                    </button>
                @endforeach
            </nav>
        </aside>

        <!-- Area Konten Utama Kanan (Gaya RightWork.inc) -->
        <main class="lg:col-span-9 space-y-6">
            <!-- Search & Top Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="relative w-full max-w-md">
                    <input type="text" placeholder="Cari lowongan, pelamar, atau status rekrutmen..." 
                        class="w-full bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-2xl pl-10 pr-4 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400 shadow-sm">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                </div>
                <div class="text-xs text-slate-400 font-bold dark:text-slate-500 flex items-center gap-2 bg-slate-50 dark:bg-slate-900 px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-800">
                    <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                    <span>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
            </div>

            <!-- Welcome Banner (Gaya RightWork.inc) -->
            <div class="relative overflow-hidden bg-gradient-to-r from-slate-900 via-slate-800 to-primary-dark/80 text-white p-8 rounded-3xl border border-primary/20 shadow-xl">
                <!-- Decorative Red/Orange Wave Gradient Shape -->
                <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-gradient-to-l from-rose-500/20 to-transparent pointer-events-none"></div>
                <div class="absolute -right-16 -top-16 w-48 h-48 bg-primary/20 rounded-full blur-[80px] pointer-events-none"></div>
                <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-emerald-500/20 rounded-full blur-[60px] pointer-events-none"></div>
                <div class="absolute -right-20 top-1/2 -translate-y-1/2 w-64 h-32 bg-gradient-to-tr from-rose-500 to-orange-500 rounded-full blur-[70px] opacity-40 pointer-events-none"></div>
                
                <div class="relative z-10 space-y-1">
                    <span class="text-[10px] uppercase tracking-wider font-extrabold text-primary-hover">Selamat Datang di Panel Rekrutmen</span>
                    <h1 class="text-2xl sm:text-3xl font-black tracking-tight">Halo, {{ $company->name }} !</h1>
                    <p class="text-xs text-slate-400 max-w-lg leading-relaxed pt-1">
                        Pasang lowongan kerja baru, tinjau lamaran masuk dari pelamar terbaik, verifikasi reputasi perusahaan Anda, dan kelola seleksi kandidat secara efisien.
                    </p>
                </div>
            </div>

            <!-- Ad Placement -->
            @if($dashboardAd)
                <div class="w-full">
                    {!! $dashboardAd->code_content !!}
                </div>
            @endif

            <!-- Main Content Area inside main column -->
            <div class="grid grid-cols-1 gap-8">
        
        <!-- Tab: Dashboard / Summary -->
        @if($activeTab === 'dashboard')
            <div class="space-y-8">
                <!-- Stat Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block font-medium">Total Lowongan Terpasang</span>
                            <span class="text-2xl font-black text-slate-900 dark:text-white mt-1 block">{{ $stats['total_jobs'] }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center">
                            <i data-lucide="briefcase" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block font-medium">Lowongan Aktif</span>
                            <span class="text-2xl font-black text-emerald-600 dark:text-emerald-400 mt-1 block">{{ $stats['active_jobs'] }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                            <i data-lucide="check-circle" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block font-medium">Total Pelamar Masuk</span>
                            <span class="text-2xl font-black text-primary mt-1 block">{{ $stats['total_applies'] }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center">
                            <i data-lucide="users" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>

                <!-- Helpful summary box -->
                <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                    <h3 class="font-bold text-slate-900 dark:text-white text-base">Rangkuman Rekrutmen</h3>
                    <p class="text-xs text-slate-500 leading-relaxed max-w-2xl">
                        Selamat datang kembali di panel MauLoker Perusahaan. Melalui panel ini, Anda dapat memantau status aplikasi lamaran kerja, mengubah status seleksi, mengunduh resume, dan menyesuaikan kriteria spesifik pencocokan AI Match Score.
                    </p>
                    <div class="pt-2">
                        <button wire:click="openCreateJob" class="px-6 py-2.5 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-primary/20">
                            Pasang Lowongan Baru
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Tab: Manage Jobs -->
        @if($activeTab === 'manage_jobs')
            <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Lowongan Pekerjaan</h2>
                        <p class="text-xs text-slate-400">Kelola dan perbarui iklan lowongan pekerjaan perusahaan Anda.</p>
                    </div>
                    <button wire:click="openCreateJob" class="px-4 py-2 bg-primary hover:bg-primary-hover text-white text-xs font-bold rounded-xl transition">
                        Pasang Lowongan
                    </button>
                </div>

                @if (session()->has('success'))
                    <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-100 dark:border-slate-800 uppercase tracking-wider font-bold">
                                <th class="py-3 px-4">Posisi Lowongan</th>
                                <th class="py-3 px-4">Kategori</th>
                                <th class="py-3 px-4">Metode & Kota</th>
                                <th class="py-3 px-4">Pelamar</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-850">
                            @forelse($jobs as $job)
                                <tr>
                                    <td class="py-4 px-4 font-bold text-slate-900 dark:text-white">
                                        <div class="flex items-center gap-2">
                                            <span>{{ $job->title }}</span>
                                            @if($job->is_featured)
                                                <span class="px-1.5 py-0.5 rounded text-[8px] bg-amber-100 text-amber-800 font-extrabold uppercase">Featured</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-slate-500">{{ $job->category->name }}</td>
                                    <td class="py-4 px-4">
                                        <span class="font-semibold text-slate-700 dark:text-slate-300 block">{{ $job->location_type }}</span>
                                        <span class="text-[10px] text-slate-400">{{ $job->city }}</span>
                                    </td>
                                    <td class="py-4 px-4 font-bold text-slate-700 dark:text-slate-300">
                                        {{ $job->applies_count }} Pelamar
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $job->status === 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-500' }}">
                                            {{ $job->status === 'active' ? 'Aktif' : 'Non-aktif' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-right">
                                        <button wire:click="openEditJob({{ $job->id }})" class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-slate-855 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12 text-slate-400">
                                        Belum ada lowongan terdaftar. Klik 'Pasang Lowongan' untuk memulai perekrutan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Tab: Manage Applicants -->
        @if($activeTab === 'applicants')
            <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4 gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Pelamar Pekerjaan Masuk</h2>
                        <p class="text-xs text-slate-400">Seleksi kandidat pelamar berdasarkan kecocokan AI Match Score.</p>
                    </div>

                    <!-- Job selector filter -->
                    <div class="w-full sm:w-64">
                        <select wire:model.live="selectedJobId" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                            <option value="">Semua Lowongan</option>
                            @foreach($jobs as $jb)
                                <option value="{{ $jb->id }}">{{ $jb->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if (session()->has('success'))
                    <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-100 dark:border-slate-800 uppercase tracking-wider font-bold">
                                <th class="py-3 px-4">Nama Pelamar</th>
                                <th class="py-3 px-4">Posisi</th>
                                <th class="py-3 px-4 text-center">Match Score</th>
                                <th class="py-3 px-4">Tanggal Kirim</th>
                                <th class="py-3 px-4">Dokumen CV</th>
                                <th class="py-3 px-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-850">
                            @forelse($applicants as $applicant)
                                <tr>
                                    <td class="py-4 px-4 font-bold text-slate-900 dark:text-white">
                                        <button wire:click="toggleApplicantDetails({{ $applicant->id }})" class="hover:text-primary transition text-left font-bold flex items-center gap-1.5 focus:outline-none">
                                            <i data-lucide="{{ $expandedApplicantId === $applicant->id ? 'chevron-down' : 'chevron-right' }}" class="w-4 h-4 text-slate-400"></i>
                                            <span>{{ $applicant->candidate->name }}</span>
                                        </button>
                                    </td>
                                    <td class="py-4 px-4 text-slate-500">{{ $applicant->job->title }}</td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="px-2 py-0.5 rounded font-extrabold text-[11px] {{ $applicant->match_score >= 80 ? 'bg-emerald-100 text-emerald-800' : ($applicant->match_score >= 50 ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-500') }}">
                                            {{ $applicant->match_score }}%
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-slate-400">{{ $applicant->created_at->format('d M Y') }}</td>
                                    <td class="py-4 px-4">
                                        @if($applicant->resume_path)
                                            <a href="/{{ $applicant->resume_path }}" target="_blank" class="text-primary hover:underline font-semibold flex items-center gap-1">
                                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                                <span>Lihat Resume</span>
                                            </a>
                                        @else
                                            <span class="text-slate-400">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">
                                        <select wire:change="changeStatus({{ $applicant->id }}, $event.target.value)" class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg px-2.5 py-1 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary cursor-pointer font-semibold font-semibold">
                                            <option value="Applied" {{ $applicant->status === 'Applied' ? 'selected' : '' }}>Terkirim</option>
                                            <option value="Reviewed" {{ $applicant->status === 'Reviewed' ? 'selected' : '' }}>Ditinjau</option>
                                            <option value="Interview" {{ $applicant->status === 'Interview' ? 'selected' : '' }}>Wawancara</option>
                                            <option value="Accepted" {{ $applicant->status === 'Accepted' ? 'selected' : '' }}>Diterima</option>
                                            <option value="Rejected" {{ $applicant->status === 'Rejected' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </td>
                                </tr>
                                
                                @if($expandedApplicantId === $applicant->id)
                                    <tr class="bg-slate-50/50 dark:bg-slate-900/30">
                                        <td colspan="6" class="p-6 border-b border-slate-100 dark:border-slate-800">
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                                <!-- Contact Info & Education -->
                                                <div class="space-y-4">
                                                    <div>
                                                        <h5 class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-2">Informasi Kontak & Bio</h5>
                                                        <div class="space-y-1.5 text-xs text-slate-600 dark:text-slate-400">
                                                            <div class="flex items-center gap-1.5">
                                                                <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-400"></i>
                                                                <a href="mailto:{{ $applicant->candidate->email }}" class="hover:underline text-primary">{{ $applicant->candidate->email }}</a>
                                                            </div>
                                                            @if($applicant->candidate->phone)
                                                                <div class="flex items-center gap-1.5">
                                                                    <i data-lucide="phone" class="w-3.5 h-3.5 text-slate-400"></i>
                                                                    <span>{{ $applicant->candidate->phone }}</span>
                                                                </div>
                                                            @endif
                                                            @if($applicant->candidate->location)
                                                                <div class="flex items-center gap-1.5">
                                                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-400"></i>
                                                                    <span>{{ $applicant->candidate->location }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @if($applicant->candidate->bio)
                                                            <p class="text-xs text-slate-500 italic mt-3 bg-white dark:bg-slate-900 p-3 rounded-xl border border-slate-200/50 dark:border-slate-800/50">
                                                                "{{ $applicant->candidate->bio }}"
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Match & Resume Info -->
                                                <div class="space-y-4">
                                                    <div>
                                                        <h5 class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-2">Analisis AI Match Score</h5>
                                                        <div class="space-y-2 text-xs">
                                                            <div class="flex items-center justify-between text-slate-600 dark:text-slate-400">
                                                                <span>Keahlian & Skill:</span>
                                                                <span class="font-bold {{ $applicant->skill_score >= 80 ? 'text-emerald-500' : ($applicant->skill_score >= 50 ? 'text-amber-500' : 'text-slate-500') }}">{{ $applicant->skill_score }}%</span>
                                                            </div>
                                                            <div class="flex items-center justify-between text-slate-600 dark:text-slate-400">
                                                                <span>Kesesuaian Pengalaman:</span>
                                                                <span class="font-bold {{ $applicant->experience_score >= 80 ? 'text-emerald-500' : ($applicant->experience_score >= 50 ? 'text-amber-500' : 'text-slate-500') }}">{{ $applicant->experience_score }}%</span>
                                                            </div>
                                                            <div class="flex items-center justify-between text-slate-600 dark:text-slate-400">
                                                                <span>Kesesuaian Pendidikan:</span>
                                                                <span class="font-bold {{ $applicant->education_score >= 80 ? 'text-emerald-500' : ($applicant->education_score >= 50 ? 'text-amber-500' : 'text-slate-500') }}">{{ $applicant->education_score }}%</span>
                                                            </div>
                                                            <div class="flex items-center justify-between text-slate-600 dark:text-slate-400">
                                                                <span>Kesesuaian Gaji & Lokasi:</span>
                                                                <span class="font-bold {{ ($applicant->salary_score + $applicant->location_score)/2 >= 80 ? 'text-emerald-500' : 'text-slate-500' }}">{{ round(($applicant->salary_score + $applicant->location_score)/2) }}%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Experience & Skills details -->
                                                <div class="space-y-4">
                                                    <div>
                                                        <h5 class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-2">Kualifikasi Utama</h5>
                                                        <div class="space-y-1 text-xs text-slate-700 dark:text-slate-300">
                                                            <div><strong>Pendidikan:</strong> {{ $applicant->candidate->education_level ?: '-' }}</div>
                                                            <div><strong>Pengalaman:</strong> {{ $applicant->candidate->experience_years ?: 0 }} Tahun</div>
                                                            @if($applicant->candidate->expected_salary)
                                                                <div><strong>Harapan Gaji:</strong> Rp {{ number_format($applicant->candidate->expected_salary, 0, ',', '.') }} / Bulan</div>
                                                            @endif
                                                        </div>
                                                        
                                                        @if($applicant->candidate->skills)
                                                            <div class="mt-3 flex flex-wrap gap-1">
                                                                @php
                                                                    $skills = is_array($applicant->candidate->skills) ? $applicant->candidate->skills : (json_decode($applicant->candidate->skills, true) ?: explode(',', $applicant->candidate->skills));
                                                                @endphp
                                                                @foreach($skills as $sk)
                                                                    @if(trim($sk))
                                                                        <span class="px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-[10px] text-slate-600 dark:text-slate-400 font-medium">{{ trim($sk) }}</span>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            @if($applicant->cover_letter)
                                                <div class="mt-5 pt-4 border-t border-slate-200/50 dark:border-slate-850">
                                                    <h5 class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1.5">Surat Lamaran / Cover Letter</h5>
                                                    <p class="text-xs text-slate-700 dark:text-slate-300 whitespace-pre-line bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200/50 dark:border-slate-800/50">
                                                        {{ $applicant->cover_letter }}
                                                    </p>
                                                </div>
                                            @endif

                                            {{-- Chat Action --}}
                                            <div class="mt-5 pt-4 border-t border-slate-200/50 dark:border-slate-850 flex flex-wrap gap-3 items-center">
                                                <a href="/messages?user_id={{ $applicant->candidate->id }}" 
                                                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary-hover text-white text-xs font-extrabold rounded-xl transition shadow-md shadow-primary/20"
                                                   wire:navigate>
                                                    <i data-lucide="message-square" class="w-4 h-4"></i>
                                                    Hubungi Pelamar via Chat
                                                </a>
                                                <a href="mailto:{{ $applicant->candidate->email }}" 
                                                   class="inline-flex items-center gap-2 px-5 py-2.5 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 text-xs font-bold rounded-xl transition">
                                                    <i data-lucide="mail" class="w-4 h-4"></i>
                                                    Kirim Email
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12 text-slate-400">
                                        Belum ada pelamar masuk yang sesuai kriteria pencarian.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Tab: Profile Company -->
        @if($activeTab === 'profile')
            <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">Profil Perusahaan</h2>
                    <p class="text-xs text-slate-400">Pengaturan data merek, media sosial, dan kontak resmi perwakilan HRD.</p>
                </div>

                @if (session()->has('success'))
                    <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="saveCompanyProfile" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Company Name -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nama Perusahaan</label>
                            <input type="text" wire:model="companyName" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        </div>

                        <!-- Industry Category -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kategori / Sektor Industri</label>
                            <input type="text" wire:model="companyCategory" placeholder="e.g. Teknologi, Logistik" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Website -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Website Resmi</label>
                            <input type="url" wire:model="companyWebsite" placeholder="https://perusahaan.com" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        </div>

                        <!-- Phone -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nomor Telepon Kantor</label>
                            <input type="text" wire:model="companyPhone" placeholder="08xxxxxxxx" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Location (City) -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kota Headquarter</label>
                            <input type="text" wire:model="companyLocation" placeholder="e.g. Surabaya, Jakarta" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        </div>

                        <!-- Scale -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Skala Jumlah Karyawan</label>
                            <select wire:model="companyScale" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                                <option value="1-10 karyawan">1 - 10 Karyawan</option>
                                <option value="10-50 karyawan">10 - 50 Karyawan</option>
                                <option value="50-200 karyawan">50 - 200 Karyawan</option>
                                <option value="200-1000 karyawan">200 - 1000 Karyawan</option>
                                <option value="1000+ karyawan">Lebih dari 1000 Karyawan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Alamat Lengkap Kantor</label>
                        <textarea wire:model="companyAddress" rows="2" placeholder="Tuliskan jalan, nomor, kecamatan, dan provinsi..." class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400"></textarea>
                    </div>

                    <!-- Description -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tentang Perusahaan</label>
                        <textarea wire:model="companyDescription" rows="5" placeholder="Tuliskan deskripsi singkat mengenai perusahaan Anda..." class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400"></textarea>
                    </div>

                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-primary/20">
                            Simpan Profil Perusahaan
                        </button>
                    </div>
                </form>
            </div>
        @endif

            </div>
        </main>
    </div>

    <!-- Job Modals (Create / Edit) -->
    @if($showJobModal)
        <div class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-950/60 dark:bg-black/80 backdrop-blur-sm" wire:click="$set('showJobModal', false)"></div>

            <!-- Modal Content -->
            <div class="relative bg-white dark:bg-darkCard w-full max-w-3xl rounded-3xl border border-slate-200 dark:border-slate-800 shadow-2xl p-6 sm:p-8 space-y-6 z-10 transition">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="briefcase" class="text-primary w-5 h-5"></i>
                        {{ $jobId ? 'Perbarui Iklan Lowongan' : 'Pasang Iklan Lowongan Baru' }}
                    </h3>
                    <button wire:click="$set('showJobModal', false)" class="p-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-400">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <form wire:submit.prevent="saveJob" class="space-y-4 max-h-[70vh] overflow-y-auto pr-2">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Job Title -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Judul Pekerjaan</label>
                            <input type="text" wire:model="jobTitle" placeholder="e.g. Backend Laravel Developer" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                            @error('jobTitle') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Category -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Kategori Karir</label>
                            <select wire:model.live="category_id" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                <option value="new" class="text-primary font-bold text-emerald-600 dark:text-emerald-400">+ Tambah Kategori Baru</option>
                            </select>
                            @error('category_id') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror

                            @if($category_id === 'new')
                                <div class="mt-2 space-y-1 animate-fadeIn">
                                    <label class="text-[9px] font-bold text-primary dark:text-emerald-400 uppercase tracking-wider block">Nama Kategori Baru</label>
                                    <input type="text" wire:model="new_category_name" placeholder="Tulis nama kategori baru..." class="w-full bg-slate-50 dark:bg-slate-900 border border-primary/40 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                                    @error('new_category_name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Contract Type -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Jenis Kontrak</label>
                            <select wire:model="employment_type" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                                <option value="Full-time">Full-time</option>
                                <option value="Part-time">Part-time</option>
                                <option value="Contract">Kontrak</option>
                                <option value="Internship">Magang</option>
                                <option value="Freelance">Freelance</option>
                            </select>
                        </div>

                        <!-- Work Mode -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Metode Kerja</label>
                            <select wire:model="location_type" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                                <option value="Onsite">Onsite (Bekerja di Kantor)</option>
                                <option value="Remote">Remote (Bekerja dari Rumah)</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>

                        <!-- City Placement -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Kota Penempatan</label>
                            <input type="text" wire:model="city" placeholder="e.g. Surabaya" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                            @error('city') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Exp -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Minimal Pengalaman (Tahun)</label>
                            <input type="number" wire:model="experience_years" min="0" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        </div>

                        <!-- Education Required -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Minimal Pendidikan</label>
                            <select wire:model="education_level" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                                <option value="SMA/SMK">SMA / SMK</option>
                                <option value="D3">Diploma (D3)</option>
                                <option value="S1">Sarjana (S1)</option>
                                <option value="S2">Magister (S2)</option>
                            </select>
                        </div>

                        <!-- Skills input -->
                        <div class="space-y-1 col-span-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Keahlian (Pisahkan dengan koma)</label>
                            <input type="text" wire:model="skills_input" placeholder="e.g. Laravel, PHP, Git" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Salary Min -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Minimal Gaji Bulanan (Rp)</label>
                            <input type="number" wire:model="salary_min" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                            @error('salary_min') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Salary Max -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Maksimal Gaji Bulanan (Rp)</label>
                            <input type="number" wire:model="salary_max" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                            @error('salary_max') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Badges -->
                    <div class="flex items-center gap-6 pt-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" wire:model="is_featured" class="rounded border-slate-300 text-primary focus:ring-primary">
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Pasang Badge Featured</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" wire:model="is_urgent" class="rounded border-slate-300 text-primary focus:ring-primary">
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Pasang Badge Urgent</span>
                        </label>
                    </div>

                    <!-- Description -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Deskripsi Lowongan</label>
                        <textarea wire:model="description" rows="4" placeholder="Jelajahi deskripsi pekerjaan..." class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400"></textarea>
                        @error('description') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Requirements -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Kualifikasi Pelamar</label>
                        <textarea wire:model="requirements" rows="3" placeholder="Tuliskan minimal 1 kualifikasi..." class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400"></textarea>
                    </div>

                    <!-- Benefits -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Fasilitas & Benefit</label>
                        <textarea wire:model="benefits" rows="2" placeholder="e.g. Asuransi Kesehatan, Makan Siang Gratis..." class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400"></textarea>
                    </div>

                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end gap-3">
                        <button type="button" wire:click="$set('showJobModal', false)" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold rounded-xl text-xs transition">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-primary/20">
                            {{ $jobId ? 'Perbarui Lowongan' : 'Pasang Lowongan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
