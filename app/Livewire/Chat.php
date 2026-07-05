<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public $activeUserId = null;
    public $newMessageText = '';

    public function mount()
    {
        $targetUserId = request()->query('user_id');
        if ($targetUserId && $targetUserId != Auth::id()) {
            $this->activeUserId = $targetUserId;
        }
    }

    public function selectConversation($userId)
    {
        $this->activeUserId = $userId;
        $this->markAsRead();
    }

    public function sendMessage()
    {
        $this->validate([
            'newMessageText' => 'required|max:1000'
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->activeUserId,
            'message' => $this->newMessageText,
        ]);

        $this->newMessageText = '';
        $this->dispatch('message-sent');
    }

    public function markAsRead()
    {
        if ($this->activeUserId) {
            Message::where('sender_id', $this->activeUserId)
                ->where('receiver_id', Auth::id())
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }
    }

    public function render()
    {
        $authId = Auth::id();

        // 1. Get recent contacts: anyone the user has sent messages to or received messages from
        $sentTo = Message::where('sender_id', $authId)->pluck('receiver_id')->toArray();
        $receivedFrom = Message::where('receiver_id', $authId)->pluck('sender_id')->toArray();
        $contactIds = array_unique(array_merge($sentTo, $receivedFrom));

        if ($this->activeUserId && !in_array($this->activeUserId, $contactIds)) {
            $targetUser = User::find($this->activeUserId);
            if ($targetUser) {
                $contactIds[] = $this->activeUserId;
            } else {
                $this->activeUserId = null;
            }
        }

        $contacts = User::whereIn('id', $contactIds)->get()->map(function($user) use ($authId) {
            // Count unread messages
            $user->unread_count = Message::where('sender_id', $user->id)
                ->where('receiver_id', $authId)
                ->whereNull('read_at')
                ->count();
            
            // Get last message
            $lastMsg = Message::where(function($q) use ($authId, $user) {
                $q->where('sender_id', $authId)->where('receiver_id', $user->id);
            })->orWhere(function($q) use ($authId, $user) {
                $q->where('sender_id', $user->id)->where('receiver_id', $authId);
            })->latest()->first();

            $user->last_message = $lastMsg ? $lastMsg->message : '';
            $user->last_message_time = $lastMsg ? $lastMsg->created_at->diffForHumans() : '';

            return $user;
        })->sortByDesc('last_message_time');

        // If no active conversation, default to the first contact if exists
        if (!$this->activeUserId && $contacts->isNotEmpty()) {
            $this->activeUserId = $contacts->first()->id;
        }

        // 2. Load active messages
        $messages = [];
        $activeUser = null;
        if ($this->activeUserId) {
            $activeUser = User::find($this->activeUserId);
            
            // Mark as read while rendering to keep counts accurate
            $this->markAsRead();

            $messages = Message::where(function($q) use ($authId) {
                $q->where('sender_id', $authId)->where('receiver_id', $this->activeUserId);
            })->orWhere(function($q) use ($authId) {
                $q->where('sender_id', $this->activeUserId)->where('receiver_id', $authId);
            })->orderBy('created_at', 'ASC')->get();
        }

        return view('livewire.chat', [
            'contacts' => $contacts,
            'messages' => $messages,
            'activeUser' => $activeUser
        ])->layout('components.layouts.app', [
            'seoTitle' => 'Pesan Masuk - MauLoker',
            'seoDescription' => 'Hubungi kandidat atau perekrut secara real-time via chat gratis MauLoker.'
        ]);
    }
}
