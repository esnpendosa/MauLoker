<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Sidebar Kiri (Gaya RightWork.inc) -->
        <aside class="lg:col-span-3 space-y-6">
            <!-- Profile Info Box -->
            <div class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm text-center">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-16 h-16 mx-auto rounded-2xl object-cover border-2 border-primary/20 mb-3 shadow-md">
                @else
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-primary to-emerald-500 flex items-center justify-center font-bold text-2xl shadow-lg text-white mb-3">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
                <h2 class="text-base font-black text-slate-900 dark:text-white leading-snug">{{ $user->name }}</h2>
                <p class="text-xs text-slate-400 mt-1">Pencari Kerja &bull; {{ $user->location ?: 'Lokasi belum diisi' }}</p>
                <div class="flex flex-col gap-1.5 mt-3">
                    <span class="px-2.5 py-1 rounded-lg bg-primary/20 border border-primary/20 text-[10px] text-primary-hover font-bold mx-auto">
                        Skor ATS: {{ $user->cv_ats_score ?? 0 }}%
                    </span>
                    @if($user->expected_salary)
                        <span class="px-2.5 py-1 rounded-lg bg-emerald-600/20 border border-emerald-500/20 text-[10px] text-emerald-300 font-bold mx-auto">
                            Ekspektasi: Rp {{ number_format($user->expected_salary, 0, ',', '.') }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Sidebar Navigation Menu -->
            <nav class="bg-white dark:bg-darkCard rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm p-4 space-y-1">
                @php
                    $candidateMenu = [
                        'profile' => ['label' => 'Edit Profil', 'icon' => 'user'],
                        'cv_builder' => ['label' => 'CV ATS & Analyzer', 'icon' => 'file-text'],
                        'applications' => ['label' => 'Lacak Lamaran', 'icon' => 'check-square'],
                        'saved_jobs' => ['label' => 'Lowongan Disimpan', 'icon' => 'bookmark'],
                        'messages' => ['label' => 'Pesan', 'icon' => 'message-square'],
                    ];
                    $unreadMessages = \App\Models\Message::where('receiver_id', auth()->id())->whereNull('read_at')->count();
                @endphp
                @foreach($candidateMenu as $key => $labelItem)
                    <button wire:click="$set('activeTab', '{{ $key }}')" 
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition text-left group
                        {{ $activeTab === $key 
                            ? 'bg-primary/10 text-primary border-l-4 border-primary' 
                            : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-900/50 hover:text-slate-900 dark:hover:text-white' 
                        }}">
                        <i data-lucide="{{ $labelItem['icon'] }}" class="w-4.5 h-4.5 shrink-0 transition {{ $activeTab === $key ? 'text-primary' : 'text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}"></i>
                        <span class="flex-1">{{ $labelItem['label'] }}</span>
                        @if($key === 'messages' && $unreadMessages > 0)
                            <span class="px-1.5 py-0.5 rounded-full bg-primary text-white text-[9px] font-bold shrink-0">{{ $unreadMessages }}</span>
                        @endif
                    </button>
                @endforeach
            </nav>

            <!-- Status Akun Stats -->
            <div class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-4">
                <h3 class="font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3 uppercase text-[10px] tracking-wider">Status Akun</h3>
                
                <div class="space-y-3">
                    <div class="p-3 bg-slate-50 dark:bg-slate-900/50 rounded-2xl flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block">Kekuatan Resume</span>
                            <span class="font-black text-slate-800 dark:text-slate-200 text-sm mt-0.5 block">{{ $user->cv_ats_score ?? 0 }} / 100</span>
                        </div>
                        <i data-lucide="shield-check" class="w-6 h-6 text-primary opacity-60"></i>
                    </div>

                    <div class="p-3 bg-slate-50 dark:bg-slate-900/50 rounded-2xl flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block">Total Lamaran</span>
                            <span class="font-black text-slate-800 dark:text-slate-200 text-sm mt-0.5 block">{{ $applications->count() }} Lamaran</span>
                        </div>
                        <i data-lucide="send" class="w-6 h-6 text-primary opacity-60"></i>
                    </div>

                    <div class="p-3 bg-slate-50 dark:bg-slate-900/50 rounded-2xl flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block">Lowongan Disimpan</span>
                            <span class="font-black text-slate-800 dark:text-slate-200 text-sm mt-0.5 block">{{ $savedJobs->count() }} Lowongan</span>
                        </div>
                        <i data-lucide="bookmark" class="w-6 h-6 text-primary opacity-60"></i>
                    </div>
                </div>

                <!-- Short tip box -->
                <div class="p-4 bg-primary/5 border border-primary/10 rounded-2xl text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed">
                    <strong class="text-primary block mb-1">Tips Lolos ATS:</strong>
                    Gunakan template CV 'Classic ATS' di tab CV Analyzer, lalu masukkan keterampilan kunci (seperti Laravel, PHP, Git) yang relevan.
                </div>
            </div>
        </aside>

        <!-- Area Konten Utama Kanan (Gaya RightWork.inc) -->
        <main class="lg:col-span-9 space-y-6">
            <!-- Search & Top Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="relative w-full max-w-md">
                    <input type="text" placeholder="Cari lowongan kerja, keterampilan, atau lokasi..." 
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
                    <span class="text-[10px] uppercase tracking-wider font-extrabold text-primary-hover">Selamat Datang di Portal Karir</span>
                    <h1 class="text-2xl sm:text-3xl font-black tracking-tight">Halo, {{ $user->name }} !</h1>
                    <p class="text-xs text-slate-400 max-w-lg leading-relaxed pt-1">
                        Bangun resume ramah ATS dengan AI Analyzer, lamar pekerjaan terpercaya, dan pantau proses rekrutmen Anda dari satu dasbor terpadu.
                    </p>
                </div>
            </div>

            <!-- Ad Placement -->
            @if($dashboardAd)
                <div class="w-full">
                    {!! $dashboardAd->code_content !!}
                </div>
            @endif
            
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
                                            'Applied' => 'bg-primary/10 text-primary',
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

            <!-- Tab: Saved Jobs -->
            @if($activeTab === 'saved_jobs')
                <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                    <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Lowongan Kerja Disimpan</h2>
                        <p class="text-xs text-slate-400">Daftar lowongan pekerjaan yang Anda simpan untuk dilamar nanti.</p>
                    </div>

                    @if (session()->has('success'))
                        <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-4">
                        @forelse($savedJobs as $saved)
                            @if($saved->job)
                                <div class="p-5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div class="flex items-center gap-4">
                                        @if($saved->job->company && $saved->job->company->logo)
                                            <img src="{{ $saved->job->company->logo }}" alt="{{ $saved->job->company->name }}" class="w-12 h-12 object-contain rounded-xl border border-slate-100 dark:border-slate-800 shrink-0">
                                        @else
                                            <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold text-lg shrink-0">
                                                {{ substr($saved->job->company->name ?? 'M', 0, 1) }}
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="font-bold text-sm text-slate-900 dark:text-white hover:underline">
                                                <a href="/jobs/{{ $saved->job->slug }}">{{ $saved->job->title }}</a>
                                            </h4>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $saved->job->company->name ?? 'Perusahaan' }} &bull; {{ $saved->job->city }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button wire:click="unsaveJob({{ $saved->id }})" class="px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-800 text-xs text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/20 font-bold transition flex items-center gap-1.5">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            <span>Hapus</span>
                                        </button>
                                        <a href="/jobs/{{ $saved->job->slug }}" class="px-4 py-2 bg-primary hover:bg-primary-hover text-white text-xs font-bold rounded-xl transition flex items-center gap-1">
                                            <span>Detail / Lamar</span>
                                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="text-center py-16 space-y-3">
                                <i data-lucide="bookmark" class="w-12 h-12 text-slate-400 mx-auto"></i>
                                <h4 class="font-bold text-slate-800 dark:text-slate-200">Belum Ada Lowongan Disimpan</h4>
                                <p class="text-xs text-slate-500 max-w-xs mx-auto font-medium">Jelajahi ribuan lowongan di MauLoker dan simpan pekerjaan yang menarik perhatian Anda.</p>
                                <a href="/jobs" class="px-5 py-2.5 bg-primary hover:bg-primary-hover text-white text-xs font-bold rounded-xl transition inline-block">
                                    Cari Lowongan Sekarang
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

            {{-- Tab: Messages --}}
            @if($activeTab === 'messages')
                <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                    <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Kotak Pesan</h2>
                        <p class="text-xs text-slate-400">Berkomunikasi langsung dengan perekrut dan perusahaan yang telah menghubungi Anda.</p>
                    </div>

                    <div class="flex flex-col items-center justify-center py-10 gap-5 text-center">
                        <div class="w-20 h-20 rounded-3xl bg-primary/10 text-primary flex items-center justify-center shadow-sm">
                            <i data-lucide="message-square" class="w-10 h-10"></i>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-bold text-slate-900 dark:text-white">Buka Halaman Chat Penuh</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 max-w-sm leading-relaxed">
                                Gunakan fitur chat real-time MauLoker untuk berkirim pesan langsung dengan perekrut atau perusahaan yang melamarkan pekerjaan kepada Anda.
                            </p>
                        </div>
                        @php $unread = \App\Models\Message::where('receiver_id', auth()->id())->whereNull('read_at')->count(); @endphp
                        @if($unread > 0)
                            <div class="px-4 py-2 rounded-xl bg-primary/10 border border-primary/20 text-xs font-bold text-primary">
                                <i data-lucide="bell" class="w-3.5 h-3.5 inline mr-1"></i>
                                Anda memiliki {{ $unread }} pesan belum dibaca
                            </div>
                        @endif
                        <a href="/messages" class="inline-flex items-center gap-2 px-8 py-3 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-2xl text-sm transition shadow-lg shadow-primary/20" wire:navigate>
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                            Buka Chat Sekarang
                        </a>
                    </div>
                </div>
            @endif

        </main>

    </div>

</div>
