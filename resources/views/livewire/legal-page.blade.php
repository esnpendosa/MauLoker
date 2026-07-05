<div class="min-h-screen bg-slate-50/50 dark:bg-[#0B1220] py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb / Back Link -->
        <div class="mb-6">
            <a href="/" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition" wire:navigate>
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
                        Bagaimana data pribadi Anda dikelola, disimpan, dan dilindungi secara rahasia di platform MauLoker.
                    </p>
                @elseif($type === 'terms-of-service')
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Ketentuan Layanan Standar (Terms of Service)
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm md:text-base">
                        Aturan resmi mengenai hak, kewajiban, penayangan iklan lowongan, serta jaminan layanan bebas biaya.
                    </p>
                @elseif($type === 'disclaimer')
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Pernyataan Penyangkalan (Disclaimer)
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm md:text-base">
                        Pernyataan resmi mengenai batasan tanggung jawab hukum operasional platform komunitas MauLoker.
                    </p>
                @elseif($type === 'anti-fraud')
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Kebijakan Anti-Penipuan (Anti-Fraud Policy)
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm md:text-base">
                        Panduan perlindungan keamanan pengguna dan kebijakan tegas pencegahan penipuan di MauLoker.
                    </p>
                @elseif($type === 'community-guidelines')
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Panduan Komunitas (Community Guidelines)
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm md:text-base">
                        Panduan interaksi, etika, dan tata tertib penggunaan platform bagi pencari kerja serta perekrut.
                    </p>
                @endif
                
                <div class="flex flex-wrap items-center gap-3 mt-4 text-xs text-slate-400 dark:text-slate-500">
                    <span>Terakhir Diperbarui: 5 Juli 2026</span>
                    <span>•</span>
                    <span>Versi 1.4 (Community Edition - 100% Gratis)</span>
                    <span>•</span>
                    <span class="text-primary font-bold">Ketentuan Penggunaan Platform</span>
                </div>
            </div>

            <!-- Policy Body -->
            <div class="space-y-8">
                
                @if($type === 'user-agreement')
                    <!-- 1. USER AGREEMENT -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            1. Kedudukan Hukum Platform
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            <strong>MauLoker</strong> (MauLoker.com) adalah platform digital penyedia informasi lowongan pekerjaan yang dikelola secara personal/komunitas. Platform ini <strong>bukan merupakan badan hukum usaha komersial (bukan PT, CV, firma, maupun agen penyalur tenaga kerja resmi/LPTKS)</strong>, dan bukan merupakan perusahaan penyedia jasa pekerja/outsourcing.
                        </p>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Layanan ini disediakan secara mandiri sebagai media penghubung interaktif yang mempertemukan pencari kerja (kandidat) dan pemberi kerja (perekrut) di Indonesia.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            2. Layanan 100% Bebas Biaya
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Penggunaan fitur utama pada platform MauLoker bersifat sepenuhnya gratis:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed">Kandidat dapat mendaftar, mengunggah data resume, menggunakan analisis skor ATS, dan melamar lowongan tanpa pungutan biaya.</li>
                            <li class="leading-relaxed">Pemberi Kerja dibebaskan dari biaya registrasi profil perusahaan, pemasangan lowongan kerja, dan peninjauan berkas lamaran masuk.</li>
                            <li class="leading-relaxed">MauLoker tidak mengambil persentase komisi atau potongan dari upah/gaji pengguna yang diterima bekerja.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            3. Batasan Usia Pengguna
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Layanan MauLoker ditujukan hanya untuk individu yang berusia minimal <strong>18 tahun</strong> atau telah memenuhi kapasitas hukum penuh yang berlaku sesuai ketentuan hukum di Republik Indonesia untuk melakukan perikatan hukum secara mandiri.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            4. Pembatasan Tanggung Jawab &amp; Penafian
                        </h2>
                        <div class="p-4 bg-primary/10 border border-primary/20 rounded-2xl text-slate-800 dark:text-slate-200 text-sm leading-relaxed mb-4">
                            <strong>PENTING:</strong> Segala komunikasi, proses seleksi, kesepakatan, penandatanganan kontrak kerja, hingga perselisihan ketenagakerjaan merupakan <strong>tanggung jawab penuh masing-masing pihak pengguna</strong> secara langsung.
                        </div>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Pengelola tidak bertanggung jawab atas kerugian finansial, cidera janji, penipuan, atau pelanggaran hukum lainnya yang timbul akibat interaksi antar-pengguna, sepanjang tidak disebabkan oleh kesalahan atau kelalaian langsung pihak pengelola.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            5. Penangguhan &amp; Penghapusan Akun
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Pengelola MauLoker berhak melakukan moderasi secara wajar (best effort) dan berhak menangguhkan, membatasi, atau menghapus akun pengguna (Pencari Kerja maupun Perusahaan) secara sepihak jika ditemukan pelanggaran terhadap kesepakatan atau indikasi aktivitas ilegal, tanpa kewajiban memberikan ganti rugi dalam bentuk apapun.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            6. Hukum yang Berlaku
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Seluruh penggunaan platform MauLoker, hak, kewajiban, dan perselisihan yang timbul diatur sepenuhnya dan ditafsirkan berdasarkan hukum yang berlaku di Republik Indonesia.
                        </p>
                    </div>

                @elseif($type === 'privacy-policy')
                    <!-- 2. PRIVACY POLICY -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            1. Informasi yang Kami Kumpulkan
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Kami mengumpulkan informasi yang Anda berikan secara sukarela saat menggunakan platform MauLoker:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed"><strong>Pencari Kerja:</strong> Nama lengkap, alamat email, nomor kontak/WhatsApp, lokasi tinggal, keahlian, riwayat pendidikan/kerja, ekspektasi gaji, serta file dokumen resume/CV.</li>
                            <li class="leading-relaxed"><strong>Pemberi Kerja:</strong> Nama profil perusahaan, nama narahubung perekrut, deskripsi usaha, alamat kantor, alamat situs web, serta logo perusahaan.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            2. Penggunaan &amp; Penerusan Data Lamaran
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Data pribadi Pencari Kerja digunakan untuk keperluan pembuatan profil kerja di platform. Ketika Anda mengirim lamaran ke suatu lowongan, berkas CV dan informasi kontak Anda akan secara otomatis diteruskan kepada akun Perusahaan pemasang lowongan tersebut. Pemberi kerja dilarang keras menyebarluaskan data pelamar untuk tujuan apa pun selain proses evaluasi rekrutmen.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            3. Keamanan Data &amp; Batasannya
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Kami menerapkan enkripsi standar industri untuk melindungi kredensial masuk (sandi) Anda. Namun, pengelola tidak dapat menjamin keamanan absolut terhadap segala bentuk serangan siber ilegal dari pihak ketiga. Pengguna disarankan untuk tidak menyertakan informasi yang terlampau sensitif (seperti nomor KTP lengkap, data kartu keluarga, nomor rekening bank pribadi, atau dokumen sensitif non-pekerjaan lainnya) di dalam profil publik atau CV Anda.
                        </p>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Pengelola tidak bertanggung jawab atas kebocoran data yang disebabkan oleh kelalaian langsung dari pengguna (seperti membagikan kata sandi) atau aksi kriminal siber pihak ketiga di luar batas kendali wajar pengelola.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            4. Hak Penghapusan Data (Hak untuk Dilupakan)
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Pengguna memiliki hak penuh untuk mengubah data profil secara mandiri atau meminta penghapusan akun beserta seluruh berkas lamaran yang tersimpan secara permanen di database platform dengan menghubungi tim pengelola.
                        </p>
                    </div>

                @elseif($type === 'terms-of-service')
                    <!-- 3. TERMS OF SERVICE -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            1. Kewajiban &amp; Syarat Pemberi Kerja
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Perekrut yang memasang lowongan kerja di platform MauLoker wajib tunduk pada ketentuan berikut:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed">Lowongan harus nyata, valid, dan memiliki deskripsi kerja serta kualifikasi yang jelas sesuai hukum ketenagakerjaan Republik Indonesia.</li>
                            <li class="leading-relaxed">Dilarang mempublikasikan lowongan kerja yang diskriminatif terhadap kriteria Suku, Agama, Ras, dan Antargolongan (SARA), kecuali jika kriteria khusus tersebut diwajibkan secara objektif dan sah menurut peraturan hukum.</li>
                            <li class="leading-relaxed">Dilarang memasang iklan lowongan pekerjaan yang memungut biaya psikotes, biaya pelatihan, biaya seragam, biaya administrasi, penahanan berkas asli (ijazah/KTP), atau mewajibkan pembelian produk tertentu.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            2. Larangan Konten &amp; Aktivitas Ilegal
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            MauLoker melarang keras penayangan lowongan kerja atau pemanfaatan platform untuk:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed">Aktivitas perjudian online, taruhan, prostitusi, pornografi, perdagangan manusia, atau jasa ilegal lainnya.</li>
                            <li class="leading-relaxed">Skema Ponzi, Multi-Level Marketing (MLM) tanpa legalitas OJK/Kemendag, money game, investasi ilegal, atau pinjaman online (pinjol) ilegal.</li>
                            <li class="leading-relaxed">Kerja paruh waktu berbasis penipuan tugas berbayar (job scam task), pemerasan, atau eksploitasi kerja di bawah umur.</li>
                            <li class="leading-relaxed">Pengumpulan data pribadi pelamar untuk kepentingan penipuan finansial atau diperjualbelikan kepada pihak ketiga.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            3. Upaya Moderasi Wajar (Best Effort Moderation)
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            MauLoker berkomitmen melakukan moderasi konten secara berkala untuk meminimalisasi penayangan loker fiktif. Namun, pengguna memahami bahwa moderasi ini bersifat *best effort* (upaya wajar). MauLoker tidak dapat menjamin secara mutlak bahwa seluruh konten yang diunggah oleh pihak ketiga bebas sepenuhnya dari ketidakakuratan atau pelanggaran hukum. Pengguna disarankan untuk selalu berhati-hati dan melakukan verifikasi independen secara mandiri.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            4. Penangguhan Akses
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Apabila pengguna terbukti melanggar satu atau lebih poin Ketentuan Layanan ini, pengelola memiliki hak penuh untuk memblokir akun secara permanen, menghapus konten yang bersangkutan, dan apabila dinilai perlu, meneruskan bukti pelanggaran tersebut ke pihak berwajib demi keselamatan komunitas.
                        </p>
                    </div>

                @elseif($type === 'disclaimer')
                    <!-- 4. DISCLAIMER -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            1. Penafian Hubungan Ketenagakerjaan
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Layanan yang diberikan oleh MauLoker terbatas pada penyediaan infrastruktur teknologi informasi gratis sebagai sarana bertemunya pencari kerja dengan pemberi kerja secara mandiri. MauLoker bukan merupakan bagian dari, atau penjamin dari, hubungan hukum atau hubungan kerja yang terbentuk antara kandidat dengan pemberi kerja.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            2. Ketiadaan Jaminan Kualitas &amp; Keberhasilan
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            MauLoker disediakan atas dasar "sebagaimana adanya" (*as-is*) tanpa jaminan dalam bentuk apa pun, baik tersurat maupun tersirat. Kami tidak menjamin:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed">Bahwa pelamar pasti mendapatkan pekerjaan setelah mengirimkan lamaran di situs kami.</li>
                            <li class="leading-relaxed">Bahwa pemberi kerja akan mendapatkan kandidat dengan kualifikasi yang diinginkan atau keakuratan informasi profil yang diisi oleh pelamar.</li>
                            <li class="leading-relaxed">Bahwa layanan platform akan terbebas secara penuh dari gangguan teknis, virus, atau downtime sistem sementara.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            3. Kewajiban Verifikasi Mandiri Pengguna
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Pengguna memahami dan sepakat bahwa seluruh tindakan verifikasi terhadap keabsahan lowongan, alamat fisik kantor pemberi kerja, legalitas badan usaha, hak-hak ketenagakerjaan, serta rekam jejak perekrut sepenuhnya merupakan kewajiban dan tanggung jawab mandiri pengguna sebelum melanjutkan ke proses penandatanganan kontrak kerja atau kesepakatan apa pun.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            4. Pembatasan Tanggung Jawab Hukum
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Pengelola platform tidak bertanggung jawab atas kerugian finansial, reputasi, cidera janji, penipuan, perselisihan upah, atau pelanggaran undang-undang ketenagakerjaan yang dilakukan oleh salah satu pihak pengguna. Pengelola tidak bertanggung jawab atas kerugian yang timbul akibat tindakan, kelalaian, atau pelanggaran hukum yang dilakukan oleh pengguna, sepanjang tidak disebabkan oleh kesalahan atau kelalaian pengelola.
                        </p>
                    </div>

                @elseif($type === 'anti-fraud')
                    <!-- 5. ANTI-FRAUD POLICY -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            1. Komitmen Zero Cost Recruitment (Bebas Pungli)
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            MauLoker berkomitmen penuh melindungi pencari kerja dari praktik penipuan berkedok rekrutmen. Kebijakan kami sangat tegas terhadap segala indikasi pungutan liar:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed"><strong>Pencari kerja dilarang keras membayar sejumlah uang</strong> kepada perekrut dengan alasan biaya administrasi, biaya penggantian transportasi/akomodasi travel fiktif, pembelian modul diklat, seragam kerja, psikotes, atau jaminan masuk kerja.</li>
                            <li class="leading-relaxed"><strong>Perekrut dilarang keras menahan dokumen identitas asli</strong> milik pelamar seperti KTP, ijazah sekolah, atau kartu keluarga secara sepihak untuk membatasi ruang gerak pekerja.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            2. Ciri-Ciri Modus Penipuan yang Wajib Diwaspadai
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Harap waspada apabila menemui tanda-tanda berikut saat dihubungi oleh pihak pemberi kerja:
                        </p>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed">Undangan wawancara fisik bertempat di ruko kosong atau alamat yang tidak sesuai dengan profil resmi perusahaan di Google Maps.</li>
                            <li class="leading-relaxed">Perekrut memaksa pemesanan tiket perjalanan atau hotel melalui agen travel tertentu dengan janji sistem penggantian biaya (*reimbursement*) setelah tiba di lokasi.</li>
                            <li class="leading-relaxed">Tawaran kerja paruh waktu yang menjanjikan keuntungan instan dengan cara menyelesaikan tugas online (menyukai video, memesan barang fiktif) namun meminta pengguna melakukan deposit uang terlebih dahulu.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            3. Tindakan Terhadap Tindak Penipuan
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            MauLoker berhak menghapus iklan lowongan kerja, membekukan secara permanen akun perekrut yang melanggar kebijakan anti-penipuan ini, serta mendukung penuh aparat penegak hukum dengan memberikan data log aktivitas jika terjadi penipuan atau pemerasan berkedok rekrutmen.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            4. Mekanisme Pelaporan
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Jika Anda menemukan indikasi kecurangan, pungutan liar, atau loker fiktif di MauLoker, mohon segera kirimkan bukti percakapan atau dokumen pendukung melalui fitur pelaporan di platform atau dengan menghubungi layanan pengelola via saluran WhatsApp resmi yang tertera.
                        </p>
                    </div>

                @elseif($type === 'community-guidelines')
                    <!-- 6. COMMUNITY GUIDELINES -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            1. Visi Komunitas MauLoker
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            MauLoker didirikan sebagai ruang berbagi lowongan pekerjaan yang bersih, tepercaya, dan ramah bagi masyarakat Indonesia. Kami mengedepankan etika, kejujuran, dan rasa saling menghargai antara pemberi kerja dengan pencari kerja.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            2. Etika Pencari Kerja (Kandidat)
                        </h2>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed"><strong>Kejujuran Data:</strong> Isilah profil dan buatlah berkas resume/CV berdasarkan fakta yang sebenarnya tanpa memanipulasi riwayat pendidikan, keahlian, atau portofolio kerja.</li>
                            <li class="leading-relaxed"><strong>Sopan Santun Berkomunikasi:</strong> Gunakan bahasa yang sopan dan profesional saat berkirim pesan melalui platform atau saat menghubungi kontak perekrut.</li>
                            <li class="leading-relaxed"><strong>Komitmen Waktu:</strong> Menghadiri proses wawancara kerja yang telah dijadwalkan secara tepat waktu, atau memberikan pemberitahuan pembatalan secara sopan jauh-jauh hari jika berhalangan hadir.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            3. Etika Pemberi Kerja (Perekrut)
                        </h2>
                        <ul class="list-disc pl-6 space-y-2 text-slate-800 dark:text-slate-200">
                            <li class="leading-relaxed"><strong>Informasi Terbuka:</strong> Berikan deskripsi pekerjaan, jam kerja, sistem upah, dan lokasi penempatan secara jujur tanpa menutupi fakta penting.</li>
                            <li class="leading-relaxed"><strong>Penghormatan terhadap Pelamar:</strong> Lakukan komunikasi penyeleksian secara hormat, profesional, dan bebas dari intimidasi.</li>
                            <li class="leading-relaxed"><strong>Penghormatan terhadap Hak Privasi:</strong> Jaga kerahasiaan seluruh berkas lamaran yang masuk dan hanya gunakan informasi tersebut untuk kepentingan evaluasi kerja internal.</li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            4. Tindakan Tegas Pelanggaran Panduan
                        </h2>
                        <p class="text-slate-800 dark:text-slate-200 leading-relaxed">
                            Kami tidak menoleransi perilaku tidak etis seperti pelecehan verbal, penipuan identitas, spamming iklan loker, pelecehan seksual dalam proses seleksi, atau ujaran kebencian. Pelanggaran berat terhadap panduan komunitas ini akan langsung dikenai tindakan penutupan akun secara sepihak dan permanen oleh pengelola demi kenyamanan bersama.
                        </p>
                    </div>
                @endif
            </div>

            <!-- Contact Support Widget -->
            <div class="pt-8 border-t border-slate-200 dark:border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white">Ada pertanyaan mengenai kebijakan kami?</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Tim pengelola siap membantu menjawab pertanyaan seputar kebijakan gratis platform.</p>
                </div>
                <a href="https://wa.me/6285842895018" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary-hover text-white text-xs font-bold rounded-xl transition shadow-lg shadow-primary/20">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.968C16.635 1.97 14.167.947 11.547.947c-5.443 0-9.866 4.372-9.87 9.802 0 1.714.475 3.393 1.374 4.908l-.997 3.639 3.754-.972.193.112z"/></svg>
                    Hubungi via WhatsApp
                </a>
            </div>
            
        </div>
    </div>
</div>
