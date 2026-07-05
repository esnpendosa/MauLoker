<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" wire:poll.3s>
    <div class="bg-white dark:bg-darkCard rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl overflow-hidden h-[75vh] flex">
        
        <!-- Sidebar Contacts -->
        <aside class="w-full md:w-80 border-r border-slate-200 dark:border-slate-800 flex flex-col shrink-0 {{ $activeUserId ? 'hidden md:flex' : 'flex' }}">
            <div class="p-5 border-b border-slate-200 dark:border-slate-800">
                <h2 class="font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                    <i data-lucide="message-square" class="text-primary w-5 h-5"></i>
                    Kotak Pesan
                </h2>
                <p class="text-[11px] text-slate-400 mt-0.5">Riwayat percakapan Anda</p>
            </div>

            <!-- Contacts list -->
            <div class="flex-grow overflow-y-auto divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($contacts as $contact)
                    <button wire:click="selectConversation({{ $contact->id }})" class="w-full p-4 flex items-start gap-3 hover:bg-slate-50 dark:hover:bg-slate-900/40 transition text-left focus:outline-none {{ $activeUserId == $contact->id ? 'bg-primary/5 dark:bg-primary/10 border-l-4 border-primary' : '' }}">
                        @if($contact->avatar)
                            <img src="{{ $contact->avatar }}" alt="{{ $contact->name }}" class="w-10 h-10 rounded-xl object-cover shrink-0">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold shrink-0">
                                {{ substr($contact->name, 0, 1) }}
                            </div>
                        @endif

                        <div class="space-y-1 w-full min-w-0">
                            <div class="flex items-center justify-between gap-1.5">
                                <h4 class="font-bold text-xs text-slate-900 dark:text-white truncate">{{ $contact->name }}</h4>
                                <span class="text-[9px] text-slate-400 shrink-0">{{ $contact->last_message_time }}</span>
                            </div>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">{{ $contact->last_message ?: 'Mulai percakapan...' }}</p>
                            @if($contact->unread_count > 0)
                                <div class="flex justify-end pt-0.5">
                                    <span class="px-1.5 py-0.5 rounded-full bg-primary text-white text-[9px] font-bold">{{ $contact->unread_count }} baru</span>
                                </div>
                            @endif
                        </div>
                    </button>
                @empty
                    <div class="text-center py-16 text-slate-400 p-6 space-y-3">
                        <i data-lucide="message-circle" class="w-12 h-12 mx-auto text-slate-200 dark:text-slate-700"></i>
                        <div>
                            <p class="text-sm font-bold text-slate-500 dark:text-slate-400">Belum ada percakapan</p>
                            <p class="text-xs text-slate-400 mt-1 leading-relaxed">Kunjungi detail lowongan dan klik <strong>"Tanya Perekrut"</strong> untuk memulai obrolan.</p>
                        </div>
                        <a href="/jobs" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-primary/10 text-primary text-xs font-bold hover:bg-primary/20 transition">
                            <i data-lucide="search" class="w-3.5 h-3.5"></i>
                            Cari Lowongan
                        </a>
                    </div>
                @endforelse
            </div>
        </aside>

        <!-- Chat Viewport -->
        <main class="flex-grow flex flex-col {{ !$activeUserId ? 'hidden md:flex justify-center items-center text-slate-400 bg-slate-50/50 dark:bg-slate-950/20' : 'flex' }}">
            @if($activeUserId && $activeUser)
                <!-- Chat Header -->
                <div class="p-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between bg-white dark:bg-darkCard">
                    <div class="flex items-center gap-3">
                        <!-- Mobile Back Arrow -->
                        <button wire:click="$set('activeUserId', null)" class="md:hidden p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-400">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        </button>

                        @if($activeUser->avatar)
                            <img src="{{ $activeUser->avatar }}" alt="{{ $activeUser->name }}" class="w-10 h-10 rounded-xl object-cover">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                                {{ substr($activeUser->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h3 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">{{ $activeUser->name }}</h3>
                            <span class="text-[9px] text-emerald-500 font-bold uppercase tracking-wider flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 inline-block"></span>
                                Aktif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Chat Messages Body -->
                <div class="flex-grow overflow-y-auto p-5 space-y-4 bg-slate-50/50 dark:bg-slate-950/10" 
                     id="chat-messages-container"
                     x-data
                     x-init="$el.scrollTop = $el.scrollHeight"
                     wire:updated="$nextTick(() => { $el.scrollTop = $el.scrollHeight })">
                    @forelse($messages as $msg)
                        <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[72%] space-y-1">
                                <div class="px-4 py-2.5 rounded-2xl text-xs leading-relaxed {{ $msg->sender_id === auth()->id() ? 'bg-primary text-white rounded-tr-none shadow-sm shadow-primary/20' : 'bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200 rounded-tl-none shadow-sm' }}">
                                    {{ $msg->message }}
                                </div>
                                <div class="flex items-center gap-1.5 {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                    <span class="text-[9px] text-slate-400">
                                        {{ $msg->created_at->format('H:i') }}
                                    </span>
                                    @if($msg->sender_id === auth()->id() && $msg->read_at)
                                        <i data-lucide="check-check" class="w-3 h-3 text-primary"></i>
                                    @elseif($msg->sender_id === auth()->id())
                                        <i data-lucide="check" class="w-3 h-3 text-slate-400"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center justify-center h-full py-16 text-center">
                            <div class="space-y-2">
                                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto">
                                    <i data-lucide="message-square" class="w-6 h-6"></i>
                                </div>
                                <p class="text-xs text-slate-500">Mulai percakapan dengan mengirim pesan pertama.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Chat Footer Input -->
                <div class="p-4 border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-darkCard">
                    <form wire:submit.prevent="sendMessage" class="flex gap-3 items-end">
                        <input type="text" wire:model="newMessageText" 
                               placeholder="Tulis pesan Anda..." 
                               class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400"
                               wire:keydown.enter.prevent="sendMessage">
                        <button type="submit" class="px-4 py-3 bg-primary hover:bg-primary-hover text-white rounded-xl transition shadow-md shadow-primary/10 shrink-0">
                            <i data-lucide="send-horizontal" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            @else
                <div class="text-center space-y-4 p-6">
                    <div class="w-20 h-20 rounded-3xl bg-primary/10 text-primary flex items-center justify-center mx-auto">
                        <i data-lucide="message-square" class="w-10 h-10"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">Pilih Percakapan</h4>
                        <p class="text-xs text-slate-400 max-w-xs mt-1">Pilih salah satu percakapan di kolom kiri, atau mulai obrolan baru dari halaman detail lowongan.</p>
                    </div>
                    <a href="/jobs" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary/10 text-primary rounded-xl text-xs font-bold hover:bg-primary/20 transition">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        Cari Lowongan & Tanya Perekrut
                    </a>
                </div>
            @endif
        </main>
    </div>
</div>

<script>
    document.addEventListener('livewire:updated', () => {
        const container = document.getElementById('chat-messages-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    });
</script>
