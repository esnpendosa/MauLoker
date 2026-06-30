<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamu Sedang Offline - MauLoker</title>
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#10B981">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0B1220] text-[#F9FAFB] flex flex-col justify-center items-center min-h-screen px-4 font-sans">
    <div class="max-w-md w-full text-center p-8 bg-[#111827] border border-slate-800 rounded-2xl shadow-xl">
        <!-- SVG Connection Lost Icon -->
        <div class="mx-auto w-24 h-24 text-emerald-500 mb-6 flex items-center justify-center bg-emerald-950/30 rounded-full border border-emerald-500/20">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-3.536 5 5 0 011.414-3.536m0 0L11.3 11.3M4.93 19.07a8.96 8.96 0 01-1.566-5.706c0-2.485.99-4.73 2.586-6.364M9 12h.01M15 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-white mb-2">Koneksi Internet Terputus</h1>
        <p class="text-slate-400 text-sm mb-6 leading-relaxed">
            Sepertinya kamu sedang offline. Silakan periksa koneksi internet Wi-Fi atau jaringan seluler kamu dan coba muat ulang halaman ini.
        </p>

        <button onclick="window.location.reload();" class="w-full py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl transition shadow-lg shadow-emerald-500/20">
            Coba Lagi
        </button>

        <div class="mt-8 pt-6 border-t border-slate-800 text-xs text-slate-500">
            Kamu tetap dapat membuka halaman yang sudah pernah dikunjungi sebelumnya secara offline.
        </div>
    </div>
</body>
</html>
