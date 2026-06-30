<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koneksi Terputus - MauLoker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #10B981;
        }
    </style>
</head>
<body class="bg-[#0B1220] text-slate-100 flex items-center justify-center min-h-screen px-4">
    <div class="max-w-md w-full text-center space-y-6 bg-[#111827] p-8 rounded-3xl border border-slate-800 shadow-2xl">
        <div class="w-16 h-16 rounded-full bg-emerald-500/10 text-emerald-500 flex items-center justify-center mx-auto">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-3.536 4.978 4.978 0 011.414-3.536m0 0L8.464 8.464M5.636 18.364a9 9 0 010-12.728m0 0l2.829 2.829M3 3l18 18"></path>
            </svg>
        </div>
        <div class="space-y-2">
            <h1 class="text-xl font-black">Koneksi Internet Terputus</h1>
            <p class="text-xs text-slate-400 leading-relaxed">
                MauLoker mendeteksi bahwa perangkat Anda tidak terhubung ke jaringan internet. Halaman ini ditampilkan secara offline.
            </p>
        </div>
        <button onclick="window.location.reload()" class="w-full py-3 bg-[#10B981] hover:bg-[#059669] text-white font-extrabold rounded-xl text-xs transition shadow-lg shadow-[#10B981]/25">
            Coba Muat Ulang
        </button>
    </div>
</body>
</html>
