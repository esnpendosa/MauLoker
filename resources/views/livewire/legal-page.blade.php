<div class="min-h-screen bg-slate-50/50 dark:bg-[#0B1220] py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb / Back Link -->
        <div class="mb-6">
            <a href="/" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke Beranda
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white dark:bg-[#111827] rounded-3xl p-8 md:p-12 border border-slate-200 dark:border-slate-800 shadow-sm space-y-8">
            
            <!-- Document Header -->
            <div class="border-b border-slate-200 dark:border-slate-800 pb-8">
                @if($type === 'user-agreement')
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Persetujuan Pengguna (User Agreement)
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm md:text-base">
                        Perjanjian penggunaan platform MauLoker. Bersifat 100% gratis dan mandiri untuk pelamar serta pemberi kerja.
                    </p>
                @elseif($type === 'privacy-policy')
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Kebijakan Privasi (Privacy Policy)
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm md:text-base">
                        Bagaimana data pribadi Anda dikelola dan dilindungi secara rahasia di platform MauLoker.
                    </p>
                @elseif($type === 'terms-of-service')
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Ketentuan Layanan Standar (Terms of Service)
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm md:text-base">
                        Aturan penayangan loker, penolakan tanggung jawab hukum, dan jaminan layanan non-komersial.
                    </p>
                @endif
                
                <div class="flex flex-wrap items-center gap-3 mt-4 text-xs text-slate-400 dark:text-slate-500">
                    <span>Terakhir Diperbarui: 5 Juli 2026</span>
                    <span>•</span>
                    <span>Versi 1.3 (Community Edition - 100% Gratis)</span>
                    <span>•</span>
                    <span class="text-primary font-bold">Ketentuan Penggunaan Platform</span>
                </div>
            </div>

            <!-- Policy Body -->
            <div class="space-y-8">
                @if($type === 'user-agreement')
                    <!-- USER AGREEMENT CONTENT -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            1. Kedudukan Hukum Platform
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            <strong>MauLoker</strong> (MauLoker.com) adalah platform digital penyedia informasi lowongan pekerjaan yang dikelola secara personal/komunitas. Platform ini <strong>bukan merupakan badan hukum usaha komersial (bukan CV, PT, firma, maupun agen penyalur tenaga kerja resmi/LPTKS)</strong>.
                        </p>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Layanan ini dibuat semata-mata sebagai sarana sosial interaktif gratis untuk membantu menghubungkan pencari kerja dengan pemberi kerja di Indonesia secara mandiri.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            2. Layanan 100% Gratis & Bebas Biaya
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Seluruh fitur utama di MauLoker dapat digunakan secara <strong>100% gratis tanpa biaya apapun</strong>:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed">Kandidat tidak dipungut biaya untuk membuat profil, mengunggah resume, mengikuti tes kecocokan ATS, mengirimkan lamaran, maupun berkirim pesan.</li>
                            <li class="leading-relaxed">Perusahaan/Pemberi kerja dibebaskan dari biaya pendaftaran profil perusahaan, penayangan iklan lowongan kerja, dan pemrosesan lamaran masuk.</li>
                            <li class="leading-relaxed">Pengelola MauLoker tidak pernah memungut komisi dari gaji bulanan pelamar yang berhasil diterima bekerja.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            3. Tanggung Jawab Pengguna (Pencari Kerja & Perusahaan)
                        </h2>
                        <div class="p-4 bg-primary/10 border border-primary/20 rounded-2xl text-slate-800 dark:text-slate-200 text-sm leading-relaxed mb-4">
                            <strong>PERNYATAAN TEGAS:</strong> Semua interaksi, komunikasi, penawaran kerja, wawancara, penandatanganan kontrak, dan perselisihan yang terjadi di luar maupun di dalam platform sepenuhnya merupakan <strong>tanggung jawab pribadi masing-masing pengguna (Pencari Kerja dan Perusahaan) secara mandiri</strong>.
                        </div>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed"><strong>Bagi Pencari Kerja:</strong> Anda bertanggung jawab penuh atas keakuratan data resume, kualifikasi, portofolio, serta keputusan melamar kerja. Anda wajib melakukan kroscek mandiri terhadap validitas perusahaan sebelum menghadiri proses seleksi fisik.</li>
                            <li class="leading-relaxed"><strong>Bagi Perusahaan:</strong> Anda bertanggung jawab penuh atas keaslian lowongan kerja, perizinan perusahaan, dan penawaran kerja yang dipublikasikan. Anda wajib mematuhi regulasi ketenagakerjaan di Indonesia secara mandiri.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            4. Batasan Tanggung Jawab Pengelola
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Mengingat platform ini dikelola secara personal/komunitas non-komersial:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed">Pengelola tidak menjamin keberhasilan pelamar mendapatkan pekerjaan atau jaminan kualifikasi kandidat bagi pemberi kerja.</li>
                            <li class="leading-relaxed">Pengelola tidak bertanggung jawab atas tindakan penipuan, pelanggaran kontrak, kerugian finansial, atau penyalahgunaan data yang dilakukan oleh salah satu pihak pengguna.</li>
                            <li class="leading-relaxed">Pengelola tidak bertanggung jawab atas kerugian yang timbul akibat tindakan, kelalaian, atau pelanggaran hukum yang dilakukan oleh pengguna, sepanjang tidak disebabkan oleh kesalahan atau kelalaian pengelola.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            5. Ketentuan Penggunaan & Moderasi
                        </h2>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed"><strong>Batasan Usia:</strong> Pengguna wajib berusia minimal 18 tahun atau telah memenuhi ketentuan hukum yang berlaku untuk menggunakan layanan ini.</li>
                            <li class="leading-relaxed"><strong>Best Effort Moderation:</strong> MauLoker melakukan upaya wajar (best effort) untuk melakukan moderasi konten dan pelaporan pengguna, namun tidak dapat menjamin bahwa seluruh informasi yang dipublikasikan pengguna bebas dari kesalahan, penipuan, atau pelanggaran hukum.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            6. Hukum yang Berlaku
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Seluruh penggunaan layanan MauLoker tunduk pada hukum yang berlaku di Republik Indonesia.
                        </p>
                    </div>

                @elseif($type === 'privacy-policy')
                    <!-- PRIVACY POLICY CONTENT -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            1. Data yang Dikumpulkan secara Sukarela
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Untuk menggunakan fitur pencarian dan lamaran kerja di MauLoker, pengguna memberikan data pribadi secara sukarela yang meliputi:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed"><strong>Pencari Kerja:</strong> Nama lengkap, alamat email, nomor telepon/WhatsApp, daerah domisili, keahlian, riwayat pendidikan, riwayat pekerjaan, ekspektasi gaji, serta file resume/CV.</li>
                            <li class="leading-relaxed"><strong>Pemberi Kerja:</strong> Nama narahubung perekrut, nama perusahaan, deskripsi usaha, alamat kantor, alamat website, dan logo instansi.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            2. Mekanisme Pengiriman Data Lamaran
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Ketika Pencari Kerja menekan tombol <strong>"Lamar Sekarang"</strong> pada suatu lowongan:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed">Seluruh data profil yang telah diisi beserta berkas CV Anda akan langsung diteruskan dan dapat diakses oleh akun Perusahaan pemasang lowongan tersebut.</li>
                            <li class="leading-relaxed">Perusahaan penerima berkas berkewajiban menjaga kerahasiaan data lamaran tersebut dan dilarang menyebarluaskannya untuk kepentingan non-rekrutmen.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            3. Batasan Keamanan Data
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Kami menggunakan metode enkripsi hashing standar untuk melindungi sandi (password) akun Anda. Namun, karena dikelola secara mandiri tanpa dukungan infrastruktur korporasi besar, pengguna memahami bahwa:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed">Pengguna disarankan untuk tidak mencantumkan informasi sensitif berlebih (seperti nomor KTP, nomor rekening bank, kartu keluarga, atau data pribadi non-rekrutmen lainnya) di dalam CV atau deskripsi profil publik.</li>
                            <li class="leading-relaxed">Pengelola tidak bertanggung jawab atas kerugian atau kebocoran data yang disebabkan oleh kelalaian pengguna (misalnya membagikan kata sandi) atau tindakan ilegal pihak ketiga di luar kendali wajar pengelola.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            4. Hak untuk Mengubah dan Menghapus Data
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Anda memiliki kendali penuh atas data Anda sendiri. Melalui Dashboard masing-masing, Anda berhak mengubah isi profil, memperbarui CV, atau menghapus akun Anda sewaktu-waktu secara mandiri.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            5. Ketentuan Lain
                        </h2>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed"><strong>Batasan Usia:</strong> Platform ini hanya ditujukan bagi pengguna yang telah berusia minimal 18 tahun atau memiliki kecakapan hukum penuh sesuai ketentuan di Indonesia.</li>
                            <li class="leading-relaxed"><strong>Hukum yang Berlaku:</strong> Kebijakan privasi ini ditafsirkan dan tunduk pada ketentuan hukum Republik Indonesia.</li>
                        </ul>
                    </div>

                @elseif($type === 'terms-of-service')
                    <!-- TERMS OF SERVICE CONTENT -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            1. Aturan Penayangan Lowongan Kerja
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Setiap lowongan kerja yang ditayangkan di MauLoker wajib memenuhi standar kepatuhan berikut:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed">Lowongan bersifat nyata (bukan fiktif/palsu) dan merupakan lowongan kerja yang berkomitmen pada praktik rekrutmen yang legal dan etis.</li>
                            <li class="leading-relaxed">Pemasang loker dilarang keras mempublikasikan pekerjaan ilegal seperti judi online, prostitusi, investasi bodong, tugas berbayar (task scamming), maupun skema MLM berantai yang merugikan.</li>
                            <li class="leading-relaxed">Perekrut dilarang mencantumkan nomor telepon berbayar tarif premium untuk proses seleksi.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            2. Kebijakan Anti Pungutan Liar (Zero Cost)
                        </h2>
                        <div class="p-4 bg-rose-500/10 border border-rose-500/20 rounded-2xl text-rose-600 dark:text-rose-400 text-sm leading-relaxed mb-4">
                            <strong>ATURAN MUTLAK:</strong> MauLoker melarang keras segala bentuk pungutan biaya dari pelamar kerja oleh pihak perusahaan dengan dalih biaya psikotes, biaya diklat, pembelian seragam, biaya administrasi, tiket akomodasi, atau penahanan dokumen asli secara sepihak. Loker yang terindikasi melakukan hal ini akan segera dihapus permanen.
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            3. Penafian Hubungan Kerja (No Agency/Employer Relationship)
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Pengguna sepakat dan memahami sepenuhnya bahwa:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed">MauLoker tidak bertindak sebagai agen penyalur tenaga kerja resmi, agen outsourcing, perwakilan hukum, atau penasihat rekrutmen Anda.</li>
                            <li class="leading-relaxed">Tidak ada hubungan kemitraan hukum, keagenan, waralaba, atau hubungan kerja antara pengelola MauLoker dengan perusahaan pemberi kerja maupun pencari kerja terdaftar.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            4. Hak Penolakan dan Penghapusan Konten
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Pengelola berhak secara penuh untuk menolak pendaftaran akun, menghapus postingan lowongan kerja, atau memblokir akses pengguna secara sepihak jika dinilai melakukan pelanggaran kebijakan. Pengelola tidak bertanggung jawab atas kerugian yang timbul akibat tindakan, kelalaian, atau pelanggaran hukum yang dilakukan oleh pengguna, sepanjang tidak disebabkan oleh kesalahan atau kelalaian pengelola.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            5. Ketentuan Tambahan & Hukum
                        </h2>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed"><strong>Batasan Usia:</strong> Layanan ini ditujukan untuk pengguna berusia minimal 18 tahun atau yang memiliki kecakapan hukum penuh secara sah.</li>
                            <li class="leading-relaxed"><strong>Upaya Moderasi (Best Effort):</strong> MauLoker mengupayakan moderasi berkala untuk menyaring konten fiktif, namun tidak menjamin mutlak kebebasan platform dari konten ilegal yang dimasukkan oleh pihak ketiga.</li>
                            <li class="leading-relaxed"><strong>Hukum yang Berlaku:</strong> Layanan ini diatur dan ditafsirkan sesuai hukum yang berlaku di Republik Indonesia.</li>
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Contact Support Widget -->
            <div class="pt-8 border-t border-slate-200 dark:border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white">Ada pertanyaan mengenai kebijakan kami?</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Tim pengelola siap membantu menjawab pertanyaan seputar kebijakan gratis platform.</p>
                </div>
                <a href="https://wa.me/6285730302827" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary-hover text-white text-xs font-bold rounded-xl transition shadow-lg shadow-primary/20">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.968C16.635 1.97 14.167.947 11.547.947c-5.443 0-9.866 4.372-9.87 9.802 0 1.714.475 3.393 1.374 4.908l-.997 3.639 3.754-.972.193.112z"/></svg>
                    Hubungi via WhatsApp
                </a>
            </div>
            
        </div>
    </div>
</div>
