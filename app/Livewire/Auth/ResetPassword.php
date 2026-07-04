<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function mount($token)
    {
        $this->token = $token;
        $this->email = request()->query('email', '');
    }

    public function resetPassword()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.exists' => 'Alamat email tidak terdaftar.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi minimal berisi 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        // Get reset record
        $record = DB::table('password_reset_tokens')->where('email', $this->email)->first();

        if (!$record || !Hash::check($this->token, $record->token)) {
            $this->addError('email', 'Tautan atur ulang kata sandi ini tidak valid atau telah kedaluwarsa.');
            return;
        }

        // Check if expired (e.g. 1 hour)
        $createdAt = \Carbon\Carbon::parse($record->created_at);
        if ($createdAt->addMinutes(60)->isPast()) {
            $this->addError('email', 'Tautan atur ulang kata sandi ini telah kedaluwarsa.');
            return;
        }

        // Update password
        $user = User::where('email', $this->email)->first();
        if ($user) {
            $user->password = Hash::make($this->password);
            $user->save();

            // Delete token
            DB::table('password_reset_tokens')->where('email', $this->email)->delete();

            session()->flash('success', 'Kata sandi Anda berhasil diperbarui! Silakan masuk dengan kata sandi baru Anda.');
            return redirect('/login');
        }

        $this->addError('email', 'Gagal memperbarui kata sandi. Silakan coba lagi.');
    }

    public function render()
    {
        return view('livewire.auth.reset-password')->layout('components.layouts.app', [
            'seoTitle' => 'Atur Ulang Sandi - MauLoker',
            'seoDescription' => 'Atur ulang kata sandi akun MauLoker Anda.'
        ]);
    }
}
