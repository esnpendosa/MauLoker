<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = 'candidate'; // candidate, company

    public function register()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:candidate,company',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.min' => 'Nama lengkap minimal berisi 3 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email ini sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal berisi 6 karakter.',
            'role.required' => 'Peran akun wajib dipilih.',
            'role.in' => 'Peran akun tidak valid.',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        // Assign Spatie Role
        $spatieRole = Role::firstOrCreate(['name' => $this->role, 'guard_name' => 'web']);
        $user->assignRole($spatieRole);

        // If company, create Company profile
        if ($this->role === 'company') {
            Company::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'slug' => Str::slug($user->name) . '-' . rand(100, 999),
                'email' => $user->email,
                'status' => 'active',
                'reputation_score' => 4.0,
                'response_time' => 'Dalam beberapa hari',
                'scale' => '1-10 karyawan',
                'verified' => false
            ]);
        }

        Auth::login($user);

        session()->flash('success', 'Akun Anda berhasil didaftarkan!');

        if ($user->role === 'company') {
            return redirect()->to('/company/dashboard');
        } else {
            return redirect()->to('/candidate/dashboard');
        }
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('components.layouts.app', [
            'seoTitle' => 'Daftar Akun Baru - MauLoker',
            'seoDescription' => 'Buat akun pencari kerja atau perusahaan gratis di platform lowongan kerja MauLoker.'
        ]);
    }
}
