<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    
    <!-- Top Admin Header -->
    <div class="bg-[#0B1220] text-white p-8 rounded-3xl border border-slate-800 shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-full blur-2xl"></div>

        <div class="flex items-center gap-4 relative z-10">
            <div class="w-12 h-12 rounded-2xl bg-primary flex items-center justify-center text-white font-black text-2xl shadow-lg">
                A
            </div>
            <div>
                <h1 class="text-xl sm:text-2xl font-black">Admin Panel Control</h1>
                <p class="text-xs text-slate-400">Sistem pengelolaan sistem MauLoker.</p>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex flex-wrap gap-2 relative z-10">
            @foreach(['users' => 'Pengguna', 'companies' => 'Perusahaan', 'jobs' => 'Lowongan', 'ads' => 'Iklan', 'themes' => 'Tema Warna', 'settings' => 'Pengaturan'] as $key => $label)
                <button wire:click="$set('activeTab', '{{ $key }}')" class="px-4 py-2.5 rounded-xl text-xs font-bold transition {{ $activeTab === $key ? 'bg-primary text-white' : 'bg-slate-900 hover:bg-slate-800 text-slate-400' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Alert Success -->
    @if (session()->has('success'))
        <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <!-- Main Content Area -->
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
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $cmp->verified ? 'bg-blue-100 text-blue-800' : 'bg-amber-100 text-amber-800' }}">
                                            {{ $cmp->verified ? 'Terverifikasi' : 'Tertunda' }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-right">
                                        <button wire:click="toggleCompanyVerification({{ $cmp->id }})" class="px-3 py-1.5 rounded-lg text-[10px] font-bold transition {{ $cmp->verified ? 'bg-amber-100 hover:bg-amber-200 text-amber-800' : 'bg-blue-100 hover:bg-blue-200 text-blue-850' }}">
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
