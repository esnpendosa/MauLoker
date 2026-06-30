<?php

namespace App\Services;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Str;

class ResumeBuilderService
{
    /**
     * Check the ATS score of an uploaded PDF file
     * 
     * @param string $pdfPath Absolute path to the PDF file
     * @param array $jobKeywords Expected keywords (optional, from a specific job)
     * @return array
     */
    public function checkAtsScore(string $pdfPath, array $jobKeywords = []): array
    {
        try {
            $parser = new Parser();
            $pdf = $parser->parseFile($pdfPath);
            $text = $pdf->getText();
            $textLower = strtolower($text);

            if (empty(trim($text))) {
                return [
                    'score' => 20,
                    'readability' => 'Poor (Scanned image PDF or empty file)',
                    'sections_found' => [],
                    'sections_missing' => ['Education', 'Experience', 'Skills', 'Contact'],
                    'feedback' => 'File Anda tidak terbaca sebagai teks. Pastikan PDF Anda bukan hasil scan gambar. Sistem ATS tidak bisa membaca tulisan dalam gambar.',
                    'details' => []
                ];
            }

            // 1. Check sections
            $sections = [
                'Contact Info' => ['phone', 'email', 'address', 'kontak', 'telepon', 'linkedin'],
                'Work Experience' => ['experience', 'pengalaman', 'work', 'employment', 'riwayat kerja', 'kerja'],
                'Education' => ['education', 'pendidikan', 'kuliah', 'universitas', 'sekolah', 'school', 'academy'],
                'Skills' => ['skills', 'keahlian', 'skills & abilities', 'kemampuan', 'kompetensi'],
                'Projects' => ['projects', 'proyek', 'portofolio', 'portfolio'],
            ];

            $foundSections = [];
            $missingSections = [];
            $sectionScore = 0;

            foreach ($sections as $sectionName => $keywords) {
                $found = false;
                foreach ($keywords as $kw) {
                    if (str_contains($textLower, $kw)) {
                        $found = true;
                        break;
                    }
                }
                if ($found) {
                    $foundSections[] = $sectionName;
                    $sectionScore += 12; // Max 60 points for sections
                } else {
                    $missingSections[] = $sectionName;
                }
            }

            // 2. Check general keywords (Industry standards)
            $generalKeywords = [
                'laravel', 'php', 'javascript', 'mysql', 'css', 'html', 'git', 'api',
                'teamwork', 'communication', 'management', 'developer', 'engineer', 'desain',
                'pemasaran', 'analisis', 'planning', 'microsoft office', 'excel', 'english'
            ];
            $kwMatches = 0;
            foreach ($generalKeywords as $kw) {
                if (str_contains($textLower, $kw)) {
                    $kwMatches++;
                }
            }
            $keywordScore = min(20, $kwMatches * 2.5); // Max 20 points

            // 3. Format & Readability Score (length, tables, symbols)
            $readabilityScore = 20; // Default 20
            $textLength = strlen($text);
            if ($textLength < 200) {
                $readabilityScore -= 10; // Too short
            }
            if (str_contains($textLower, 'http') || str_contains($textLower, 'www')) {
                $readabilityScore += 5; // Has portfolio/links
            }
            $readabilityScore = min(20, max(5, $readabilityScore));

            // Overall Score
            $totalScore = $sectionScore + $keywordScore + $readabilityScore;
            $totalScore = min(100, max(10, round($totalScore)));

            // Feedback generating
            $feedback = 'CV Anda sudah terstruktur dengan cukup baik.';
            if ($totalScore < 50) {
                $feedback = 'Skor ATS Anda sangat rendah. Disarankan untuk menggunakan template CV yang lebih terstruktur dan menambahkan informasi riwayat kerja serta keterampilan teknis yang lebih jelas.';
            } elseif ($totalScore < 75) {
                $feedback = 'CV Anda memiliki tingkat keterbacaan sedang. Cobalah untuk menambahkan lebih banyak kata kunci relevan sesuai industri pekerjaan Anda.';
            } else {
                $feedback = 'Luar biasa! CV Anda memiliki format yang sangat baik dan ramah sistem ATS.';
            }

            return [
                'score' => $totalScore,
                'readability' => $totalScore > 75 ? 'Excellent' : ($totalScore > 50 ? 'Good' : 'Needs Improvement'),
                'sections_found' => $foundSections,
                'sections_missing' => $missingSections,
                'feedback' => $feedback,
                'word_count' => str_word_count($text),
                'details' => [
                    'section_score' => $sectionScore,
                    'keyword_score' => $keywordScore,
                    'readability_score' => $readabilityScore
                ]
            ];

        } catch (\Exception $e) {
            return [
                'score' => 0,
                'error' => $e->getMessage(),
                'feedback' => 'Gagal menganalisis file PDF. Pastikan file tidak rusak.',
                'sections_found' => [],
                'sections_missing' => ['Contact', 'Experience', 'Education', 'Skills']
            ];
        }
    }

    /**
     * Generate PDF Resume for a Candidate User
     * 
     * @param User $candidate
     * @param string $templateSlug Template style (classic-ats, modern-prof)
     * @return \Barryvdh\DomPDF\PDF
     */
    public function generatePdfResume(User $candidate, string $templateSlug = 'classic-ats')
    {
        $data = [
            'name' => $candidate->name,
            'email' => $candidate->email,
            'phone' => $candidate->phone ?? '-',
            'location' => $candidate->location ?? '-',
            'bio' => $candidate->bio ?? '-',
            'skills' => is_array($candidate->skills) ? $candidate->skills : (json_decode($candidate->skills, true) ?? explode(',', $candidate->skills ?? '')),
            'education_level' => $candidate->education_level ?? '-',
            'experience_years' => $candidate->experience_years ?? 0,
            'expected_salary' => $candidate->expected_salary ?? 0,
        ];

        // We render a blade file. Let's make sure the PDF views are configured.
        $viewName = 'pdf.cv_templates.' . $templateSlug;
        
        // Return DomPDF object
        return Pdf::loadView($viewName, $data);
    }
}
