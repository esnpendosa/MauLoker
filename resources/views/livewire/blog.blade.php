<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">

    @if($isDetail)
        <!-- Detail View -->
        <div class="max-w-3xl mx-auto space-y-8">
            <!-- Back Button -->
            <a href="/blog" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition" wire:navigate>
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Blog Karir
            </a>

            <!-- Header Info -->
            <div class="space-y-4">
                <span class="px-2.5 py-1 text-[10px] font-bold bg-primary/10 text-primary rounded-lg border border-primary/20 uppercase tracking-wide">
                    {{ $articleDetail['category_label'] }}
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white leading-tight">
                    {{ $articleDetail['title'] }}
                </h1>
                
                <!-- Author and Date -->
                <div class="flex items-center justify-between border-y border-slate-100 dark:border-slate-800 py-4 text-xs text-slate-500 dark:text-slate-400">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                            {{ substr($articleDetail['author'], 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-slate-700 dark:text-slate-300">{{ $articleDetail['author'] }}</p>
                            <p class="text-[10px] text-slate-400">{{ $articleDetail['author_role'] }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold">{{ $articleDetail['date'] }}</p>
                        <p class="text-[10px] text-slate-400">{{ $articleDetail['read_time'] }} baca • {{ $articleDetail['views'] }} dilihat</p>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="prose prose-slate dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 text-sm leading-relaxed space-y-4">
                {!! $articleDetail['content'] !!}
            </div>

            <!-- Tags -->
            @if(!empty($articleDetail['tags']))
                <div class="flex flex-wrap gap-2 pt-4 border-t border-slate-100 dark:border-slate-800">
                    @foreach($articleDetail['tags'] as $tag)
                        <span class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold rounded-xl">#{{ $tag }}</span>
                    @endforeach
                </div>
            @endif

            <!-- Related Articles -->
            @if(!empty($relatedArticles))
                <div class="space-y-6 pt-12 border-t border-slate-200 dark:border-slate-850">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Artikel Terkait</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        @foreach($relatedArticles as $rel)
                            <a href="/blog/{{ $rel['slug'] }}" class="bg-white dark:bg-darkCard p-5 border border-slate-200 dark:border-slate-800 rounded-2xl block hover:border-primary/20 transition group space-y-3" wire:navigate>
                                <span class="text-[9px] font-bold text-primary bg-primary/5 px-2 py-0.5 rounded border border-primary/10 uppercase">
                                    {{ $rel['category_label'] }}
                                </span>
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-primary transition line-clamp-2 leading-snug">
                                    {{ $rel['title'] }}
                                </h4>
                                <p class="text-[10px] text-slate-400">{{ $rel['date'] }} • {{ $rel['read_time'] }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @else
        <!-- List View -->
        <!-- Header Section -->
        <div class="text-center space-y-4">
            <span class="inline-flex items-center gap-2 text-xs font-bold tracking-widest text-primary uppercase">
                <i data-lucide="book-open" class="w-4 h-4"></i>
                BLOG KARIR MAULOKER
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">
                Tips & Wawasan untuk <span class="text-primary">Karir Terbaik</span> Anda
            </h1>
            <p class="text-slate-500 dark:text-slate-400 max-w-xl mx-auto text-sm">
                Panduan karir, tips interview, strategi CV, dan wawasan industri dari para pakar HR dan rekrutmen terpercaya Indonesia.
            </p>
        </div>

        <!-- Category Filter -->
        <div class="flex flex-wrap gap-2 justify-center">
            @foreach($categories as $key => $label)
                <button wire:click="$set('activeCategory', '{{ $key }}')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition {{ $activeCategory === $key ? 'bg-primary text-white shadow-lg shadow-primary/10' : 'bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-primary/10 dark:hover:bg-primary/20 hover:text-primary dark:hover:text-primary' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <!-- Search Bar -->
        <div class="max-w-lg mx-auto">
            <div class="relative">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                <input type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Cari artikel karir..."
                    class="w-full pl-11 pr-4 py-3 bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 text-slate-800 dark:text-slate-200 placeholder-slate-400">
            </div>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($articles as $article)
                <article class="bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg hover:border-primary/20 transition-all duration-300 group flex flex-col">
                    <!-- Article Card Color Header -->
                    <div class="h-3 bg-gradient-to-r {{ $article['featured'] ? 'from-primary to-emerald-500' : 'from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-800' }}"></div>

                    <div class="p-6 flex flex-col flex-grow space-y-4">
                        <!-- Category Badge -->
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-1 text-[10px] font-bold bg-primary/10 text-primary rounded-lg border border-primary/20 uppercase tracking-wide">
                                {{ $article['category_label'] }}
                            </span>
                            @if($article['featured'])
                                <span class="px-2.5 py-1 text-[10px] font-bold bg-amber-50 text-amber-600 rounded-lg border border-amber-100 uppercase tracking-wide flex items-center gap-1">
                                    <i data-lucide="star" class="w-3 h-3 fill-current"></i> Unggulan
                                </span>
                            @endif
                        </div>

                        <!-- Title -->
                        <h2 class="text-base font-extrabold text-slate-900 dark:text-white group-hover:text-primary transition line-clamp-2 leading-tight">
                            {{ $article['title'] }}
                        </h2>

                        <!-- Excerpt -->
                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-3 flex-grow">
                            {{ $article['excerpt'] }}
                        </p>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($article['tags'] as $tag)
                                <span class="px-2 py-0.5 text-[9px] font-bold bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 rounded-md">#{{ $tag }}</span>
                            @endforeach
                        </div>

                        <!-- Author & Meta -->
                        <div class="border-t border-slate-100 dark:border-slate-800 pt-4 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-primary/10 flex items-center justify-center text-primary text-[10px] font-extrabold">
                                    {{ substr($article['author'], 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-[10px] font-extrabold text-slate-700 dark:text-slate-300">{{ $article['author'] }}</p>
                                    <p class="text-[9px] text-slate-400">{{ $article['author_role'] }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[9px] text-slate-400">{{ $article['date'] }}</p>
                                <p class="text-[9px] text-slate-400">{{ $article['read_time'] }} baca</p>
                            </div>
                        </div>

                        <!-- Read More Button -->
                        <a href="/blog/{{ $article['slug'] }}" class="inline-flex items-center gap-1 text-xs font-extrabold text-primary hover:text-primary-hover transition group-hover:translate-x-1 duration-200" wire:navigate>
                            <span>Baca Selengkapnya</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12 space-y-3">
                    <i data-lucide="info" class="w-8 h-8 text-slate-400 mx-auto"></i>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Tidak ada artikel yang cocok dengan pencarian Anda.</p>
                </div>
            @endforelse
        </div>

        <!-- Newsletter Section -->
        <div class="bg-gradient-to-br from-primary to-emerald-600 rounded-3xl p-8 sm:p-12 text-white text-center space-y-6">
            <h2 class="text-2xl font-extrabold">Dapatkan Tips Karir Langsung di Kotak Masuk Anda</h2>
            <p class="text-white/80 text-sm max-w-md mx-auto">
                Bergabunglah dengan 50.000+ profesional Indonesia yang telah berlangganan newsletter MauLoker mingguan.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center max-w-md mx-auto">
                <input type="email" placeholder="Masukkan email Anda..."
                    class="flex-1 px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:border-white/50 text-sm">
                <button class="px-6 py-3 bg-white text-primary font-extrabold rounded-xl hover:bg-primary-hover/10 hover:text-primary transition text-sm">
                    Berlangganan
                </button>
            </div>
        </div>
    @endif

</div>
