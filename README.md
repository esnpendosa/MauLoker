# MauLoker - Platform Pencarian Kerja Indonesia 🇮🇩

[![Framework](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-3.x-blue.svg)](https://livewire.laravel.com)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

**MauLoker** adalah platform pencarian kerja Indonesia modern yang ringan, SEO friendly, mobile-first, dan dioptimalkan secara penuh untuk target *shared hosting* (seperti Hostinger Business Web Hosting) tanpa ketergantungan pada Node.js, Docker, Redis, atau VPS.

> **Tagline:** Temukan pekerjaan impianmu.

---

## 🚀 Fitur Utama

1. **Pencarian Lowongan Canggih (Job Search):**
   * Filter pencarian dinamis (lokasi, rentang gaji, pengalaman, dan kategori industri).
   * URL SEO friendly dengan query strings yang terindeks robot perayap mesin pencari.
2. **Sistem Onboarding & Autentikasi Peran:**
   * Registrasi dan Login dinamis menggunakan Spatie Permissions (Candidate vs Company).
3. **Dashboard Pelamar (Candidate Dashboard):**
   * Unggah CV PDF dan parser ATS otomatis menggunakan `Smalot PDFParser` & `MatchEngineService`.
   * Unduh CV ke PDF menggunakan `Barryvdh DomPDF`.
   * Pelacak lamaran kerja dengan penanda proses (*stepper*).
4. **Dashboard Perusahaan (Company Dashboard):**
   * Kelola lowongan (CRUD), kelola pelamar, dan ubah status lamaran secara real-time.
5. **Real-time Chat (AJAX Polling):**
   * Komunikasi langsung antara pelamar dan perusahaan menggunakan AJAX Polling Livewire 3 (tanpa WebSockets/Pusher).
6. **Panel Administrator (Admin Panel):**
   * Kelola pengguna, verifikasi perusahaan, rekomendasikan lowongan, dan buat spot iklan.
   * **Dynamic Theme Customizer:** Ubah skema warna global (primary, hover, dark mode bg) langsung dari database.
7. **PWA & Offline Reliability:**
   * Instalasi instan di handphone/desktop dengan Service Worker (`sw.js`) dan halaman fallback offline statis.

---

## 🛠️ Tech Stack

* **Core Framework:** Laravel 12 (PHP 8.3+)
* **Frontend:** Livewire 3, AlpineJS, TailwindCSS (CDN / Vite fallback)
* **Icons:** Lucide Icons
* **Database:** MySQL / MariaDB
* **PDF Engine:** Barryvdh DomPDF & Smalot PDFParser

---

## 📥 Panduan Instalasi Lokal

1. **Clone repositori:**
   ```bash
   git clone https://github.com/esnpendosa/MauLoker.git
   cd MauLoker
   ```

2. **Install dependensi Composer:**
   ```bash
   composer install
   ```

3. **Salin berkas konfigurasi env:**
   ```bash
   copy .env.example .env
   ```

4. **Konfigurasi Database:**
   Buat database kosong bernama `mauloker` di PhpMyAdmin/MySQL, lalu sesuaikan `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mauloker
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan Migrasi & Database Seeder:**
   ```bash
   php artisan migrate --seed
   ```

6. **Tautkan Storage:**
   ```bash
   php artisan storage:link
   ```

7. **Jalankan Aplikasi:**
   ```bash
   php artisan serve
   ```
   Aplikasi akan berjalan pada [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## 👥 Kontributor & Kolaborasi

### Apakah platform ini memerlukan kontributor?
**Tentu saja!** Membuka ruang bagi kontributor (kontribusi open-source) sangat baik untuk mempercepat pengembangan fitur-fitur baru (seperti integrasi WhatsApp Gateway, Payment Gateway untuk lowongan premium, dll.). 

Jika Anda tertarik untuk berpartisipasi:
1. Fork repositori ini.
2. Buat branch baru (`feature/fitur-baru`).
3. Kirim Pull Request (PR) untuk direview.

---

## 📄 Lisensi

Platform ini dirilis di bawah lisensi [MIT License](LICENSE). Anda bebas menyalin, memodifikasi, dan menyebarluaskannya secara gratis.
