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
            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">Lupa Kata Sandi?</h2>
            <p class="text-xs text-slate-400">Masukkan alamat email Anda untuk mendapatkan tautan atur ulang kata sandi.</p>
        </div>

        @if($messageSent)
            <div class="p-4 bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-400 rounded-2xl flex flex-col items-center text-center gap-3 relative z-10">
                <i data-lucide="check-circle" class="w-8 h-8 text-emerald-500 shrink-0"></i>
                <div class="space-y-1">
                    <span class="text-xs font-bold block">Email Terkirim!</span>
                    <span class="text-[10px] leading-relaxed block">Kami telah mengirimkan tautan atur ulang kata sandi ke email <strong>{{ $email }}</strong>. Silakan periksa kotak masuk atau spam email Anda.</span>
                </div>
            </div>
        @else
            <form wire:submit.prevent="sendResetLink" class="space-y-4 relative z-10">
                <!-- Email -->
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Alamat Email</label>
                    <div class="relative flex items-center">
                        <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3 shrink-0"></i>
                        <input type="email" wire:model="email" placeholder="nama@email.com" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl pl-9 pr-4 py-2.5 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400">
                    </div>
                    @error('email') <span class="text-[10px] text-rose-500">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full py-3 bg-primary hover:bg-primary-hover text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-primary/20 flex items-center justify-center gap-1.5 mt-2">
                    <span>Kirim Tautan Atur Ulang</span>
                    <i data-lucide="send" class="w-4 h-4"></i>
                </button>
            </form>
        @endif

        <div class="text-center text-xs text-slate-500 relative z-10 pt-4 border-t border-slate-100 dark:border-slate-800">
            Kembali ke <a href="/login" class="font-bold text-primary hover:underline">Halaman Masuk</a>
        </div>
    </div>
</div>
