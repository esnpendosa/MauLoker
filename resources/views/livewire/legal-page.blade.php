<div class="min-h-screen bg-slate-50/50 dark:bg-[#0B1220] py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Banner -->
        <div class="relative bg-gradient-to-br from-slate-900 via-primary-dark/20 to-slate-900 rounded-3xl p-8 md:p-12 shadow-2xl overflow-hidden mb-10 border border-primary/20">
            <!-- Background elements -->
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-primary/20 rounded-full blur-3xl"></div>
            <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <span class="px-3.5 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold border border-primary/20 uppercase tracking-widest">
                    Kebijakan & Ketentuan
                </span>
                
                @if($type === 'user-agreement')
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white mt-4 tracking-tight leading-tight">
                        Persetujuan Pengguna
                    </h1>
                    <p class="text-slate-300 mt-3 text-sm md:text-base max-w-2xl leading-relaxed">
                        Perjanjian penggunaan platform MauLoker. Bersifat 100% gratis dan mandiri untuk pelamar serta pemberi kerja.
                    </p>
                @elseif($type === 'privacy-policy')
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white mt-4 tracking-tight leading-tight">
                        Kebijakan Privasi
                    </h1>
                    <p class="text-slate-300 mt-3 text-sm md:text-base max-w-2xl leading-relaxed">
                        Bagaimana data pribadi Anda dikelola dan dilindungi secara rahasia di platform MauLoker.
                    </p>
                @elseif($type === 'terms-of-service')
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white mt-4 tracking-tight leading-tight">
                        Ketentuan Layanan Standar
                    </h1>
                    <p class="text-slate-300 mt-3 text-sm md:text-base max-w-2xl leading-relaxed">
                        Aturan penayangan loker, penolakan tanggung jawab hukum, dan jaminan layanan non-komersial.
                    </p>
                @endif
                
                <div class="flex items-center gap-2 mt-6 text-xs text-slate-400">
                    <span>Terakhir Diperbarui: 5 Juli 2026</span>
                    <span>•</span>
                    <span>Versi 1.1 (Community Edition - 100% Gratis)</span>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex flex-wrap gap-2 mb-8 bg-white dark:bg-[#111827] p-2 rounded-2xl border border-slate-200 dark:border-slate-800">
            <a href="/user-agreement" class="flex-1 min-w-[120px] text-center px-4 py-2.5 rounded-xl text-xs font-bold transition {{ $type === 'user-agreement' ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                User Agreement
            </a>
            <a href="/privacy-policy" class="flex-1 min-w-[120px] text-center px-4 py-2.5 rounded-xl text-xs font-bold transition {{ $type === 'privacy-policy' ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                Privacy Policy
            </a>
            <a href="/terms-of-service" class="flex-1 min-w-[120px] text-center px-4 py-2.5 rounded-xl text-xs font-bold transition {{ $type === 'terms-of-service' ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                Terms of Service
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white dark:bg-[#111827] rounded-3xl p-8 md:p-12 border border-slate-200 dark:border-slate-800 shadow-sm text-slate-700 dark:text-slate-300 leading-relaxed text-sm md:text-base space-y-8">
            
            @if($type === 'user-agreement')
                <!-- USER AGREEMENT CONTENT -->
                <section class="space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        1. Kedudukan Hukum Platform
                    </h2>
                    <p>
                        <strong>MauLoker</strong> (MauLoker.com) adalah platform digital penyedia informasi lowongan pekerjaan yang dikelola secara personal/komunitas. Platform ini <strong>bukan merupakan badan hukum usaha komersial (bukan CV, PT, firma, maupun agen penyalur tenaga kerja resmi/LPTKS)</strong>.
                    </p>
                    <p>
                        Layanan ini dibuat semata-mata sebagai sarana sosial interaktif gratis untuk membantu menghubungkan pencari kerja dengan pemberi kerja di Indonesia.
                    </p>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        2. Layanan 100% Gratis & Bebas Biaya
                    </h2>
                    <p>
                        Seluruh fitur utama di MauLoker dapat digunakan secara <strong>100% gratis tanpa biaya apapun</strong>:
                    </p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Kandidat tidak dipungut biaya untuk membuat profil, mengunggah resume, mengikuti tes kecocokan ATS, mengirimkan lamaran, maupun berkirim pesan.</li>
                        <li>Perusahaan/Pemberi kerja dibebaskan dari biaya pendaftaran profil perusahaan, penayangan iklan lowongan kerja, dan pemrosesan lamaran masuk.</li>
                        <li>Pengelola MauLoker tidak pernah memungut komisi dari gaji bulanan pelamar yang berhasil diterima bekerja.</li>
                    </ul>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        3. Tanggung Jawab Pengguna (Pencari Kerja & Perusahaan)
                    </h2>
                    <div class="p-4 bg-primary/10 border border-primary/20 rounded-2xl text-slate-800 dark:text-slate-200">
                        <strong>DISCLAIMER PERJANJIAN:</strong> Semua interaksi, komunikasi, penawaran kerja, wawancara, penandatanganan kontrak, dan perselisihan yang terjadi di luar maupun di dalam platform sepenuhnya merupakan <strong>tanggung jawab pribadi masing-masing pengguna (Pencari Kerja dan Perusahaan)</strong>.
                    </div>
                    <ul class="list-disc pl-6 space-y-2">
                        <li><strong>Bagi Pencari Kerja:</strong> Anda bertanggung jawab penuh atas keakuratan data resume, kualifikasi, portofolio, serta keputusan melamar kerja. Anda wajib melakukan kroscek mandiri terhadap validitas perusahaan sebelum menghadiri proses seleksi fisik.</li>
                        <li><strong>Bagi Perusahaan:</strong> Anda bertanggung jawab penuh atas keaslian lowongan kerja, perizinan perusahaan, dan penawaran kerja yang dipublikasikan. Anda wajib mematuhi regulasi ketenagakerjaan di Indonesia secara mandiri.</li>
                    </ul>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        4. Pembatasan Kewajiban Pengelola
                    </h2>
                    <p>
                        Mengingat platform ini dikelola secara personal/komunitas non-komersial:
                    </p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Pengelola tidak menjamin keberhasilan pelamar mendapatkan pekerjaan atau jaminan kualifikasi kandidat bagi pemberi kerja.</li>
                        <li>Pengelola tidak bertanggung jawab atas tindakan penipuan, pelanggaran kontrak, kerugian finansial, atau penyalahgunaan data yang dilakukan oleh salah satu pihak pengguna.</li>
                        <li>Pengelola dibebaskan dari segala bentuk tuntutan hukum, gugatan ganti rugi, atau denda perdata/pidana yang timbul dari transaksi kerja atau hubungan industrial antara Pencari Kerja dan Perusahaan.</li>
                    </ul>
                </section>

            @elseif($type === 'privacy-policy')
                <!-- PRIVACY POLICY CONTENT -->
                <section class="space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        1. Data yang Dikumpulkan secara Sukarela
                    </h2>
                    <p>
                        Untuk menggunakan fitur pencarian dan lamaran kerja di MauLoker, pengguna memberikan data pribadi secara sukarela yang meliputi:
                    </p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li><strong>Pencari Kerja:</strong> Nama lengkap, alamat email, nomor telepon/WhatsApp, daerah domisili, keahlian, riwayat pendidikan, riwayat pekerjaan, ekspektasi gaji, serta file resume/CV.</li>
                        <li><strong>Pemberi Kerja:</strong> Nama narahubung perekrut, nama perusahaan, deskripsi usaha, alamat kantor, alamat website, dan logo instansi.</li>
                    </ul>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        2. Mekanisme Pengiriman Data Lamaran
                    </h2>
                    <p>
                        Ketika Pencari Kerja menekan tombol <strong>"Lamar Sekarang"</strong> pada suatu lowongan:
                    </p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Seluruh data profil yang telah diisi beserta berkas CV Anda akan langsung diteruskan dan dapat diakses oleh akun Perusahaan pemasang lowongan tersebut.</li>
                        <li>Perusahaan penerima berkas berkewajiban menjaga kerahasiaan data lamaran tersebut dan dilarang menyebarluaskannya untuk kepentingan non-rekrutmen.</li>
                    </ul>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        3. Batasan Keamanan Data
                    </h2>
                    <p>
                        Kami menggunakan metode enkripsi hashing standar untuk melindungi sandi (password) akun Anda. Namun, karena dikelola secara mandiri tanpa dukungan infrastruktur korporasi besar, pengguna memahami bahwa:
                    </p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Pengguna disarankan untuk tidak mencantumkan informasi sensitif berlebih (seperti nomor KTP, nomor rekening bank, kartu keluarga, atau data pribadi non-rekrutmen lainnya) di dalam CV atau deskripsi profil publik.</li>
                        <li>Pengelola dibebaskan dari tanggung jawab hukum atas kebocoran data yang disebabkan oleh kelalaian pengguna (misalnya berbagi password) atau serangan siber ilegal dari pihak ketiga.</li>
                    </ul>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        4. Hak untuk Mengubah dan Menghapus Data
                    </h2>
                    <p>
                        Anda memiliki kendali penuh atas data Anda sendiri. Melalui Dashboard masing-masing, Anda berhak mengubah isi profil, memperbarui CV, atau menghapus akun Anda sewaktu-waktu secara mandiri.
                    </p>
                </section>

            @elseif($type === 'terms-of-service')
                <!-- TERMS OF SERVICE CONTENT -->
                <section class="space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        1. Aturan Penayangan Lowongan Kerja
                    </h2>
                    <p>
                        Setiap lowongan kerja yang ditayangkan di MauLoker wajib memenuhi standar kepatuhan berikut:
                    </p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Lowongan bersifat nyata (bukan fiktif/palsu) dan merupakan lowongan kerja halal/profesional.</li>
                        <li>Pemasang loker dilarang keras mempublikasikan pekerjaan ilegal seperti judi online, prostitusi, investasi bodong, tugas berbayar (task scamming), maupun skema MLM berantai yang merugikan.</li>
                        <li>Perekrut dilarang mencantumkan nomor telepon berbayar tarif premium untuk proses seleksi.</li>
                    </ul>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        2. Kebijakan Anti Pungutan Liar (Zero Cost)
                    </h2>
                    <div class="p-4 bg-rose-500/10 border border-rose-500/20 rounded-2xl text-rose-600 dark:text-rose-400">
                        <strong>ATURAN MUTLAK:</strong> MauLoker melarang keras segala bentuk pungutan biaya dari pelamar kerja oleh pihak perusahaan dengan dalih biaya psikotes, biaya diklat, pembelian seragam, biaya administrasi, tiket akomodasi, atau penahanan dokumen asli secara sepihak. Loker yang terindikasi melakukan hal ini akan segera dihapus permanen.
                    </div>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        3. Penafian Hubungan Kerja (No Agency/Employer Relationship)
                    </h2>
                    <p>
                        Pengguna sepakat dan memahami sepenuhnya bahwa:
                    </p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>MauLoker tidak bertindak sebagai agen penyalur tenaga kerja resmi, agen outsourcing, perwakilan hukum, atau penasihat rekrutmen Anda.</li>
                        <li>Tidak ada hubungan kemitraan hukum, keagenan, waralaba, atau hubungan kerja antara pengelola MauLoker dengan perusahaan pemberi kerja maupun pencari kerja terdaftar.</li>
                    </ul>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        4. Hak Penolakan dan Penghapusan Konten
                    </h2>
                    <p>
                        Pengelola berhak secara penuh untuk menolak permohonan pendaftaran akun, menghapus postingan lowongan kerja, atau memblokir akses pengguna secara sepihak jika dinilai melakukan pelanggaran kebijakan tanpa berkewajiban memberikan ganti rugi materiil dalam bentuk apapun.
                    </p>
                </section>
            @endif

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
