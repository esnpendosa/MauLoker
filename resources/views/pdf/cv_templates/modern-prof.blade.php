<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resume - {{ $name }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10.5pt;
            color: #1F2937;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .container {
            width: 100%;
        }
        .sidebar {
            width: 30%;
            float: left;
            background-color: #F8FAFC;
            border-right: 1px solid #E2E8F0;
            padding: 25px 15px;
            min-height: 800px;
        }
        .main-content {
            width: 63%;
            float: right;
            padding: 25px 15px;
        }
        .name {
            font-size: 20pt;
            font-weight: bold;
            color: #10B981;
            margin: 0 0 5px 0;
        }
        .title {
            font-size: 11pt;
            color: #4B5563;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .sidebar-section-title {
            font-size: 11pt;
            font-weight: bold;
            color: #111827;
            border-bottom: 2px solid #E2E8F0;
            padding-bottom: 5px;
            margin-top: 25px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .section-title {
            font-size: 13pt;
            font-weight: bold;
            color: #047857;
            border-bottom: 2px solid #10B981;
            padding-bottom: 3px;
            margin-top: 25px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }
        .contact-item {
            font-size: 9.5pt;
            margin-bottom: 8px;
            word-wrap: break-word;
        }
        .contact-label {
            font-weight: bold;
            color: #4B5563;
            display: block;
            font-size: 8.5pt;
            text-transform: uppercase;
        }
        .skill-badge {
            display: block;
            background-color: #10B981;
            color: #ffffff;
            font-size: 9pt;
            padding: 4px 8px;
            border-radius: 4px;
            margin-bottom: 6px;
            text-align: center;
            font-weight: 500;
        }
        .timeline-item {
            margin-bottom: 15px;
        }
        .timeline-header {
            font-weight: bold;
            font-size: 11pt;
        }
        .timeline-sub {
            color: #6B7280;
            font-size: 9.5pt;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2 class="name">{{ $name }}</h2>
            <div class="title">Professional Resume</div>

            <div class="sidebar-section-title">Kontak</div>
            <div class="contact-item">
                <span class="contact-label">Email</span>
                {{ $email }}
            </div>
            <div class="contact-item">
                <span class="contact-label">Telepon</span>
                {{ $phone }}
            </div>
            <div class="contact-item">
                <span class="contact-label">Lokasi</span>
                {{ $location }}
            </div>

            <div class="sidebar-section-title">Kompetensi</div>
            <div style="margin-top: 8px;">
                @if(is_array($skills))
                    @foreach($skills as $skill)
                        <div class="skill-badge">{{ $skill }}</div>
                    @endforeach
                @else
                    <div class="skill-badge">{{ $skills }}</div>
                @endif
            </div>

            <div class="sidebar-section-title">Gaji Diharapkan</div>
            <div class="contact-item">
                Rp {{ number_format($expected_salary, 0, ',', '.') }} / bln
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div>
                <div class="section-title" style="margin-top:0;">Tentang Saya</div>
                <p style="text-align: justify; margin: 0; font-size:10pt;">
                    {{ $bio }}
                </p>
            </div>

            <div>
                <div class="section-title">Pendidikan</div>
                <div class="timeline-item">
                    <div class="timeline-header">{{ $education_level }} - Lulusan Terakreditasi</div>
                    <div class="timeline-sub">Institusi Pendidikan Indonesia</div>
                    <p style="font-size: 9.5pt; margin: 5px 0 0 0;">
                        Fokus pada studi fungsional dan pengembangan kompetensi akademis industri terkait.
                    </p>
                </div>
            </div>

            <div>
                <div class="section-title">Pengalaman Kerja</div>
                <div class="timeline-item">
                    <div class="timeline-header">{{ $experience_years }} Tahun Pengalaman Profesional</div>
                    <div class="timeline-sub">Industri & Teknologi Terkait</div>
                    <p style="font-size: 9.5pt; margin: 5px 0 0 0; text-align: justify;">
                        Telah mengerjakan berbagai implementasi aplikasi, sistem manajemen, serta optimasi efisiensi operasional. Berkontribusi aktif dalam tim pengembang untuk memecahkan tantangan bisnis yang kompleks.
                    </p>
                </div>
            </div>

            <div style="margin-top: 40px; font-size: 8.5pt; color: #9CA3AF; text-align: center; border-top: 1px solid #F3F4F6; padding-top: 10px;">
                Resume dibuat secara otomatis melalui platform pencarian kerja Indonesia MauLoker
            </div>
        </div>
    </div>

</body>
</html>
