<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    
    <!-- Dashboard Header -->
    <div class="bg-[#111827] text-white p-8 rounded-3xl border border-slate-800 shadow-xl relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6">
        <!-- Glow accent -->
        <div class="absolute top-0 right-0 w-48 h-48 bg-primary/10 rounded-full blur-[100px]"></div>

        <div class="flex items-center gap-5 relative z-10">
            @if($company->logo)
                <img src="{{ $company->logo }}" alt="{{ $company->name }}" class="w-16 h-16 rounded-2xl object-contain bg-white border border-slate-800">
            @else
                <div class="w-16 h-16 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold text-2xl shrink-0">
                    {{ substr($company->name, 0, 1) }}
                </div>
            @endif
            <div>
                <h1 class="text-xl sm:text-2xl font-black">{{ $company->name }}</h1>
                <p class="text-xs text-slate-400">Pemberi Kerja & bull; {{ $company->category ?: 'Bidang Industri Belum Diisi' }}</p>
                <div class="flex items-center gap-2 mt-2">
                    <span class="px-2 py-0.5 rounded bg-emerald-950/40 border border-emerald-800 text-[10px] text-emerald-400 font-bold">
                        Reputasi: {{ $company->reputation_score }} / 5.0
                    </span>
                    @if($company->verified)
                        <span class="px-2 py-0.5 rounded bg-blue-950/40 border border-blue-800 text-[10px] text-blue-400 font-bold uppercase tracking-wider">Terverifikasi</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-2 relative z-10">
            <button wire:click="$set('activeTab', 'dashboard')" class="px-5 py-2.5 rounded-xl text-xs font-bold transition {{ $activeTab === 'dashboard' ? 'bg-primary text-white' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                <i data-lucide="bar-chart-2" class="w-4 h-4 inline-block mr-1"></i> Ringkasan
            </button>
            <button wire:click="$set('activeTab', 'manage_jobs')" class="px-5 py-2.5 rounded-xl text-xs font-bold transition {{ $activeTab === 'manage_jobs' ? 'bg-primary text-white' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                <i data-lucide="briefcase" class="w-4 h-4 inline-block mr-1"></i> Lowongan Anda
            </button>
            <button wire:click="$set('activeTab', 'applicants')" class="px-5 py-2.5 rounded-xl text-xs font-bold transition {{ $activeTab === 'applicants' ? 'bg-primary text-white' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                <i data-lucide="users" class="w-4 h-4 inline-block mr-1"></i> Pelamar Masuk
            </button>
            <button wire:click="$set('activeTab', 'profile')" class="px-5 py-2.5 rounded-xl text-xs font-bold transition {{ $activeTab === 'profile' ? 'bg-primary text-white' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                <i data-lucide="building-2" class="w-4 h-4 inline-block mr-1"></i> Profil Perusahaan
            </button>
        </div>
    </div>

    <!-- Ad Placement -->
    @if($dashboardAd)
        <div class="w-full">
            {!! $dashboardAd->code_content !!}
        </div>
    @endif

    <!-- Main Content Area -->
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
                            <span class="text-2xl font-black text-indigo-500 mt-1 block">{{ $stats['total_applies'] }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/25 text-indigo-500 flex items-center justify-center">
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
                                        <button wire:click="openEditJob({{ $job->id }})" class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-slate-850 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition">
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
                                        {{ $applicant->candidate->name }}
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
                                        <select wire:change="changeStatus({{ $applicant->id }}, $event.target.value)" class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg px-2.5 py-1 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary cursor-pointer font-semibold">
                                            <option value="Applied" {{ $applicant->status === 'Applied' ? 'selected' : '' }}>Terkirim</option>
                                            <option value="Reviewed" {{ $applicant->status === 'Reviewed' ? 'selected' : '' }}>Ditinjau</option>
                                            <option value="Interview" {{ $applicant->status === 'Interview' ? 'selected' : '' }}>Wawancara</option>
                                            <option value="Accepted" {{ $applicant->status === 'Accepted' ? 'selected' : '' }}>Diterima</option>
                                            <option value="Rejected" {{ $applicant->status === 'Rejected' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </td>
                                </tr>
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
                            <select wire:model="category_id" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
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
