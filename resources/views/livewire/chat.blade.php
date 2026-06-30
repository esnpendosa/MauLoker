<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" wire:poll.3s>
    <div class="bg-white dark:bg-darkCard rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl overflow-hidden h-[75vh] flex">
        
        <!-- Sidebar Contacts -->
        <aside class="w-full md:w-80 border-r border-slate-200 dark:border-slate-800 flex flex-col shrink-0 {{ $activeUserId ? 'hidden md:flex' : 'flex' }}">
            <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                <h2 class="font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                    <i data-lucide="message-square" class="text-primary w-5 h-5"></i>
                    Pesan Masuk
                </h2>
            </div>

            <!-- Contacts list -->
            <div class="flex-grow overflow-y-auto divide-y divide-slate-100 dark:divide-slate-850">
                @forelse($contacts as $contact)
                    <button wire:click="selectConversation({{ $contact->id }})" class="w-full p-4 flex items-start gap-3 hover:bg-slate-50 dark:hover:bg-slate-900/40 transition text-left focus:outline-none {{ $activeUserId === $contact->id ? 'bg-primary/5 dark:bg-primary/5 border-l-4 border-primary' : '' }}">
                        @if($contact->avatar)
                            <img src="{{ $contact->avatar }}" alt="{{ $contact->name }}" class="w-10 h-10 rounded-xl object-cover">
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
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">{{ $contact->last_message }}</p>
                            @if($contact->unread_count > 0)
                                <div class="flex justify-end pt-1">
                                    <span class="px-1.5 py-0.5 rounded-full bg-primary text-white text-[8px] font-bold">{{ $contact->unread_count }} Baru</span>
                                </div>
                            @endif
                        </div>
                    </button>
                @empty
                    <div class="text-center py-16 text-slate-400 p-6 space-y-2">
                        <i data-lucide="message-circle" class="w-10 h-10 mx-auto text-slate-300"></i>
                        <p class="text-xs">Belum ada obrolan aktif.</p>
                    </div>
                @endforelse
            </div>
        </aside>

        <!-- Chat Viewport -->
        <main class="flex-grow flex flex-col {{ !$activeUserId ? 'hidden md:flex justify-center items-center text-slate-400 bg-slate-50/50 dark:bg-slate-950/20' : 'flex' }}">
            @if($activeUserId && $activeUser)
                <!-- Chat Header -->
                <div class="p-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <!-- Mobile Back Arrow -->
                        <button wire:click="$set('activeUserId', null)" class="md:hidden p-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-400">
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
                            <span class="text-[9px] text-emerald-500 font-bold uppercase tracking-wider">Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Chat Messages Body -->
                <div class="flex-grow overflow-y-auto p-6 space-y-4 bg-slate-50/50 dark:bg-slate-950/10" id="chat-messages-container">
                    @foreach($messages as $msg)
                        <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[70%] space-y-1">
                                <div class="px-4 py-2.5 rounded-2xl text-xs {{ $msg->sender_id === auth()->id() ? 'bg-primary text-white rounded-tr-none' : 'bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200 rounded-tl-none' }}">
                                    {{ $msg->message }}
                                </div>
                                <span class="text-[9px] text-slate-400 block {{ $msg->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                                    {{ $msg->created_at->format('H:i') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Chat Footer Input -->
                <div class="p-4 border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-darkCard">
                    <form wire:submit.prevent="sendMessage" class="flex gap-3">
                        <input type="text" wire:model="newMessageText" placeholder="Tulis pesan Anda..." class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-400">
                        <button type="submit" class="px-5 py-3 bg-primary hover:bg-primary-hover text-white rounded-xl transition shadow-md shadow-primary/10">
                            <i data-lucide="send-horizontal" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            @else
                <div class="text-center space-y-3">
                    <div class="w-16 h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto">
                        <i data-lucide="message-square" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">Pilih Percakapan</h4>
                        <p class="text-xs text-slate-400 max-w-xs">Silakan pilih salah satu percakapan di kolom kiri untuk mulai berkirim pesan.</p>
                    </div>
                </div>
            @endif
        </main>
    </div>
</div>
