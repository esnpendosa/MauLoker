<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Sidebar Kiri (Gaya RightWork.inc) -->
        <aside class="lg:col-span-3 space-y-6">
            <!-- Brand Info Box -->
            <div class="bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm text-center">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center p-2.5 mb-3 shadow-inner">
                    <img src="/pwa-192.png" alt="MauLoker" class="w-10 h-10 object-contain">
                </div>
                <h2 class="text-base font-black text-slate-900 dark:text-white">Panel Admin</h2>
                <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold mt-1">Pusat Kendali Sistem</p>
            </div>

            <!-- Sidebar Navigation Menu -->
            <nav class="bg-white dark:bg-darkCard rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm p-4 space-y-1">
                @php
                    $adminMenu = [
                        'users' => ['label' => 'Daftar Pengguna', 'icon' => 'users'],
                        'companies' => ['label' => 'Verifikasi Perusahaan', 'icon' => 'building-2'],
                        'jobs' => ['label' => 'Kelola Lowongan', 'icon' => 'briefcase'],
                        'ads' => ['label' => 'Manajemen Iklan', 'icon' => 'layout-template'],
                        'themes' => ['label' => 'Tema Warna', 'icon' => 'palette'],
                        'settings' => ['label' => 'Pengaturan', 'icon' => 'settings'],
                    ];
                @endphp
                @foreach($adminMenu as $key => $labelItem)
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
                    <input type="text" placeholder="Cari data, lowongan, atau pengguna..." 
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
                    <span class="text-[10px] uppercase tracking-wider font-extrabold text-primary-hover">Selamat Datang di Sistem</span>
                    <h1 class="text-2xl sm:text-3xl font-black tracking-tight">Halo, Admin MauLoker !</h1>
                    <p class="text-xs text-slate-400 max-w-lg leading-relaxed pt-1">
                        Kelola data lowongan kerja, validasi pengajuan verifikasi perusahaan, pantau iklan, serta sesuaikan opsi preferensi tema warna portal dari satu dashboard.
                    </p>
                </div>
            </div>

            <!-- Alert Success -->
            @if (session()->has('success'))
                <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Main Content Area Inside Right Column -->
            <div class="bg-white dark:bg-darkCard p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm">
        
        <!-- Tab: Users -->
        @if($activeTab === 'users')
            <div class="space-y-4">
                <h3 class="font-extrabold text-slate-900 dark:text-white text-base">Daftar Pengguna Sistem</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-100 dark:border-slate-800 uppercase tracking-wider font-bold">
                                <th class="py-3 px-4">Nama Pengguna</th>
                                <th class="py-3 px-4">Alamat Email</th>
                                <th class="py-3 px-4">Peran (Role)</th>
                                <th class="py-3 px-4">Terdaftar Pada</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-850">
                            @foreach($users as $usr)
                                <tr>
                                    <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white">{{ $usr->name }}</td>
                                    <td class="py-3.5 px-4 text-slate-500">{{ $usr->email }}</td>
                                    <td class="py-3.5 px-4 font-bold text-primary uppercase">{{ $usr->role }}</td>
                                    <td class="py-3.5 px-4 text-slate-400">{{ $usr->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Tab: Companies -->
        @if($activeTab === 'companies')
            <div class="space-y-4">
                <h3 class="font-extrabold text-slate-900 dark:text-white text-base">Verifikasi Perusahaan</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-100 dark:border-slate-800 uppercase tracking-wider font-bold">
                                <th class="py-3 px-4">Nama Perusahaan</th>
                                <th class="py-3 px-4">Kategori Industri</th>
                                <th class="py-3 px-4">Kota</th>
                                <th class="py-3 px-4">Verifikasi</th>
                                <th class="py-3 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-850">
                            @foreach($companies as $cmp)
                                <tr>
                                    <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white">{{ $cmp->name }}</td>
                                    <td class="py-3.5 px-4 text-slate-500">{{ $cmp->category }}</td>
                                    <td class="py-3.5 px-4 text-slate-500 font-semibold">{{ $cmp->location }}</td>
                                    <td class="py-3.5 px-4">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $cmp->verified ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                            {{ $cmp->verified ? 'Terverifikasi' : 'Tertunda' }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-right">
                                        <button wire:click="toggleCompanyVerification({{ $cmp->id }})" class="px-3 py-1.5 rounded-lg text-[10px] font-bold transition {{ $cmp->verified ? 'bg-amber-100 hover:bg-amber-200 text-amber-800' : 'bg-emerald-100 hover:bg-emerald-200 text-emerald-800' }}">
                                            {{ $cmp->verified ? 'Batalkan Verifikasi' : 'Verifikasi' }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Tab: Jobs -->
        @if($activeTab === 'jobs')
            <div class="space-y-4">
                <h3 class="font-extrabold text-slate-900 dark:text-white text-base">Rekomendasi Lowongan</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-100 dark:border-slate-800 uppercase tracking-wider font-bold">
                                <th class="py-3 px-4">Judul Pekerjaan</th>
                                <th class="py-3 px-4">Perusahaan</th>
                                <th class="py-3 px-4">Penempatan</th>
                                <th class="py-3 px-4">Rekomendasi (Featured)</th>
                                <th class="py-3 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-850">
                            @foreach($jobs as $jb)
                                <tr>
                                    <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white">{{ $jb->title }}</td>
                                    <td class="py-3.5 px-4 text-slate-500 font-semibold">{{ $jb->company->name }}</td>
                                    <td class="py-3.5 px-4 text-slate-400">{{ $jb->city }}</td>
                                    <td class="py-3.5 px-4">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $jb->is_featured ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-500' }}">
                                            {{ $jb->is_featured ? 'Ya' : 'Tidak' }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-right">
                                        <button wire:click="toggleJobFeature({{ $jb->id }})" class="px-3 py-1.5 rounded-lg text-[10px] font-bold bg-primary/10 hover:bg-primary hover:text-white text-primary transition">
                                            {{ $jb->is_featured ? 'Batalkan Featured' : 'Pasang Featured' }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Tab: Ads -->
        @if($activeTab === 'ads')
            <div class="space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                    <h3 class="font-extrabold text-slate-900 dark:text-white text-base">Manajemen Iklan Banners & AdSense</h3>
                    <button wire:click="openCreateAd" class="px-4 py-2 bg-primary hover:bg-primary-hover text-white text-xs font-bold rounded-xl transition">
                        Pasang Iklan Baru
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-100 dark:border-slate-800 uppercase tracking-wider font-bold">
                                <th class="py-3 px-4">Nama Iklan</th>
                                <th class="py-3 px-4">Posisi Iklan</th>
                                <th class="py-3 px-4">Format</th>
                                <th class="py-3 px-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-850">
                            @foreach($ads as $ad)
                                <tr>
                                    <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white">{{ $ad->name }}</td>
                                    <td class="py-3.5 px-4 text-slate-500 font-semibold">{{ $ad->position_code }}</td>
                                    <td class="py-3.5 px-4 text-slate-400">{{ $ad->format_type }}</td>
                                    <td class="py-3.5 px-4">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $ad->status ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-500' }}">
                                            {{ $ad->status ? 'Aktif' : 'Non-aktif' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Tab: Theme Editor -->
        @if($activeTab === 'themes')
            <div class="space-y-6">
                <div>
                    <h3 class="font-extrabold text-slate-900 dark:text-white text-base">Editor Tema Warna & Radius</h3>
                    <p class="text-xs text-slate-400 mt-1">Mengubah warna utama branding, background dark/light mode secara dinamis dari database.</p>
                </div>

                <form wire:submit.prevent="saveTheme" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <!-- Primary Color -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Primary Color</label>
                            <div class="flex gap-2">
                                <input type="color" wire:model="primary_color" class="w-10 h-10 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer">
                                <input type="text" wire:model="primary_color" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs">
                            </div>
                        </div>

                        <!-- Primary Hover -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Primary Hover</label>
                            <div class="flex gap-2">
                                <input type="color" wire:model="primary_hover" class="w-10 h-10 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer">
                                <input type="text" wire:model="primary_hover" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs">
                            </div>
                        </div>

                        <!-- Primary Dark -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Primary Dark Mode</label>
                            <div class="flex gap-2">
                                <input type="color" wire:model="primary_dark" class="w-10 h-10 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer">
                                <input type="text" wire:model="primary_dark" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Dark BG -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Dark Mode Background</label>
                            <div class="flex gap-2">
                                <input type="color" wire:model="dark_bg" class="w-10 h-10 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer">
                                <input type="text" wire:model="dark_bg" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs">
                            </div>
                        </div>

                        <!-- Dark Card -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Dark Mode Card Content</label>
                            <div class="flex gap-2">
                                <input type="color" wire:model="dark_card" class="w-10 h-10 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer">
                                <input type="text" wire:model="dark_card" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs">
                            </div>
                        </div>
                    </div>

                    <!-- Border radius -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Border Radius Global (rem / px)</label>
                        <select wire:model="border_radius" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2.5 text-xs">
                            <option value="0rem">Tanpa Rounded (Siku-siku)</option>
                            <option value="0.25rem">Kecil (4px)</option>
                            <option value="0.5rem">Standard (8px)</option>
                            <option value="1.0rem">Besar (16px)</option>
                            <option value="1.5rem">Sangat Besar (24px)</option>
                        </select>
                    </div>

                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-primary/20">
                            Simpan Tema Aktif
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <!-- Tab: Settings -->
        @if($activeTab === 'settings')
            <div class="space-y-6">
                <div>
                    <h3 class="font-extrabold text-slate-900 dark:text-white text-base">Pengaturan Konten Website</h3>
                    <p class="text-xs text-slate-400 mt-1">Mengubah identitas nama platform MauLoker dan kontak representatif.</p>
                </div>

                <form wire:submit.prevent="saveSettings" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Site Name -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Nama Website</label>
                            <input type="text" wire:model="siteName" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs">
                        </div>

                        <!-- Site Tagline -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Tagline</label>
                            <input type="text" wire:model="siteTagline" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- WhatsApp -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Nomor WhatsApp Hubungi Kami</label>
                            <input type="text" wire:model="contactWhatsapp" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs">
                        </div>

                        <!-- Email -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Email Hubungi Kami</label>
                            <input type="email" wire:model="contactEmail" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-primary/20">
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        @endif

            </div>
        </main>
    </div>

    <!-- Ad creation modal -->
    @if($showAdModal)
        <div class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-slate-950/60 dark:bg-black/80 backdrop-blur-sm" wire:click="$set('showAdModal', false)"></div>

            <div class="relative bg-white dark:bg-darkCard w-full max-w-xl rounded-3xl border border-slate-200 dark:border-slate-800 shadow-2xl p-6 sm:p-8 space-y-6 z-10 transition">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="megaphone" class="text-primary w-5 h-5"></i>
                        Pasang Iklan Banner Baru
                    </h3>
                    <button wire:click="$set('showAdModal', false)" class="p-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-400">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <form wire:submit.prevent="saveAd" class="space-y-4">
                    <!-- Name -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Nama Iklan</label>
                        <input type="text" wire:model="adName" placeholder="e.g. AdSense Homepage Top" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs">
                    </div>

                    <!-- Position -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Posisi Penempatan</label>
                        <select wire:model="position_code" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs">
                            <option value="">Pilih Posisi</option>
                            @foreach($adPositions as $pos)
                                <option value="{{ $pos->code }}">{{ $pos->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Format -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Format Code</label>
                        <select wire:model="format_type" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs">
                            <option value="html">Custom HTML / Banner code</option>
                            <option value="google_adsense">Google AdSense</option>
                        </select>
                    </div>

                    <!-- Code content -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Script HTML / AdSense Iklan</label>
                        <textarea wire:model="code_content" rows="6" placeholder="Masukkan tag script, div, atau link banner..." class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs font-mono"></textarea>
                    </div>

                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end gap-3">
                        <button type="button" wire:click="$set('showAdModal', false)" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold rounded-xl text-xs transition">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-primary/20">
                            Simpan Iklan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
