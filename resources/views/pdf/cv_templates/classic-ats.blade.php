<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resume - {{ $name }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11pt;
            color: #333333;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #10B981;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .name {
            font-size: 24pt;
            font-weight: bold;
            color: #111827;
            margin: 0 0 5px 0;
        }
        .contact-info {
            font-size: 10pt;
            color: #6B7280;
        }
        .section-title {
            font-size: 14pt;
            font-weight: bold;
            color: #047857;
            border-bottom: 1px solid #E5E7EB;
            padding-bottom: 4px;
            margin-top: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .section-content {
            margin-bottom: 15px;
        }
        .item-title {
            font-weight: bold;
            font-size: 11pt;
            color: #1F2937;
        }
        .item-subtitle {
            font-style: italic;
            color: #4B5563;
            margin-bottom: 5px;
        }
        .skills-list {
            margin-top: 5px;
        }
        .skill-tag {
            display: inline-block;
            background-color: #F3F4F6;
            border: 1px solid #E5E7EB;
            border-radius: 4px;
            padding: 2px 8px;
            font-size: 9pt;
            color: #374151;
            margin-right: 5px;
            margin-bottom: 5px;
        }
        .bio-text {
            text-align: justify;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1 class="name">{{ $name }}</h1>
        <div class="contact-info">
            Email: {{ $email }} | 
            Phone: {{ $phone }} | 
            Lokasi: {{ $location }}
        </div>
    </div>

    <div>
        <div class="section-title">Ringkasan Profesional</div>
        <div class="section-content bio-text">
            {{ $bio }}
        </div>
    </div>

    <div>
        <div class="section-title">Keahlian & Kompetensi</div>
        <div class="section-content skills-list">
            @if(is_array($skills))
                @foreach($skills as $skill)
                    <span class="skill-tag">{{ $skill }}</span>
                @endforeach
            @else
                <span class="skill-tag">{{ $skills }}</span>
            @endif
        </div>
    </div>

    <div>
        <div class="section-title">Riwayat Pendidikan</div>
        <div class="section-content">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td class="item-title">Gelar / Pendidikan Terakhir</td>
                    <td style="text-align: right; font-weight: bold; color: #4B5563;">{{ $education_level }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="item-subtitle">Institusi Pendidikan Indonesia</td>
                </tr>
            </table>
        </div>
    </div>

    <div>
        <div class="section-title">Riwayat Pekerjaan</div>
        <div class="section-content">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td class="item-title">Pengalaman Kerja Kumulatif</td>
                    <td style="text-align: right; font-weight: bold; color: #4B5563;">{{ $experience_years }} Tahun Pengalaman</td>
                </tr>
                <tr>
                    <td colspan="2" class="item-subtitle">Berbagai proyek profesional dan fungsional industri terkait.</td>
                </tr>
            </table>
            <p style="font-size: 10pt; color: #6B7280; margin-top: 10px;">
                * Detail pekerjaan yang lebih spesifik dapat ditemukan di profil akun MauLoker online pencari kerja.
            </p>
        </div>
    </div>

    <div>
        <div class="section-title">Ekspektasi Gaji</div>
        <div class="section-content">
            Rp {{ number_format($expected_salary, 0, ',', '.') }} / Bulan (Nego)
        </div>
    </div>

</body>
</html>
