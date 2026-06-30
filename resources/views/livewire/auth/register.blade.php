<div class="max-w-md mx-auto px-4 py-16 flex flex-col justify-center min-h-[70vh]">
    <div class="bg-white dark:bg-darkCard p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl space-y-6 relative overflow-hidden">
        <!-- Glow Effect -->
        <div class="absolute -right-10 -top-10 w-24 h-24 bg-primary/10 rounded-full blur-xl"></div>
        
        <div class="text-center space-y-2 relative z-10">
            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white font-black text-xl mx-auto shadow-md shadow-primary/20">
                M
            </div>
            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">Daftar Akun Baru</h2>
            <p class="text-xs text-slate-400">Bergabung dengan MauLoker untuk memulai karir atau merekrut talenta terbaik.</p>
        </div>

        <form wire:submit.prevent="register" class="space-y-4 relative z-10">
            
            <!-- Role Selection -->
            <div class="grid grid-cols-2 gap-4">
                <label class="cursor-pointer">
                    <input type="radio" wire:model="role" value="candidate" class="sr-only">
                    <div class="p-3 border-2 rounded-2xl text-center space-y-1 transition text-xs font-bold" :class="{'border-primary bg-primary/5 text-primary': $wire.role === 'candidate', 'border-slate-200 dark:border-slate-800 text-slate-400 hover:border-slate-300': $wire.role !== 'candidate'}">
                        <i data-lucide="user" class="w-5 h-5 mx-auto"></i>
                        <span>Pencari Kerja</span>
                    </div>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" wire:model="role" value="company" class="sr-only">
                    <div class="p-3 border-2 rounded-2xl text-center space-y-1 transition text-xs font-bold" :class="{'border-primary bg-primary/5 text-primary': $wire.role === 'company', 'border-slate-200 dark:border-slate-800 text-slate-400 hover:border-slate-300': $wire.role !== 'company'}">
                        <i data-lucide="building" class="w-5 h-5 mx-auto"></i>
                        <span>Perusahaan</span>
                    </div>
                </label>
            </div>
            @error('role') <span class="text-[10px] text-rose-500 block">{{ $message }}</span> @enderror

            <!-- Name -->
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nama Lengkap / Perusahaan</label>
                <div class="relative flex items-center">
                    <i data-lucide="user" class="w-4 h-4 text-slate-400 absolute left-3 shrink-0"></i>
                    <input type="text" wire:model="name" placeholder="Ahmad Rian / PT. Maju Jaya" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl pl-9 pr-4 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400">
                </div>
                @error('name') <span class="text-[10px] text-rose-500">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Alamat Email</label>
                <div class="relative flex items-center">
                    <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3 shrink-0"></i>
                    <input type="email" wire:model="email" placeholder="nama@email.com" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl pl-9 pr-4 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400">
                </div>
                @error('email') <span class="text-[10px] text-rose-500">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kata Sandi</label>
                <div class="relative flex items-center">
                    <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3 shrink-0"></i>
                    <input type="password" wire:model="password" placeholder="••••••••" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl pl-9 pr-4 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400">
                </div>
                @error('password') <span class="text-[10px] text-rose-500">{{ $message }}</span> @enderror
            </div>

            <!-- Password Confirmation -->
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Konfirmasi Kata Sandi</label>
                <div class="relative flex items-center">
                    <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3 shrink-0"></i>
                    <input type="password" wire:model="password_confirmation" placeholder="••••••••" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl pl-9 pr-4 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400">
                </div>
            </div>

            <button type="submit" class="w-full py-3 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-primary/20 flex items-center justify-center gap-1.5 mt-2">
                <span>Daftar Akun</span>
                <i data-lucide="user-plus" class="w-4 h-4"></i>
            </button>
        </form>

        <div class="text-center text-xs text-slate-500 relative z-10 pt-4 border-t border-slate-100 dark:border-slate-800">
            Sudah punya akun? <a href="/login" class="font-bold text-primary hover:underline">Masuk Akun</a>
        </div>
    </div>
</div>
