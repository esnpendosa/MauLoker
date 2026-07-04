<div class="max-w-md mx-auto px-4 py-16 flex flex-col justify-center min-h-[70vh]">
    <div class="bg-white dark:bg-darkCard p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl space-y-6 relative overflow-hidden">
        <!-- Glow Effect -->
        <div class="absolute -right-10 -top-10 w-24 h-24 bg-primary/10 rounded-full blur-xl"></div>
        
        <div class="text-center space-y-2 relative z-10">
            <div class="mb-4 flex flex-col items-center justify-center gap-2">
                <img src="/pwa-192.png" alt="MauLoker" class="w-12 h-12 rounded-2xl object-contain shadow-md shadow-primary/10">
                <span class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                    <span class="bg-gradient-to-r from-primary to-emerald-500 bg-clip-text text-transparent">mau</span>loker<span class="text-emerald-500 font-extrabold text-sm align-super">.com</span>
                </span>
            </div>
            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">Atur Ulang Kata Sandi</h2>
            <p class="text-xs text-slate-400">Silakan masukkan kata sandi baru Anda di bawah ini.</p>
        </div>

        <form wire:submit.prevent="resetPassword" class="space-y-4 relative z-10">
            <!-- Email (Readonly helper) -->
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Email Anda</label>
                <div class="relative flex items-center">
                    <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3 shrink-0"></i>
                    <input type="email" wire:model="email" readonly class="w-full bg-slate-100 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 rounded-xl pl-9 pr-4 py-2.5 text-xs text-slate-500 cursor-not-allowed">
                </div>
                @error('email') <span class="text-[10px] text-rose-500">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kata Sandi Baru</label>
                <div class="relative flex items-center" x-data="{ showPassword: false }">
                    <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3 shrink-0"></i>
                    <input :type="showPassword ? 'text' : 'password'" wire:model="password" placeholder="Minimal 6 karakter" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl pl-9 pr-10 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400">
                    <button type="button" @click="showPassword = !showPassword" class="absolute right-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 focus:outline-none">
                        <template x-if="!showPassword">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"/><circle cx="12" cy="12" r="3"/></svg>
                        </template>
                        <template x-if="showPassword">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" y1="2" x2="22" y2="22"/></svg>
                        </template>
                    </button>
                </div>
                @error('password') <span class="text-[10px] text-rose-500">{{ $message }}</span> @enderror
            </div>

            <!-- Password Confirmation -->
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Konfirmasi Kata Sandi Baru</label>
                <div class="relative flex items-center" x-data="{ showConfirmPassword: false }">
                    <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3 shrink-0"></i>
                    <input :type="showConfirmPassword ? 'text' : 'password'" wire:model="password_confirmation" placeholder="Ulangi kata sandi baru" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl pl-9 pr-10 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400">
                    <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute right-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 focus:outline-none">
                        <template x-if="!showConfirmPassword">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"/><circle cx="12" cy="12" r="3"/></svg>
                        </template>
                        <template x-if="showConfirmPassword">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" y1="2" x2="22" y2="22"/></svg>
                        </template>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full py-3 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-primary/20 flex items-center justify-center gap-1.5 mt-2">
                <span>Perbarui Kata Sandi</span>
                <i data-lucide="check" class="w-4 h-4"></i>
            </button>
        </form>

        <div class="text-center text-xs text-slate-500 relative z-10 pt-4 border-t border-slate-100 dark:border-slate-800">
            Kembali ke <a href="/login" class="font-bold text-primary hover:underline">Halaman Masuk</a>
        </div>
    </div>
</div>
