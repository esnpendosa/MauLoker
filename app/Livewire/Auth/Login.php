<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal berisi 6 karakter.',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();

            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->isCompany()) {
                return redirect()->intended('/company/dashboard');
            } else {
                return redirect()->intended('/candidate/dashboard');
            }
        }

        $this->addError('email', 'Kredensial yang Anda masukkan tidak cocok dengan data kami.');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.app', [
            'seoTitle' => 'Masuk Akun - MauLoker',
            'seoDescription' => 'Masuk ke portal MauLoker untuk melamar pekerjaan atau memasang lowongan kerja.'
        ]);
    }
}
