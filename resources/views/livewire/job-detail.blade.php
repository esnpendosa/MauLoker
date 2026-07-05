<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 shrink-0"></i>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl flex items-center gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 text-rose-500 shrink-0"></i>
            <span class="text-sm font-semibold">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Top Ad Banner -->
    @if($topAd)
        <div class="w-full">
            {!! $topAd->code_content !!}
        </div>
    @endif

    <!-- Job Header Block -->
    <div class="bg-white dark:bg-darkCard p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
        <!-- Accent Glow -->
        <div class="absolute right-0 top-0 w-32 h-32 bg-primary/5 rounded-full blur-2xl"></div>

        <div class="flex items-center gap-5 relative z-10">
            @if($job->company->logo)
                <img src="{{ $job->company->logo }}" alt="{{ $job->company->name }}" class="w-16 h-16 object-contain rounded-2xl border border-slate-100 dark:border-slate-800">
            @else
                <div class="w-16 h-16 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold text-2xl shrink-0">
                    {{ substr($job->company->name, 0, 1) }}
                </div>
            @endif

            <div class="space-y-1.5">
                <div class="flex flex-wrap items-center gap-2">
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white leading-tight">
                        {{ $job->title }}
                    </h1>
                    @if($job->is_sponsored)
                        <span class="px-2 py-0.5 rounded text-[8px] bg-amber-100 text-amber-800 border border-amber-200 font-extrabold uppercase">Sponsored</span>
                    @endif
                    @if($job->is_urgent)
                        <span class="px-2 py-0.5 rounded text-[8px] bg-rose-100 text-rose-800 border border-rose-200 font-extrabold uppercase">Urgent</span>
                    @endif
                </div>

                <div class="flex flex-wrap items-center gap-x-4 gap-y-1.5 text-xs text-slate-500 dark:text-slate-400">
                    <a href="/company/{{ $job->company->slug }}" class="hover:underline font-bold text-slate-700 dark:text-slate-300">{{ $job->company->name }}</a>
                    <span>&bull;</span>
                    <span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-4 h-4 text-emerald-500"></i> {{ $job->city }}</span>
                    <span>&bull;</span>
                    <span class="flex items-center gap-1"><i data-lucide="clock" class="w-4 h-4 text-emerald-500"></i> {{ $job->employment_type }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-3 relative z-10">
            <button wire:click="toggleSaveJob" class="px-5 py-3.5 rounded-2xl border {{ $isSaved ? 'bg-rose-50 border-rose-200 dark:bg-rose-950/20 dark:border-rose-900/50 text-rose-500' : 'bg-slate-50 border-slate-200 dark:bg-slate-800 dark:border-slate-700 text-slate-600 dark:text-slate-400 hover:bg-slate-100' }} text-sm font-bold transition flex items-center justify-center gap-2">
                <i data-lucide="bookmark" class="w-4 h-4 {{ $isSaved ? 'fill-current' : '' }}"></i>
                <span>{{ $isSaved ? 'Tersimpan' : 'Simpan' }}</span>
            </button>

            @if($job->company && $job->company->user_id)
                @auth
                    @if(auth()->id() !== $job->company->user_id)
                        <a href="/messages?user_id={{ $job->company->user_id }}" class="px-5 py-3.5 rounded-2xl border border-slate-200 dark:border-slate-750 bg-slate-50 dark:bg-slate-800 text-slate-700 dark:text-slate-350 hover:bg-slate-100 text-sm font-bold transition flex items-center justify-center gap-2" wire:navigate>
                            <i data-lucide="message-square" class="w-4 h-4 text-primary"></i>
                            <span>Tanya Perekrut</span>
                        </a>
                    @endif
                @else
                    <a href="/login" class="px-5 py-3.5 rounded-2xl border border-slate-200 dark:border-slate-750 bg-slate-50 dark:bg-slate-800 text-slate-700 dark:text-slate-350 hover:bg-slate-100 text-sm font-bold transition flex items-center justify-center gap-2">
                        <i data-lucide="message-square" class="w-4 h-4 text-primary"></i>
                        <span>Tanya Perekrut</span>
                    </a>
                @endauth
            @endif

            @if($hasApplied)
                <button disabled class="w-full md:w-auto px-8 py-3.5 bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 font-bold rounded-2xl text-sm cursor-not-allowed flex items-center justify-center gap-1.5">
                    <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500"></i>
                    <span>Telah Dilamar</span>
                </button>
            @else
                @if($hasCv)
                    <button wire:click="quickApply" wire:loading.attr="disabled" class="w-full md:w-auto px-6 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold rounded-2xl text-sm transition shadow-lg shadow-emerald-600/25 flex items-center justify-center gap-2">
                        <i data-lucide="zap" class="w-4 h-4 fill-current"></i>
                        <span>Lamar Cepat (1-Klik)</span>
                    </button>
                @endif
                <button wire:click="openApply" class="w-full md:w-auto px-8 py-3.5 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-2xl text-sm transition shadow-lg shadow-primary/25 flex items-center justify-center gap-2">
                    <span>Lamar Pekerjaan</span>
                    <i data-lucide="send" class="w-4 h-4"></i>
                </button>
            @endif
        </div>
    </div>

    <!-- Two Column Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Details Overview -->
            <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm grid grid-cols-2 sm:grid-cols-4 gap-6">
                <div>
                    <span class="text-xs text-slate-400 block font-medium">Batas Gaji</span>
                    <span class="font-bold text-sm sm:text-base text-emerald-600 dark:text-emerald-400 mt-1 block">
                        @if($job->salary_min && $job->salary_max)
                            Rp {{ number_format($job->salary_min/1000000, 1) }}jt - {{ number_format($job->salary_max/1000000, 1) }}jt
                        @else
                            Kompetitif
                        @endif
                    </span>
                </div>
                <div>
                    <span class="text-xs text-slate-400 block font-medium">Pengalaman</span>
                    <span class="font-bold text-sm sm:text-base text-slate-800 dark:text-slate-200 mt-1 block">
                        Min. {{ $job->experience_years }} Tahun
                    </span>
                </div>
                <div>
                    <span class="text-xs text-slate-400 block font-medium">Pendidikan</span>
                    <span class="font-bold text-sm sm:text-base text-slate-800 dark:text-slate-200 mt-1 block">
                        {{ $job->education_level ?: 'Semua Jenjang' }}
                    </span>
                </div>
                <div>
                    <span class="text-xs text-slate-400 block font-medium">Metode Kerja</span>
                    <span class="font-bold text-sm sm:text-base text-slate-800 dark:text-slate-200 mt-1 block">
                        {{ $job->location_type }}
                    </span>
                </div>
            </div>

            <!-- Job Description -->
            <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">Deskripsi Pekerjaan</h3>
                    <div class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed whitespace-pre-line">
                        {{ $job->description }}
                    </div>
                </div>

                @if($job->requirements)
                    <div class="space-y-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white pb-1">Kualifikasi Pelamar</h3>
                        <div class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed whitespace-pre-line">
                            {{ $job->requirements }}
                        </div>
                    </div>
                @endif

                @if($job->skills)
                    <div class="space-y-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white pb-2">Keahlian yang Dibutuhkan</h3>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $skills = is_array($job->skills) ? $job->skills : (json_decode($job->skills, true) ?? explode(',', $job->skills));
                            @endphp
                            @foreach($skills as $skill)
                                <span class="px-3.5 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs font-bold text-slate-700 dark:text-slate-300">
                                    {{ trim($skill) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($job->benefits)
                    <div class="space-y-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white pb-1">Fasilitas & Benefit</h3>
                        <div class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed whitespace-pre-line">
                            {{ $job->benefits }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Sidebar Widgets -->
        <div class="space-y-6">
            
            <!-- Match Score Widget -->
            @auth
                @if(auth()->user()->isCandidate() && $matchResult)
                    <div class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                        <div class="flex items-center justify-between">
                            <h4 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <i data-lucide="sparkles" class="text-primary w-5 h-5 animate-pulse"></i>
                                Match Score Engine
                            </h4>
                            <span class="text-[10px] bg-primary/10 text-primary font-bold px-2 py-0.5 rounded uppercase">Live AI</span>
                        </div>

                        <!-- Progress Circle Meter -->
                        <div class="flex flex-col items-center justify-center py-4 space-y-2">
                            <div class="relative w-28 h-28 flex items-center justify-center rounded-full border-8 border-slate-100 dark:border-slate-900">
                                <div class="absolute inset-0 rounded-full border-8 border-primary border-t-transparent animate-spin-slow"></div>
                                <span class="text-3xl font-black text-primary">{{ $matchResult['overall'] }}%</span>
                            </div>
                            <span class="text-xs font-bold text-slate-600 dark:text-slate-300 mt-2">Kecocokan Profil Anda</span>
                        </div>

                        <!-- Details Breakdown -->
                        <div class="space-y-3.5 text-xs">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Keahlian (Skills)</span>
                                <span class="font-bold {{ $matchResult['skill_score'] >= 70 ? 'text-emerald-500' : 'text-slate-500' }}">{{ $matchResult['skill_score'] }}%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Pengalaman</span>
                                <span class="font-bold {{ $matchResult['experience_score'] >= 70 ? 'text-emerald-500' : 'text-slate-500' }}">{{ $matchResult['experience_score'] }}%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Lokasi Kerja</span>
                                <span class="font-bold {{ $matchResult['location_score'] >= 70 ? 'text-emerald-500' : 'text-slate-500' }}">{{ $matchResult['location_score'] }}%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Ekspektasi Gaji</span>
                                <span class="font-bold {{ $matchResult['salary_score'] >= 70 ? 'text-emerald-500' : 'text-slate-500' }}">{{ $matchResult['salary_score'] }}%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Pendidikan</span>
                                <span class="font-bold {{ $matchResult['education_score'] >= 70 ? 'text-emerald-500' : 'text-slate-500' }}">{{ $matchResult['education_score'] }}%</span>
                            </div>
                        </div>

                        <!-- Probability Analysis -->
                        <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl space-y-2 border border-slate-100 dark:border-slate-900">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-slate-400">Persaingan Lowongan</span>
                                <span class="font-bold text-primary">{{ $matchResult['competition_level'] }}</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-slate-400">Peluang Lolos Wawancara</span>
                                <span class="font-bold text-emerald-500">{{ $matchResult['acceptance_probability'] }}%</span>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <!-- Guest Prompt -->
                <div class="bg-gradient-to-r from-emerald-500/10 to-teal-500/10 p-6 rounded-3xl border border-primary/20 space-y-4">
                    <h4 class="font-bold text-slate-900 dark:text-white flex items-center gap-1.5 text-sm">
                        <i data-lucide="sparkles" class="text-primary w-4.5 h-4.5"></i>
                        Mau Cek Kecocokan Profil?
                    </h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Masuk atau daftar sebagai pencari kerja untuk melihat AI Match Score secara instan.
                    </p>
                    <a href="/login" class="w-full py-2.5 bg-primary hover:bg-primary-hover text-white text-center font-bold rounded-xl text-xs transition inline-block">
                        Masuk Sekarang
                    </a>
                </div>
            @endauth

            <!-- Company Summary Card -->
            <div class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-5">
                <h4 class="font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">Profil Perusahaan</h4>
                
                <div class="flex items-center gap-3">
                    @if($job->company->logo)
                        <img src="{{ $job->company->logo }}" alt="{{ $job->company->name }}" class="w-12 h-12 object-contain rounded-xl">
                    @else
                        <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                            {{ substr($job->company->name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <a href="/company/{{ $job->company->slug }}" class="font-bold text-sm text-slate-800 dark:text-slate-200 hover:text-primary transition block">{{ $job->company->name }}</a>
                        <span class="text-[10px] text-slate-400 block">{{ $job->company->category }}</span>
                    </div>
                </div>

                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    {{ \Illuminate\Support\Str::limit($job->company->description, 120) }}
                </p>

                <div class="space-y-3 pt-3 border-t border-slate-100 dark:border-slate-800 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400">Reputasi Perusahaan</span>
                        <span class="font-semibold text-amber-500 flex items-center gap-0.5">
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                            {{ $job->company->reputation_score }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400">Kecepatan Respon</span>
                        <span class="font-semibold text-emerald-500">{{ $job->company->response_time }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400">Skala Perusahaan</span>
                        <span class="font-semibold">{{ $job->company->scale }}</span>
                    </div>
                </div>
            </div>

            <!-- Sidebar Ad -->
            @if($sidebarAd)
                <div class="w-full">
                    {!! $sidebarAd->code_content !!}
                </div>
            @endif
        </div>
    </div>

    <!-- Application Modal -->
    @if($showApplyModal)
        <div class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-950/60 dark:bg-black/80 backdrop-blur-sm" wire:click="$set('showApplyModal', false)"></div>

            <!-- Modal Content -->
            <div class="relative bg-white dark:bg-darkCard w-full max-w-xl rounded-3xl border border-slate-200 dark:border-slate-800 shadow-2xl p-6 sm:p-8 space-y-6 z-10 transition">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="send" class="text-primary w-5 h-5"></i>
                        Kirim Lamaran Pekerjaan
                    </h3>
                    <button wire:click="$set('showApplyModal', false)" class="p-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-400">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <form wire:submit.prevent="submitApplication" class="space-y-6">
                    <!-- CV File selection -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Dokumen CV / Resume (PDF)</label>
                        
                        @if(auth()->user()->cv_path)
                            <div class="p-4 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                                        <i data-lucide="file-text" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300 block">CV Profil Tersimpan</span>
                                        <span class="text-[10px] text-slate-400">Sistem akan otomatis menggunakan CV yang tersimpan di profil Anda.</span>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold text-emerald-500 bg-emerald-100 dark:bg-emerald-950/20 px-2 py-0.5 rounded">Tersedia</span>
                            </div>
                            
                            <div class="text-center py-2 text-[10px] text-slate-400">Atau unggah CV baru di bawah ini untuk memperbarui CV profil Anda.</div>
                        @endif

                        <div class="p-6 border-2 border-dashed border-slate-200 dark:border-slate-800 hover:border-primary dark:hover:border-primary rounded-2xl text-center space-y-2 cursor-pointer relative">
                            <input type="file" wire:model="resume_file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <i data-lucide="upload-cloud" class="w-10 h-10 text-slate-400 mx-auto"></i>
                            <div class="text-xs font-bold">Pilih file PDF atau seret ke sini</div>
                            <div class="text-[10px] text-slate-400">Maksimum ukuran file: 5MB (PDF)</div>

                            @if($resume_file)
                                <div class="text-xs font-bold text-emerald-500 flex items-center justify-center gap-1 mt-2">
                                    <i data-lucide="file" class="w-4 h-4"></i>
                                    <span>{{ $resume_file->getClientOriginalName() }}</span>
                                </div>
                            @endif
                        </div>
                        @error('resume_file') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Cover letter -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Surat Lamaran (Cover Letter)</label>
                        <textarea wire:model="cover_letter" rows="5" placeholder="Tuliskan mengapa Anda adalah kandidat yang tepat untuk posisi ini. Ceritakan secara singkat skill dan pengalaman relevan Anda..." class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl px-4 py-3 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400"></textarea>
                        @error('cover_letter') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end gap-3">
                        <button type="button" wire:click="$set('showApplyModal', false)" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold rounded-xl text-xs transition">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-primary/20">
                            Kirim Lamaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
