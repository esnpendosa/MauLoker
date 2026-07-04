@php
    $activeTheme = \App\Models\Theme::where('is_active', true)->first();
    $settings = \App\Models\Setting::pluck('value', 'key')->all();
    $navbarMenu = \App\Models\Menu::where('slug', 'navbar')->first();
    $navbarItems = $navbarMenu ? $navbarMenu->items_json : [];

    // Fallback theme colors
    $pColor = $activeTheme ? $activeTheme->primary_color : '#10B981';
    $pHover = $activeTheme ? $activeTheme->primary_hover : '#059669';
    $pDark = $activeTheme ? $activeTheme->primary_dark : '#047857';
    $lBg = $activeTheme ? $activeTheme->light_bg : '#FFFFFF';
    $lCard = $activeTheme ? $activeTheme->light_card : '#F8FAFC';
    $dBg = $activeTheme ? $activeTheme->dark_bg : '#0B1220';
    $dCard = $activeTheme ? $activeTheme->dark_card : '#111827';
    $tLight = $activeTheme ? $activeTheme->text_light : '#111827';
    $tDark = $activeTheme ? $activeTheme->text_dark : '#F9FAFB';
    $bRadius = $activeTheme ? $activeTheme->border_radius : '0.5rem';

    // SEO Meta Fallbacks
    $currentPath = '/' . ltrim(request()->path(), '/');
    $seoPage = \App\Models\SeoPage::where('path_pattern', $currentPath)->first();
    
    $metaTitle = $seoTitle ?? ($seoPage ? $seoPage->meta_title : ($settings['website_name'] ?? 'MauLoker') . ' - ' . ($settings['tagline'] ?? 'Temukan Pekerjaan Impianmu'));
    $metaDesc = $seoDescription ?? ($seoPage ? $seoPage->meta_description : 'Platform pencarian kerja Indonesia terdepan, ringan, cepat, dan mobile-first.');
    $ogImage = $seoImage ?? ($seoPage && $seoPage->og_image ? $seoPage->og_image : 'https://img.icons8.com/color/512/000000/find-matching-job.png');
    $canonicalUrl = $seoCanonical ?? ($seoPage && $seoPage->canonical ? $seoPage->canonical : url()->current());
    
    $schemaType = $schemaType ?? ($seoPage ? $seoPage->schema_type : 'WebSite');
    $schemaData = $schemaData ?? ($seoPage ? $seoPage->schema_data : []);
@endphp
<!DOCTYPE html>
<html lang="id" x-data="{ 
    darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
    toggleTheme() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
    }
}" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- PWA Settings -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="{{ $pColor }}">
    <link class="rounded-xl" rel="apple-touch-icon" href="/pwa-192.png">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <!-- Google AdSense Auto Ads Script -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3797177932095856"
         crossorigin="anonymous"></script>

    <!-- SEO Meta Tags -->
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDesc }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    
    <!-- OpenGraph Meta Tags -->
    <meta property="og:site_name" content="{{ $settings['website_name'] ?? 'MauLoker' }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDesc }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDesc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <!-- Schema.org Structured Data -->
    @if(!empty($schemaData))
        <script type="application/ld+json">
            {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>
    @else
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "WebSite",
            "name": "{{ $settings['website_name'] ?? 'MauLoker' }}",
            "url": "{{ url('/') }}",
            "potentialAction": {
                "@@type": "SearchAction",
                "target": "{{ url('/jobs') }}?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
        </script>
    @endif

    <!-- Dynamic DB Theme CSS Injection -->
    <style>
        :root {
            --primary: {{ $pColor }};
            --primary-hover: {{ $pHover }};
            --primary-dark: {{ $pDark }};
            --light-bg: {{ $lBg }};
            --light-card: {{ $lCard }};
            --dark-bg: {{ $dBg }};
            --dark-card: {{ $dCard }};
            --text-light: {{ $tLight }};
            --text-dark: {{ $tDark }};
            --border-radius: {{ $bRadius }};
        }
    </style>

    <!-- Preload Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif !important;
        }
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Tailwind compiled asset (Vite or Fallback CDN for quick dev if npm fails) -->
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                DEFAULT: '{{ $pColor }}',
                                hover: '{{ $pHover }}',
                                dark: '{{ $pDark }}',
                            },
                            lightBg: '{{ $lBg }}',
                            lightCard: '{{ $lCard }}',
                            darkBg: '{{ $dBg }}',
                            darkCard: '{{ $dCard }}',
                            textLight: '{{ $tLight }}',
                            textDark: '{{ $tDark }}',
                        },
                        borderRadius: {
                            custom: '{{ $bRadius }}',
                        }
                    }
                }
            }
        </script>
    @endif

    <!-- Lucide Icons for light weight icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @livewireStyles
</head>
<body class="bg-lightBg text-textLight dark:bg-darkBg dark:text-textDark min-h-screen flex flex-col transition-colors duration-200">

    <!-- Top Announcement Banner -->
    @php
        $announcement = \App\Models\Announcement::where('status', true)
            ->where(function($q) {
                if (auth()->check()) {
                    $q->where('target_roles', 'all')->orWhere('target_roles', auth()->user()->role);
                } else {
                    $q->where('target_roles', 'all');
                }
            })->latest()->first();
    @endphp
    @if($announcement)
        <div class="bg-primary text-white text-center py-2 px-4 text-xs font-semibold flex items-center justify-center gap-2">
            <i data-lucide="megaphone" class="w-4 h-4"></i>
            <span>{{ $announcement->title }}: {{ $announcement->content }}</span>
        </div>
    @endif

    <!-- Top Navigation Header -->
    <header x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-40 bg-white/80 dark:bg-darkBg/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- Brand Logo MauLoker -->
            <a href="/" class="flex items-center gap-2.5 group" wire:navigate>
                <img src="/pwa-192.png" alt="MauLoker" class="w-8 h-8 rounded-xl object-contain shadow-sm shadow-primary/10 transition group-hover:scale-105">
                <span class="text-2xl font-black tracking-tight text-slate-900 dark:text-white transition hover:opacity-90">
                    <span class="bg-gradient-to-r from-primary to-emerald-500 bg-clip-text text-transparent">mau</span>loker<span class="text-emerald-500 font-extrabold text-sm align-super">.com</span>
                </span>
            </a>

            <!-- Desktop Navigation Menu -->
            <nav class="hidden md:flex items-center gap-6">
                @foreach($navbarItems as $item)
                    <a href="{{ $item['url'] }}" class="relative text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition py-1.5 px-0.5">
                        {{ $item['label'] }}
                        @if(Str::contains(strtolower($item['label']), ['listing', 'lowongan', 'job']))
                            <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-1.5 py-0.5 text-[7px] font-black bg-rose-500 text-white rounded-md uppercase tracking-widest shadow-sm shadow-rose-500/20 animate-pulse">Trending</span>
                        @endif
                    </a>
                @endforeach
            </nav>

            <!-- Right Controls: Mode Toggle & Auth & Post Job -->
            <div class="flex items-center gap-4">
                <!-- Theme Toggle Button -->
                <button @click="toggleTheme()" class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition text-slate-500 dark:text-slate-400">
                    <span x-show="darkMode"><i data-lucide="sun" class="w-5 h-5 text-amber-500"></i></span>
                    <span x-show="!darkMode"><i data-lucide="moon" class="w-5 h-5 text-primary"></i></span>
                </button>

                <!-- Post a Job button (Guest/Company context) -->
                <div class="hidden lg:block">
                    @auth
                        @if(auth()->user()->isCompany())
                            <a href="/jobs/create" class="inline-flex items-center gap-2 bg-primary/10 text-primary hover:bg-primary hover:text-white px-5 py-2.5 rounded-xl font-bold text-sm transition">
                                <i data-lucide="plus" class="w-4 h-4"></i> Pasang Lowongan
                            </a>
                        @endif
                    @else
                        <a href="/login" class="inline-flex items-center gap-2 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800/50 px-5 py-2.5 rounded-xl font-bold text-sm transition">
                            Pasang Lowongan
                        </a>
                    @endauth
                </div>

                @auth
                    <!-- Authenticated Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="w-9 h-9 rounded-xl object-cover border border-primary/20">
                            @else
                                <div class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            @endif
                            <span class="hidden sm:inline text-sm font-semibold">{{ Str::limit(auth()->user()->name, 12) }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 rounded-2xl bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 shadow-xl py-2 z-50">
                            <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-800">
                                <p class="text-xs text-slate-400">Masuk sebagai</p>
                                <p class="text-xs font-bold text-primary uppercase">{{ auth()->user()->role }}</p>
                            </div>
                            
                            @if(auth()->user()->isAdmin())
                                <a href="/admin/dashboard" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Panel Admin
                                </a>
                            @elseif(auth()->user()->isCompany())
                                <a href="/company/dashboard" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dasbor
                                </a>
                                <a href="/company/profile" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                    <i data-lucide="building" class="w-4 h-4"></i> Profil Perusahaan
                                </a>
                            @else
                                <a href="/candidate/dashboard" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dasbor
                                </a>
                                <a href="/candidate/profile" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                    <i data-lucide="user" class="w-4 h-4"></i> Profil Saya
                                </a>
                            @endif

                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm hover:bg-rose-50 text-rose-600 dark:hover:bg-rose-950/20 transition text-left">
                                    <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Login & Register Links -->
                    <a href="/login" class="hidden md:inline-flex text-sm font-bold text-slate-600 dark:text-slate-300 hover:text-primary transition">Masuk</a>
                    <a href="/register" class="hidden md:inline-flex bg-primary hover:bg-primary-hover text-white text-sm font-bold px-5 py-2.5 rounded-xl transition shadow-lg shadow-primary/20">
                        Daftar
                    </a>
                @endauth

                <!-- Mobile Hamburger Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition text-slate-500 dark:text-slate-400 focus:outline-none animate-fade-in" aria-label="Toggle Menu">
                    <span x-show="!mobileMenuOpen">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </span>
                    <span x-show="mobileMenuOpen" x-cloak>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </span>
                </button>
            </div>
        </div>

        <!-- Mobile Dropdown Menu Drawer -->
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-transition x-cloak class="md:hidden border-t border-slate-100 dark:border-slate-800 bg-white dark:bg-darkCard px-4 py-4 space-y-3 shadow-xl">
            @foreach($navbarItems as $item)
                <a href="{{ $item['url'] }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-primary transition" @click="mobileMenuOpen = false">
                    {{ $item['label'] }}
                </a>
            @endforeach
            
            <!-- Mobile "Pasang Lowongan" button (only for Guests or Companies) -->
            @auth
                @if(auth()->user()->isCompany())
                    <a href="/jobs/create" class="flex items-center justify-center gap-2 bg-primary/10 text-primary hover:bg-primary hover:text-white px-4 py-3 rounded-xl font-bold text-sm transition" @click="mobileMenuOpen = false">
                        <i data-lucide="plus" class="w-4 h-4"></i> Pasang Lowongan
                    </a>
                @endif
            @else
                <a href="/login" class="flex items-center justify-center gap-2 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800/50 px-4 py-3 rounded-xl font-bold text-sm transition" @click="mobileMenuOpen = false">
                    Pasang Lowongan
                </a>
            @endauth

            <!-- Mobile Auth Actions -->
            <div class="pt-4 border-t border-slate-100 dark:border-slate-800 space-y-2.5">
                @auth
                    <!-- Profile Info & Dashboard Links -->
                    <div class="px-3 py-2 flex items-center gap-3">
                        @if(auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="w-10 h-10 rounded-xl object-cover border border-primary/20">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-primary uppercase font-bold tracking-wider">{{ auth()->user()->role }}</p>
                        </div>
                    </div>

                    @if(auth()->user()->isAdmin())
                        <a href="/admin/dashboard" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-base font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 transition" @click="mobileMenuOpen = false">
                            <i data-lucide="layout-dashboard" class="w-5 h-5 text-slate-400"></i> Panel Admin
                        </a>
                    @elseif(auth()->user()->isCompany())
                        <a href="/company/dashboard" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-base font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 transition" @click="mobileMenuOpen = false">
                            <i data-lucide="layout-dashboard" class="w-5 h-5 text-slate-400"></i> Dasbor
                        </a>
                        <a href="/company/profile" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-base font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 transition" @click="mobileMenuOpen = false">
                            <i data-lucide="building" class="w-5 h-5 text-slate-400"></i> Profil Perusahaan
                        </a>
                    @else
                        <a href="/candidate/dashboard" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-base font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 transition" @click="mobileMenuOpen = false">
                            <i data-lucide="layout-dashboard" class="w-5 h-5 text-slate-400"></i> Dasbor
                        </a>
                        <a href="/candidate/profile" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-base font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 transition" @click="mobileMenuOpen = false">
                            <i data-lucide="user" class="w-5 h-5 text-slate-400"></i> Profil Saya
                        </a>
                    @endif

                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-base font-semibold text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/20 transition text-left">
                            <i data-lucide="log-out" class="w-5 h-5"></i> Keluar
                        </button>
                    </form>
                @else
                    <!-- Login & Register buttons for mobile -->
                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <a href="/login" class="flex items-center justify-center border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 font-bold px-4 py-2.5 rounded-xl text-sm transition hover:bg-slate-50 dark:hover:bg-slate-800" @click="mobileMenuOpen = false">
                            Masuk
                        </a>
                        <a href="/register" class="flex items-center justify-center bg-primary hover:bg-primary-hover text-white font-bold px-4 py-2.5 rounded-xl text-sm transition shadow-lg shadow-primary/20" @click="mobileMenuOpen = false">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Page Footer -->
    <footer class="bg-slate-50 dark:bg-darkCard border-t border-slate-200 dark:border-slate-800 mt-16 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-8">
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <img src="/pwa-192.png" alt="MauLoker" class="w-6 h-6 rounded-lg object-contain">
                    <span class="text-xl font-black tracking-tight text-slate-900 dark:text-white">
                        <span class="bg-gradient-to-r from-primary to-emerald-500 bg-clip-text text-transparent">mau</span>loker<span class="text-emerald-500 font-extrabold text-xs align-super">.com</span>
                    </span>
                </div>
                <p class="text-sm text-slate-500 dark:text-slate-400 max-w-sm">
                    MauLoker adalah portal lowongan kerja profesional yang berkomitmen pada praktik rekrutmen yang legal dan etis. Menghubungkan pencari kerja dengan pemberi kerja tepercaya di seluruh Indonesia.
                </p>
                <div class="mt-4 flex items-center gap-3">
                    <a href="#" class="text-slate-400 hover:text-primary transition" aria-label="Facebook">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M9 8H7v3h2v9h3v-9h3l.5-3H12V6.5C12 5.67 12.5 5 13.5 5H15V2h-2.5C10.01 2 8 4.01 8 6.5V8z"/></svg>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-primary transition" aria-label="Instagram">
                        <svg class="w-5 h-5 stroke-current fill-none" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-primary transition" aria-label="Twitter">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-primary transition" aria-label="LinkedIn">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                </div>
            </div>
            
            <div>
                <h5 class="font-bold text-sm text-slate-900 dark:text-white mb-4 uppercase tracking-wider">Jelajahi</h5>
                <ul class="space-y-2 text-sm text-slate-500 dark:text-slate-400">
                    <li><a href="/jobs" class="hover:text-primary transition">Cari Lowongan</a></li>
                    <li><a href="/blog" class="hover:text-primary transition">Blog Karir</a></li>
                    <li><a href="/register" class="hover:text-primary transition">Daftar Gratis</a></li>
                </ul>
            </div>

            <div>
                <h5 class="font-bold text-sm text-slate-900 dark:text-white mb-4 uppercase tracking-wider">Ketentuan</h5>
                <ul class="space-y-2 text-sm text-slate-500 dark:text-slate-400">
                    <li><a href="/user-agreement" class="hover:text-primary transition">User Agreement</a></li>
                    <li><a href="/privacy-policy" class="hover:text-primary transition">Privacy Policy</a></li>
                    <li><a href="/terms-of-service" class="hover:text-primary transition">Terms of Service</a></li>
                    <li><a href="/disclaimer" class="hover:text-primary transition">Disclaimer</a></li>
                    <li><a href="/anti-fraud" class="hover:text-primary transition">Anti-Fraud Policy</a></li>
                    <li><a href="/community-guidelines" class="hover:text-primary transition">Community Guidelines</a></li>
                </ul>
            </div>

            <div>
                <h5 class="font-bold text-sm text-slate-900 dark:text-white mb-4 uppercase tracking-wider">Hubungi Kami</h5>
                <ul class="space-y-2 text-sm text-slate-500 dark:text-slate-400">
                    <li class="flex items-center gap-2">
                        <i data-lucide="phone" class="w-4 h-4 text-primary"></i>
                        <span>{{ $settings['contact_whatsapp'] ?? '+6285730302827' }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="mail" class="w-4 h-4 text-primary"></i>
                        <span>{{ $settings['contact_email'] ?? 'mauloker.comm@gmail.com' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-slate-200 dark:border-slate-800 mt-8 pt-8 text-center text-xs text-slate-500">
            <p class="text-[10px] text-slate-400 dark:text-slate-500 max-w-4xl mx-auto leading-relaxed">
                &copy; {{ date('Y') }} <strong>MauLoker</strong>. Platform komunitas lowongan kerja independen dan non-komersial. MauLoker bukan perusahaan penyalur tenaga kerja maupun agen rekrutmen resmi. Seluruh proses perekrutan, komunikasi, dan hubungan kerja sepenuhnya merupakan tanggung jawab pengguna masing-masing. Pengguna diwajibkan melakukan verifikasi mandiri terhadap setiap informasi lowongan kerja dan pihak perekrut sesuai peraturan perundang-undangan Republik Indonesia.
            </p>
        </div>
    </footer>

    @livewireScripts

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
        document.addEventListener('livewire:navigated', () => {
            lucide.createIcons();
        });
    </script>

    <!-- Register PWA Service Worker -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(reg => console.log('Service worker registered.', reg))
                    .catch(err => console.log('Service worker registration failed.', err));
            });
        }
    </script>
</body>
</html>
