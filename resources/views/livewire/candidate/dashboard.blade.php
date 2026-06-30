<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    
    <!-- Top Dashboard Header -->
    <div class="bg-[#111827] text-white p-8 rounded-3xl border border-slate-800 shadow-xl relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6">
        <!-- Glow accents -->
        <div class="absolute top-0 right-0 w-48 h-48 bg-primary/10 rounded-full blur-[100px]"></div>

        <div class="flex items-center gap-5 relative z-10">
            @if($user->avatar)
                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-2xl object-cover border-2 border-primary/20">
            @else
                <div class="w-16 h-16 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold text-2xl">
                    {{ substr($user->name, 0, 1) }}
                </div>
            @endif
            <div>
                <h1 class="text-xl sm:text-2xl font-black">{{ $user->name }}</h1>
                <p class="text-xs text-slate-400">Pencari Kerja &bull; {{ $user->location ?: 'Kota Belum Diisi' }}</p>
                <div class="flex items-center gap-2 mt-2">
                    <span class="px-2 py-0.5 rounded bg-primary/20 border border-primary/30 text-[10px] text-primary font-bold">
                        ATS Score: {{ $user->cv_ats_score ?? 0 }}%
                    </span>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-2 relative z-10">
            <button wire:click="$set('activeTab', 'profile')" class="px-5 py-2.5 rounded-xl text-xs font-bold transition {{ $activeTab === 'profile' ? 'bg-primary text-white' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                <i data-lucide="user" class="w-4 h-4 inline-block mr-1"></i> Edit Profil
            </button>
            <button wire:click="$set('activeTab', 'cv_builder')" class="px-5 py-2.5 rounded-xl text-xs font-bold transition {{ $activeTab === 'cv_builder' ? 'bg-primary text-white' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                <i data-lucide="file-text" class="w-4 h-4 inline-block mr-1"></i> CV ATS & Analyzer
            </button>
            <button wire:click="$set('activeTab', 'applications')" class="px-5 py-2.5 rounded-xl text-xs font-bold transition {{ $activeTab === 'applications' ? 'bg-primary text-white' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                <i data-lucide="check-square" class="w-4 h-4 inline-block mr-1"></i> Lacak Lamaran
            </button>
        </div>
    </div>

    <!-- Ad Placement -->
    @if($dashboardAd)
        <div class="w-full">
            {!! $dashboardAd->code_content !!}
        </div>
    @endif

    <!-- Main Tab Contents -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Left Sidebar Statistics -->
        <aside class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
            <h3 class="font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3 uppercase text-xs tracking-wider">Status Akun</h3>
            
            <div class="space-y-4">
                <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl flex items-center justify-between">
                    <div>
                        <span class="text-xs text-slate-400 block">Kekuatan Resume</span>
                        <span class="font-black text-slate-800 dark:text-slate-200 text-lg mt-0.5 block">{{ $user->cv_ats_score ?? 0 }} / 100</span>
                    </div>
                    <i data-lucide="shield-check" class="w-8 h-8 text-primary opacity-60"></i>
                </div>

                <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl flex items-center justify-between">
                    <div>
                        <span class="text-xs text-slate-400 block">Total Lamaran</span>
                        <span class="font-black text-slate-800 dark:text-slate-200 text-lg mt-0.5 block">{{ $applications->count() }} Lamaran</span>
                    </div>
                    <i data-lucide="send" class="w-8 h-8 text-indigo-500 opacity-60"></i>
                </div>
            </div>

            <!-- Short tip box -->
            <div class="p-4 bg-primary/5 border border-primary/10 rounded-2xl text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                <strong class="text-primary block mb-1">Tips Lolos Screening ATS:</strong>
                Gunakan template CV 'Classic ATS' di tab CV Analyzer, lalu masukkan keterampilan kunci (seperti Laravel, PHP, Git) yang relevan dengan kualifikasi lowongan pekerjaan target Anda.
            </div>
        </aside>

        <!-- Right Main Tab View -->
        <main class="lg:col-span-2">
            
            <!-- Tab: Profile Edit -->
            @if($activeTab === 'profile')
                <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                    <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Pengaturan Profil</h2>
                        <p class="text-xs text-slate-400">Pastikan informasi di bawah ini selalu diperbarui untuk mengoptimalkan AI Match Score lowongan.</p>
                    </div>

                    @if (session()->has('success'))
                        <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="saveProfile" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Name -->
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nama Lengkap</label>
                                <input type="text" wire:model="name" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                                @error('name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                            </div>

                            <!-- Phone -->
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nomor Telepon</label>
                                <input type="text" wire:model="phone" placeholder="08xxxxxxxxx" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Location -->
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kota Domisili</label>
                                <input type="text" wire:model="location" placeholder="e.g. Surabaya, Jakarta" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                            </div>

                            <!-- Education -->
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pendidikan Terakhir</label>
                                <select wire:model="education_level" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="SMA/SMK">SMA / SMK</option>
                                    <option value="D3">Diploma (D3)</option>
                                    <option value="S1">Sarjana (S1)</option>
                                    <option value="S2">Magister (S2)</option>
                                    <option value="S3">Doktor (S3)</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Exp -->
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pengalaman Kerja (Tahun)</label>
                                <input type="number" wire:model="experience_years" min="0" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                            </div>

                            <!-- Salary -->
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Ekspektasi Gaji Bulanan (Rp)</label>
                                <input type="number" wire:model="expected_salary" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Daftar Keahlian (Pisahkan dengan koma)</label>
                            <textarea wire:model="skills_input" rows="2" placeholder="e.g. Laravel, PHP, Vue.js, TailwindCSS, MySQL" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400"></textarea>
                        </div>

                        <!-- Bio -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Ringkasan Bio Profil</label>
                            <textarea wire:model="bio" rows="4" placeholder="Tuliskan tentang diri Anda secara profesional..." class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400"></textarea>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                            <button type="submit" class="px-6 py-2.5 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-primary/20">
                                Simpan Profil
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- Tab: CV Builder & ATS Analyzer -->
            @if($activeTab === 'cv_builder')
                <div class="space-y-8">
                    <!-- Upload section / ATS checker -->
                    <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                        <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <i data-lucide="shield-check" class="text-primary w-5 h-5"></i>
                                Unggah & Cek ATS Score CV Anda
                            </h2>
                            <p class="text-xs text-slate-400">Sistem kami akan memindai teks CV PDF Anda dan mengukur skor kecocokan dengan standar penyaringan HRD.</p>
                        </div>

                        <form wire:submit.prevent="uploadCv" class="space-y-4">
                            <div class="p-6 border-2 border-dashed border-slate-200 dark:border-slate-800 hover:border-primary dark:hover:border-primary rounded-3xl text-center space-y-3 cursor-pointer relative">
                                <input type="file" wire:model="new_cv_file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                <i data-lucide="upload-cloud" class="w-12 h-12 text-slate-400 mx-auto"></i>
                                <div class="text-xs font-bold text-slate-800 dark:text-slate-200">Klik untuk mengunggah dokumen CV PDF</div>
                                <div class="text-[10px] text-slate-400">Maksimal 5MB, format PDF wajib teks (bukan scan gambar).</div>
                                
                                @if($new_cv_file)
                                    <div class="text-xs font-bold text-emerald-500 flex items-center justify-center gap-1 mt-2">
                                        <i data-lucide="file" class="w-4 h-4"></i>
                                        <span>{{ $new_cv_file->getClientOriginalName() }}</span>
                                    </div>
                                @endif
                            </div>
                            @error('new_cv_file') <span class="text-xs text-rose-500 block">{{ $message }}</span> @enderror

                            <div class="flex justify-end pt-2">
                                <button type="submit" class="px-6 py-2.5 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition">
                                    Mulai Uji ATS
                                </button>
                            </div>
                        </form>

                        <!-- ATS Scan results -->
                        @if($atsResults)
                            <div class="p-6 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-3xl space-y-6">
                                <div class="flex flex-col sm:flex-row items-center gap-6">
                                    <div class="w-20 h-20 rounded-full border-4 border-slate-200 dark:border-slate-800 flex items-center justify-center text-xl font-black text-primary shrink-0">
                                        {{ $atsResults['score'] }}%
                                    </div>
                                    <div class="space-y-1 text-center sm:text-left">
                                        <h4 class="font-bold text-sm text-slate-800 dark:text-slate-200">Hasil Pemindaian ATS</h4>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">{{ $atsResults['feedback'] }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs pt-4 border-t border-slate-200 dark:border-slate-800">
                                    <div class="space-y-2">
                                        <span class="text-slate-400 block font-semibold">Bagian Terdeteksi:</span>
                                        <ul class="space-y-1">
                                            @foreach($atsResults['sections_found'] as $sec)
                                                <li class="flex items-center gap-1.5 text-emerald-500 font-bold">
                                                    <i data-lucide="check" class="w-4 h-4"></i> {{ $sec }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="space-y-2">
                                        <span class="text-slate-400 block font-semibold">Bagian Terlewat / Tidak Terbaca:</span>
                                        <ul class="space-y-1">
                                            @foreach($atsResults['sections_missing'] as $sec)
                                                <li class="flex items-center gap-1.5 text-rose-500 font-bold">
                                                    <i data-lucide="x" class="w-4 h-4"></i> {{ $sec }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Online Resume Builder -->
                    <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                        <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <i data-lucide="printer" class="text-primary w-5 h-5"></i>
                                Ekspor CV ATS Instan (PDF)
                            </h2>
                            <p class="text-xs text-slate-400">Konversi data profil di tab 'Edit Profil' menjadi resume PDF ramah ATS yang siap diunduh dalam hitungan detik.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Pilih Desain CV</label>
                                <select wire:model="selectedTemplate" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                                    <option value="classic-ats">Classic ATS Simple (Layout Standard)</option>
                                    <option value="modern-prof">Modern Professional (Layout Kolom)</option>
                                </select>
                            </div>
                            
                            <div class="pt-6 sm:pt-0">
                                <button type="button" wire:click="downloadPdfResume" class="w-full py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold rounded-xl text-xs transition shadow-md shadow-emerald-500/25 flex items-center justify-center gap-2">
                                    <i data-lucide="download" class="w-4 h-4"></i>
                                    <span>Unduh Resume PDF</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tab: Applications Lacak -->
            @if($activeTab === 'applications')
                <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                    <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Pelacakan Status Lamaran</h2>
                        <p class="text-xs text-slate-400">Pantau proses lamaran Anda secara real-time dari seleksi awal hingga hasil akhir.</p>
                    </div>

                    <div class="space-y-6">
                        @forelse($applications as $app)
                            <div class="p-6 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-3xl space-y-4">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h4 class="font-bold text-sm text-slate-900 dark:text-white">{{ $app->job->title }}</h4>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">{{ $app->job->company->name }} &bull; {{ $app->job->city }}</p>
                                    </div>
                                    
                                    @php
                                        $statusColors = [
                                            'Applied' => 'bg-blue-100 text-blue-800 dark:bg-blue-950/20 dark:text-blue-400',
                                            'Reviewed' => 'bg-amber-100 text-amber-800 dark:bg-amber-950/20 dark:text-amber-400',
                                            'Interview' => 'bg-purple-100 text-purple-800 dark:bg-purple-950/20 dark:text-purple-400',
                                            'Accepted' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/20 dark:text-emerald-400',
                                            'Rejected' => 'bg-rose-100 text-rose-800 dark:bg-rose-950/20 dark:text-rose-400',
                                        ];
                                        $statusLabels = [
                                            'Applied' => 'Terkirim',
                                            'Reviewed' => 'Ditinjau HRD',
                                            'Interview' => 'Wawancara',
                                            'Accepted' => 'Diterima Kerja',
                                            'Rejected' => 'Ditolak',
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-0.5 rounded text-[10px] font-extrabold uppercase {{ $statusColors[$app->status] ?? 'bg-slate-100 text-slate-800' }}">
                                        {{ $statusLabels[$app->status] ?? $app->status }}
                                    </span>
                                </div>

                                <!-- Progress Stepper -->
                                <div class="pt-4 pb-2">
                                    <div class="flex items-center w-full">
                                        @php
                                            $steps = ['Applied', 'Reviewed', 'Interview', 'Accepted'];
                                            if ($app->status === 'Rejected') {
                                                $steps = ['Applied', 'Reviewed', 'Rejected'];
                                            }
                                            $currentIndex = array_search($app->status, $steps);
                                            if ($currentIndex === false) {
                                                $currentIndex = 0;
                                            }
                                        @endphp
                                        @foreach($steps as $index => $step)
                                            <div class="flex items-center {{ !$loop->last ? 'w-full' : '' }}">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs shrink-0 z-10 {{ $index <= $currentIndex ? 'bg-primary text-white' : 'bg-slate-200 dark:bg-slate-800 text-slate-400' }}">
                                                    {{ $index + 1 }}
                                                </div>
                                                @if(!$loop->last)
                                                    <div class="w-full h-1 {{ $index < $currentIndex ? 'bg-primary' : 'bg-slate-200 dark:bg-slate-800' }}"></div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex justify-between text-[10px] text-slate-400 font-bold mt-2 uppercase tracking-wide">
                                        <span>Kirim</span>
                                        <span>Ditinjau</span>
                                        @if($app->status === 'Rejected')
                                            <span class="text-rose-500">Ditolak</span>
                                        @else
                                            <span>Interview</span>
                                            <span>Hasil</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Match Engine confirmation -->
                                <div class="text-[10px] text-slate-400 flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-3">
                                    <span>AI Match Score: <strong>{{ $app->match_score }}%</strong></span>
                                    <span>Tanggal Kirim: {{ $app->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16 space-y-3">
                                <i data-lucide="inbox" class="w-12 h-12 text-slate-400 mx-auto"></i>
                                <h4 class="font-bold text-slate-800 dark:text-slate-200">Belum Ada Lamaran</h4>
                                <p class="text-xs text-slate-500 max-w-xs mx-auto">Anda belum mengirimkan lamaran pekerjaan. Cari lowongan kerja idaman Anda dan mulai melamar sekarang.</p>
                                <a href="/jobs" class="px-5 py-2.5 bg-primary hover:bg-primary-hover text-white text-xs font-bold rounded-xl transition inline-block">
                                    Mulai Cari Pekerjaan
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

        </main>

    </div>

</div>
