<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email = '';
    public $messageSent = false;

    public function sendResetLink()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.exists' => 'Alamat email tidak terdaftar di sistem kami.',
        ]);

        // Generate token
        $token = Str::random(64);

        // Store in DB
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $this->email],
            [
                'token' => bcrypt($token),
                'created_at' => now()
            ]
        );

        // Send Email
        $resetUrl = url('/reset-password/' . $token . '?email=' . urlencode($this->email));

        Mail::send([], [], function ($message) use ($resetUrl) {
            $message->to($this->email)
                ->subject('Atur Ulang Kata Sandi - MauLoker')
                ->html('
                    <div style="font-family: \'Instrument Sans\', sans-serif; max-width: 600px; margin: 0 auto; padding: 40px 20px; background-color: #f8fafc; border-radius: 24px;">
                        <div style="background-color: #ffffff; padding: 40px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                            <div style="margin-bottom: 24px;">
                                <span style="font-size: 24px; font-weight: 900; color: #4f46e5;">MauLoker</span>
                            </div>
                            <h2 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 12px;">Permintaan Atur Ulang Kata Sandi</h2>
                            <p style="font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 24px;">
                                Halo, Anda menerima email ini karena kami menerima permintaan untuk mengatur ulang kata sandi akun MauLoker Anda. Silakan klik tombol di bawah ini untuk melanjutkan:
                            </p>
                            <div style="text-align: center; margin-bottom: 32px;">
                                <a href="' . $resetUrl . '" style="display: inline-block; padding: 14px 32px; background-color: #4f46e5; color: #ffffff; text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 14px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);">
                                    Atur Ulang Kata Sandi
                                </a>
                            </div>
                            <p style="font-size: 12px; color: #64748b; line-height: 1.6; margin-bottom: 24px;">
                                Tautan atur ulang kata sandi ini akan kedaluwarsa dalam 60 menit. Jika Anda tidak merasa melakukan permintaan ini, abaikan saja email ini.
                            </p>
                            <div style="border-top: 1px solid #e2e8f0; padding-top: 24px; font-size: 11px; color: #94a3b8;">
                                Jika Anda kesulitan mengklik tombol di atas, salin dan tempel URL berikut ke peramban web Anda:<br>
                                <a href="' . $resetUrl . '" style="color: #4f46e5; word-break: break-all;">' . $resetUrl . '</a>
                            </div>
                        </div>
                    </div>
                ');
        });

        $this->messageSent = true;
    }

    public function render()
    {
        return view('livewire.auth.forgot-password')->layout('components.layouts.app', [
            'seoTitle' => 'Lupa Sandi - MauLoker',
            'seoDescription' => 'Pulihkan kata sandi akun MauLoker Anda dengan mudah.'
        ]);
    }
}
