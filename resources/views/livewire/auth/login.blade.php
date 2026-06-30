<div class="max-w-md mx-auto px-4 py-16 flex flex-col justify-center min-h-[70vh]">
    <div class="bg-white dark:bg-darkCard p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl space-y-6 relative overflow-hidden">
        <!-- Glow Effect -->
        <div class="absolute -right-10 -top-10 w-24 h-24 bg-primary/10 rounded-full blur-xl"></div>
        
        <div class="text-center space-y-2 relative z-10">
            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white font-black text-xl mx-auto shadow-md shadow-primary/20">
                M
            </div>
            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">Selamat Datang Kembali</h2>
            <p class="text-xs text-slate-400">Masuk untuk mengelola profil, lamaran, atau lowongan Anda.</p>
        </div>

        <form wire:submit.prevent="login" class="space-y-4 relative z-10">
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
                <div class="flex items-center justify-between">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kata Sandi</label>
                    <a href="#" class="text-[10px] font-bold text-primary hover:underline">Lupa Sandi?</a>
                </div>
                <div class="relative flex items-center">
                    <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3 shrink-0"></i>
                    <input type="password" wire:model="password" placeholder="••••••••" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl pl-9 pr-4 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400">
                </div>
                @error('password') <span class="text-[10px] text-rose-500">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full py-3 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-primary/20 flex items-center justify-center gap-1.5 mt-2">
                <span>Masuk Akun</span>
                <i data-lucide="arrow-right-to-line" class="w-4 h-4"></i>
            </button>
        </form>

        <div class="text-center text-xs text-slate-500 relative z-10 pt-4 border-t border-slate-100 dark:border-slate-800">
            Belum punya akun? <a href="/register" class="font-bold text-primary hover:underline">Daftar Sekarang</a>
        </div>
    </div>
</div>
