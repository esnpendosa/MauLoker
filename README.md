# MauLoker - Platform Pencarian Kerja Indonesia 🇮🇩

[![Framework](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-3.x-blue.svg)](https://livewire.laravel.com)
[![License](https://img.shields.io/badge/license-Non--Commercial-orange.svg)](LICENSE)

**MauLoker** adalah platform pencarian kerja Indonesia modern yang ringan, SEO friendly, mobile-first, dan dioptimalkan secara penuh untuk target *shared hosting* (seperti Hostinger Business Web Hosting) tanpa ketergantungan pada Node.js, Docker, Redis, atau VPS.

> **Tagline:** Temukan pekerjaan impianmu.

---

## 🚀 Fitur Lengkap Platform

### 1. 🏠 Halaman Utama (Homepage) yang Interaktif
* **Statistik Dinamis:** Menampilkan counter real-time (Lowongan Aktif, Perusahaan Terdaftar, Kandidat Terverifikasi, dan Lamaran Terproses).
* **Rekomendasi Lowongan (Featured Jobs):** Grid lowongan unggulan yang telah ditandai oleh administrator.
* **Riset Gaji (Salary Benchmarks):** Informasi rentang gaji rata-rata untuk berbagai kategori profesi (Software Engineer, Designer, Product Manager, Marketing, dll).
* **Peta Karir (Career Roadmap):** Panduan langkah demi langkah (Junior -> Middle -> Senior) untuk membimbing pencari kerja.
* **Kategori Lowongan Populer:** Pintasan pencarian berdasarkan industri (Teknologi, Finansial, Media, Konstruksi, dll).

### 2. 🔍 Sistem Pencarian Kerja yang Cepat & SEO Friendly
* **Filter Mutakhir:** Cari berdasarkan lokasi kota, kategori, pengalaman minimum, serta ekspektasi gaji minimum/maksimum.
* **Live Query Binding:** Pencarian dinamis menggunakan model binding Livewire 3 yang terintegrasi ke URL query string (memudahkan robot perayap Google mengindeks halaman pencarian).
* **Ad Integration:** Banner iklan Google AdSense terintegrasi di sidebar pencarian untuk memaksimalkan monetisasi.

### 3. 🎯 Match Score Engine & Pengiriman Lamaran (Job Detail)
* **Match Score Engine:** Menghitung persentase kecocokan kualifikasi lowongan dengan CV/Profil kandidat secara instan (berdasarkan kecocokan keterampilan, pendidikan, dan pengalaman kerja).
* **Modal Lamar Cepat:** Pelamar dapat mengunggah file CV berformat PDF langsung ke database lowongan.

### 4. 👤 Sistem Autentikasi Pengguna & Onboarding Multi-Peran
* **Registrasi & Login Terpadu:** Pengalihan antarmuka otomatis setelah login berdasarkan peran yang didefinisikan oleh Spatie Permissions:
  * **Candidate (Kandidat/Pencari Kerja)**
  * **Company (Perekrut/Perusahaan)**
  * **Admin (Pengelola Platform)**

### 5. 💼 Dashboard Kandidat (Candidate Control Center)
* **ATS Resume Checker:** Pengunggah CV PDF yang dilengkapi dengan parser teks otomatis (`Smalot PDFParser`) untuk menilai kecocokan CV dengan standar sistem ATS (*Applicant Tracking System*).
* **Ekspor CV ke PDF (DomPDF):** Unduh profil digital pelamar dalam bentuk dokumen PDF siap cetak dengan pilihan template profesional (Classic ATS & Modern Professional).
* **Tracker Lamaran (Application Stepper):** Lacak status lamaran kerja melalui indikator proses visual:
  * `Terkirim` ➡️ `Direview` ➡️ `Wawancara` ➡️ `Diterima` / `Ditolak`

### 6. 🏢 Dashboard Perusahaan (Recruiter Panel)
* **CRUD Lowongan:** Posting, edit, dan hapus lowongan kerja secara mandiri.
* **Applicant Pipeline Management:** Tinjau CV kandidat, jalankan kalkulator kecocokan nilai ATS, dan ubah status lamaran (misalnya mengundang interview atau menolak pelamar) secara instan.
* **Profil Perusahaan:** Manajemen logo, skala bisnis, kategori industri, dan peta lokasi.

### 7. 💬 Sistem Pesan Real-time (Chat Module)
* **AJAX Polling Chat:** Komunikasi dua arah antara pelamar dan perekrut tanpa membutuhkan server Socket eksternal atau Pusher (menggunakan polling Livewire 3 detik).
* **Interaktif Sidebar:** Daftar obrolan aktif dengan indikator unread message count dan cuplikan waktu pesan terakhir (*diffForHumans*).

### 8. 🛡️ Dashboard Administrator (Admin Panel)
* **Verifikasi Perusahaan:** Setujui atau batalkan verifikasi pendaftaran perusahaan baru sebelum mereka dapat memposting lowongan.
* **Manajemen Iklan:** Tempatkan banner custom HTML atau script iklan Google AdSense pada posisi header, sidebar, atau footer secara dinamis.
* **Dynamic Theme Editor:** Pengubah nilai variabel warna utama branding (`--primary`, `--primary-hover`, `--dark-bg`, dll) dan radius sudut element (`border-radius`) secara dinamis langsung dari database.

### 9. 📱 PWA & Kemandirian Offline
* **Instalasi PWA:** Dukungan penuh Manifest dan Service Worker sehingga website dapat diinstal di Android/iOS dan Desktop.
* **Offline Reliability:** Halaman fallback offline kustom yang ramah pengguna apabila koneksi internet terputus.

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

## 📄 Lisensi

Platform ini dirilis di bawah **Lisensi Non-Komersial MauLoker (MauLoker Non-Commercial License)**. Anda diperbolehkan menggunakan, mempelajari, dan memodifikasi proyek ini hanya untuk kepentingan pembelajaran, akademis, atau penggunaan pribadi secara **non-komersial**. 

Dilarang keras memperjualbelikan ulang software ini atau meng-host software ini sebagai layanan berbayar (SaaS/Sistem Informasi Komersial) tanpa izin tertulis dari pemegang hak cipta. Selengkapnya lihat berkas [LICENSE](LICENSE).
