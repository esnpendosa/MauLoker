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
    <link rel="apple-touch-icon" href="https://img.icons8.com/color/192/000000/find-matching-job.png">

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
    <header class="sticky top-0 z-40 bg-white/80 dark:bg-darkBg/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="/" class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white font-black text-lg shadow-md shadow-primary/20">
                    M
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">
                    {{ $settings['website_name'] ?? 'MauLoker' }}
                </span>
            </a>

            <!-- Desktop Navigation Menu -->
            <nav class="hidden md:flex items-center gap-6">
                @foreach($navbarItems as $item)
                    <a href="{{ $item['url'] }}" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <!-- Right Controls: Mode Toggle & Auth -->
            <div class="flex items-center gap-4">
                <!-- Theme Toggle Button -->
                <button @click="toggleTheme()" class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition text-slate-500 dark:text-slate-400">
                    <template x-if="darkMode">
                        <i data-lucide="sun" class="w-5 h-5 text-amber-500"></i>
                    </template>
                    <template x-if="!darkMode">
                        <i data-lucide="moon" class="w-5 h-5 text-indigo-500"></i>
                    </template>
                </button>

                @auth
                    <!-- Authenticated Dropdown (Candidate / Company / Admin) -->
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
                                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Admin Panel
                                </a>
                            @elseif(auth()->user()->isCompany())
                                <a href="/company/dashboard" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                                </a>
                                <a href="/company/profile" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                    <i data-lucide="building" class="w-4 h-4"></i> Profil Perusahaan
                                </a>
                            @else
                                <a href="/candidate/dashboard" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
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
                    <a href="/login" class="text-sm font-semibold hover:text-primary transition">Masuk</a>
                    <a href="/register" class="bg-primary hover:bg-primary-hover text-white text-sm font-semibold px-4 py-2 rounded-xl transition shadow-lg shadow-primary/20">
                        Daftar
                    </a>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-7 h-7 rounded-lg bg-primary flex items-center justify-center text-white font-black text-md">
                        M
                    </div>
                    <span class="text-lg font-bold text-slate-900 dark:text-white">
                        {{ $settings['website_name'] ?? 'MauLoker' }}
                    </span>
                </div>
                <p class="text-sm text-slate-500 dark:text-slate-400 max-w-sm">
                    {{ $settings['website_name'] ?? 'MauLoker' }} adalah platform pencarian kerja Indonesia terdepan yang ringan, SEO friendly, mobile first, dan 100% gratis.
                </p>
                <div class="mt-4 flex items-center gap-3">
                    <a href="#" class="text-slate-400 hover:text-primary transition"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                    <a href="#" class="text-slate-400 hover:text-primary transition"><i data-lucide="instagram" class="w-5 h-5"></i></a>
                    <a href="#" class="text-slate-400 hover:text-primary transition"><i data-lucide="twitter" class="w-5 h-5"></i></a>
                    <a href="#" class="text-slate-400 hover:text-primary transition"><i data-lucide="linkedin" class="w-5 h-5"></i></a>
                </div>
            </div>
            
            <div>
                <h5 class="font-bold text-sm text-slate-900 dark:text-white mb-4 uppercase tracking-wider">Perusahaan</h5>
                <ul class="space-y-2 text-sm text-slate-500 dark:text-slate-400">
                    <li><a href="/jobs" class="hover:text-primary transition">Cari Pekerjaan</a></li>
                    <li><a href="/blog" class="hover:text-primary transition">Blog Karir</a></li>
                    <li><a href="/salary/insight" class="hover:text-primary transition">Riset Gaji</a></li>
                    <li><a href="/career/roadmap" class="hover:text-primary transition">Peta Karir</a></li>
                </ul>
            </div>

            <div>
                <h5 class="font-bold text-sm text-slate-900 dark:text-white mb-4 uppercase tracking-wider">Hubungi Kami</h5>
                <ul class="space-y-2 text-sm text-slate-500 dark:text-slate-400">
                    <li class="flex items-center gap-2">
                        <i data-lucide="phone" class="w-4 h-4 text-emerald-500"></i>
                        <span>{{ $settings['contact_whatsapp'] ?? '+6281234567890' }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="mail" class="w-4 h-4 text-emerald-500"></i>
                        <span>{{ $settings['contact_email'] ?? 'support@mauloker.com' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-slate-200 dark:border-slate-800 mt-8 pt-8 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} {{ $settings['website_name'] ?? 'MauLoker' }}. Dibuat dengan cinta untuk Indonesia.
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
