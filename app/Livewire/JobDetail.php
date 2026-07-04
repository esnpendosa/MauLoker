<?php

namespace App\Livewire;

use App\Models\Job;
use App\Models\Application;
use App\Services\MatchEngineService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class JobDetail extends Component
{
    use WithFileUploads;

    public $job;
    public $showApplyModal = false;
    public $cover_letter = '';
    public $resume_file;

    // For Candidates: Match score details
    public $matchResult = null;
    public $hasApplied = false;
    public $isSaved = false;
    public $hasCv = false;

    public function mount($job_slug)
    {
        $this->job = Job::with('company', 'category')
            ->where('slug', $job_slug)
            ->firstOrFail();

        // Increment Views
        $this->job->increment('views_count');

        // Check if candidate is logged in and compute matching score
        if (Auth::check() && Auth::user()->isCandidate()) {
            $user = Auth::user();
            
            // Check if already applied
            $this->hasApplied = Application::where('job_id', $this->job->id)
                ->where('candidate_id', $user->id)
                ->exists();

            // Check if saved
            $this->isSaved = \App\Models\SavedJob::where('user_id', $user->id)
                ->where('job_id', $this->job->id)
                ->exists();

            // Check if CV exists
            $this->hasCv = !empty($user->cv_path);

            // Calculate match score using service
            $engine = new MatchEngineService();
            $this->matchResult = $engine->calculateMatch($user, $this->job);
        }
    }

    public function toggleSaveJob()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'candidate') {
            session()->flash('error', 'Hanya akun pencari kerja yang dapat menyimpan pekerjaan.');
            return;
        }

        $user = Auth::user();
        $saved = \App\Models\SavedJob::where('user_id', $user->id)
            ->where('job_id', $this->job->id)
            ->first();

        if ($saved) {
            $saved->delete();
            $this->isSaved = false;
            session()->flash('success', 'Lowongan dihapus dari daftar disimpan.');
        } else {
            \App\Models\SavedJob::create([
                'user_id' => $user->id,
                'job_id' => $this->job->id
            ]);
            $this->isSaved = true;
            session()->flash('success', 'Lowongan berhasil disimpan!');
        }
    }

    public function openApply()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (Auth::user()->role !== 'candidate') {
            session()->flash('error', 'Hanya akun pencari kerja yang dapat melamar pekerjaan.');
            return;
        }

        if ($this->hasApplied) {
            session()->flash('error', 'Anda sudah melamar pekerjaan ini sebelumnya.');
            return;
        }

        $this->showApplyModal = true;
    }

    public function submitApplication()
    {
        $this->validate([
            'cover_letter' => 'required|min:50',
            'resume_file' => Auth::user()->cv_path ? 'nullable|mimes:pdf|max:5120' : 'required|mimes:pdf|max:5120', // Max 5MB PDF
        ], [
            'cover_letter.required' => 'Surat lamaran wajib diisi.',
            'cover_letter.min' => 'Surat lamaran minimal berisi 50 karakter.',
            'resume_file.required' => 'File CV PDF wajib diunggah.',
            'resume_file.mimes' => 'File CV harus berupa dokumen PDF.',
            'resume_file.max' => 'Ukuran file CV maksimal 5MB.',
        ]);

        $user = Auth::user();
        $resumePath = $user->cv_path;

        if ($this->resume_file) {
            // Save new CV file
            $path = $this->resume_file->store('resumes', 'public');
            $resumePath = 'storage/' . $path;

            // Also update candidate profile CV path
            $user->update(['cv_path' => $resumePath]);
        }

        // Calculate match scores
        $engine = new MatchEngineService();
        $scores = $engine->calculateMatch($user, $this->job);

        // Create application
        $newApp = Application::create([
            'job_id' => $this->job->id,
            'candidate_id' => $user->id,
            'resume_path' => $resumePath,
            'cover_letter' => $this->cover_letter,
            'match_score' => $scores['overall'],
            'skill_score' => $scores['skill_score'],
            'location_score' => $scores['location_score'],
            'experience_score' => $scores['experience_score'],
            'salary_score' => $scores['salary_score'],
            'education_score' => $scores['education_score'],
            'status' => 'Applied',
            'status_history' => [
                [
                    'status' => 'Applied',
                    'note' => 'Lamaran berhasil dikirim via platform MauLoker.',
                    'created_at' => now()->toDateTimeString()
                ]
            ]
        ]);

        // Increment applies count
        $this->job->increment('applies_count');
        $this->hasApplied = true;
        $this->showApplyModal = false;

        // Send email notifications: user and company owner
        $this->sendApplicationNotification($newApp);

        session()->flash('success', 'Lamaran Anda berhasil dikirim ke ' . $this->job->company->name . '!');
    }

    public function quickApply()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'candidate') {
            session()->flash('error', 'Hanya akun pencari kerja yang dapat melamar pekerjaan.');
            return;
        }

        if ($this->hasApplied) {
            session()->flash('error', 'Anda sudah melamar pekerjaan ini sebelumnya.');
            return;
        }

        $user = Auth::user();

        if (!$user->cv_path) {
            session()->flash('error', 'Silakan unggah CV terlebih dahulu di dashboard Anda sebelum menggunakan Lamar Cepat.');
            return;
        }

        // Calculate match scores
        $engine = new MatchEngineService();
        $scores = $engine->calculateMatch($user, $this->job);

        // Auto cover letter
        $coverLetter = "Yth. Perekrut " . $this->job->company->name . ",\n\nSaya sangat tertarik dengan posisi " . $this->job->title . " di " . $this->job->company->name . ". Dengan pengalaman saya selama " . ($user->experience_years ?? 0) . " tahun di bidang terkait serta latar belakang pendidikan " . ($user->education_level ?? 'S1') . ", saya yakin dapat berkontribusi positif bagi tim Anda.\n\nDemikian lamaran singkat saya. Terima kasih atas perhatian Anda.";

        // Create application
        $newApp = Application::create([
            'job_id' => $this->job->id,
            'candidate_id' => $user->id,
            'resume_path' => $user->cv_path,
            'cover_letter' => $coverLetter,
            'match_score' => $scores['overall'],
            'skill_score' => $scores['skill_score'],
            'location_score' => $scores['location_score'],
            'experience_score' => $scores['experience_score'],
            'salary_score' => $scores['salary_score'],
            'education_score' => $scores['education_score'],
            'status' => 'Applied',
            'status_history' => [
                [
                    'status' => 'Applied',
                    'note' => 'Lamaran dikirim via Lamar Cepat (1-Klik).',
                    'created_at' => now()->toDateTimeString()
                ]
            ]
        ]);

        // Increment applies count
        $this->job->increment('applies_count');
        $this->hasApplied = true;

        // Send email notifications: user and company owner
        $this->sendApplicationNotification($newApp);

        session()->flash('success', 'Lamar Cepat Berhasil! Lamaran Anda dengan CV terunggah telah dikirim.');
    }

    protected function sendApplicationNotification($application)
    {
        $candidate = $application->candidate;
        $job = $application->job;
        $company = $job->company;
        $employer = $company->user; // The user who owns the company account
        $candidateUrl = url('/candidate/dashboard');
        $companyUrl = url('/company/dashboard');
        $candidateName = e($candidate->name);
        $jobTitle = e($job->title);
        $companyName = e($company->name);
        $employerName = e($employer->name ?? '');
        $candidateEducation = e($candidate->education_level ?: '-');
        $candidateExp = e($candidate->experience_years ?: 0);
        $matchScore = e($application->match_score);

        // 1. Email to Candidate
        try {
            Mail::send([], [], function ($message) use ($candidate, $job, $candidateName, $jobTitle, $companyName, $candidateUrl) {
                $message->to($candidate->email)
                    ->subject('Lamaran Terkirim: ' . $job->title)
                    ->html(<<<HTML
                        <div style="font-family: 'Instrument Sans', sans-serif; max-width: 600px; margin: 0 auto; padding: 40px 20px; background-color: #f8fafc; border-radius: 24px;">
                            <div style="background-color: #ffffff; padding: 40px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                                <div style="margin-bottom: 24px;">
                                    <span style="font-size: 24px; font-weight: 900; color: #10b981;">MauLoker</span>
                                </div>
                                <h2 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 12px;">Halo {$candidateName}!</h2>
                                <p style="font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 24px;">
                                    Terima kasih telah melamar pekerjaan di MauLoker. Lamaran Anda untuk posisi <strong>{$jobTitle}</strong> di <strong>{$companyName}</strong> telah berhasil kami teruskan ke pihak HRD / Perekrut.
                                </p>
                                <p style="font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 24px;">
                                    Anda dapat melacak status lamaran Anda secara berkala melalui dashboard pencari kerja Anda di platform MauLoker.
                                </p>
                                <div style="text-align: center; margin-bottom: 32px;">
                                    <a href="{$candidateUrl}" style="display: inline-block; padding: 14px 32px; background-color: #10b981; color: #ffffff; text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 14px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);">
                                        Pantau Status Lamaran
                                    </a>
                                </div>
                                <p style="font-size: 11px; color: #94a3b8; text-align: center; margin-top: 24px;">
                                    Email ini dikirim otomatis oleh MauLoker. Jangan membalas email ini.
                                </p>
                            </div>
                        </div>
HTML
                    );
            });
        } catch (\Exception $e) {
            logger()->error('Failed sending candidate application email: ' . $e->getMessage());
        }

        // 2. Email to Employer
        if ($employer && $employer->email) {
            try {
                Mail::send([], [], function ($message) use ($candidate, $job, $employer, $application, $employerName, $candidateName, $jobTitle, $candidateEducation, $candidateExp, $matchScore, $companyUrl) {
                    $message->to($employer->email)
                        ->subject('Lamaran Baru Diterima: ' . $job->title)
                        ->html(<<<HTML
                            <div style="font-family: 'Instrument Sans', sans-serif; max-width: 600px; margin: 0 auto; padding: 40px 20px; background-color: #f8fafc; border-radius: 24px;">
                                <div style="background-color: #ffffff; padding: 40px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                                    <div style="margin-bottom: 24px;">
                                        <span style="font-size: 24px; font-weight: 900; color: #10b981;">MauLoker Recruiter</span>
                                    </div>
                                    <h2 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 12px;">Halo {$employerName}!</h2>
                                    <p style="font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 24px;">
                                        Seseorang baru saja melamar lowongan pekerjaan Anda untuk posisi <strong>{$jobTitle}</strong>.
                                    </p>
                                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 24px; font-size: 13px;">
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 700; color: #475569; width: 150px;">Nama Pelamar:</td>
                                            <td style="padding: 8px 0; color: #0f172a;">{$candidateName}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 700; color: #475569;">Pendidikan:</td>
                                            <td style="padding: 8px 0; color: #0f172a;">{$candidateEducation}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 700; color: #475569;">Pengalaman:</td>
                                            <td style="padding: 8px 0; color: #0f172a;">{$candidateExp} Tahun</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 700; color: #475569;">AI Match Score:</td>
                                            <td style="padding: 8px 0; color: #10b981; font-weight: 700;">{$matchScore}%</td>
                                        </tr>
                                    </table>
                                    <div style="text-align: center; margin-bottom: 32px;">
                                        <a href="{$companyUrl}" style="display: inline-block; padding: 14px 32px; background-color: #10b981; color: #ffffff; text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 14px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);">
                                            Tinjau Lamaran di Dashboard
                                        </a>
                                    </div>
                                    <p style="font-size: 11px; color: #94a3b8; text-align: center; margin-top: 24px;">
                                        Email ini dikirim otomatis oleh MauLoker. Jangan membalas email ini.
                                    </p>
                                </div>
                            </div>
HTML
                        );
                });
            } catch (\Exception $e) {
                logger()->error('Failed sending employer notification email: ' . $e->getMessage());
            }
        }
    }

    public function render()
    {
        // Load Ads
        $topAd = \App\Models\Ad::where('position_code', 'job_detail_top')
            ->where('status', true)
            ->first();

        $sidebarAd = \App\Models\Ad::where('position_code', 'job_detail_sidebar')
            ->where('status', true)
            ->first();

        // JobPosting Schema.org Structured Data
        $schemaData = [
            '@context' => 'https://schema.org',
            '@type' => 'JobPosting',
            'title' => $this->job->title,
            'description' => strip_tags($this->job->description),
            'datePosted' => $this->job->created_at ? $this->job->created_at->toIso8601String() : now()->toIso8601String(),
            'validThrough' => $this->job->created_at ? $this->job->created_at->addMonths(3)->toIso8601String() : now()->addMonths(3)->toIso8601String(),
            'employmentType' => str_contains(strtolower($this->job->employment_type), 'part') ? 'PART_TIME' : 'FULL_TIME',
            'hiringOrganization' => [
                '@type' => 'Organization',
                'name' => $this->job->company ? $this->job->company->name : 'Perusahaan',
                'sameAs' => $this->job->company && $this->job->company->website ? $this->job->company->website : url('/'),
                'logo' => $this->job->company && $this->job->company->logo ? url($this->job->company->logo) : 'https://img.icons8.com/color/512/000000/find-matching-job.png'
            ],
            'jobLocation' => [
                '@type' => 'Place',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => $this->job->city ?: 'Indonesia',
                    'addressRegion' => $this->job->city ?: 'Indonesia',
                    'addressCountry' => 'ID'
                ]
            ]
        ];

        if ($this->job->salary_min && $this->job->salary_max) {
            $schemaData['baseSalary'] = [
                '@type' => 'MonetaryAmount',
                'currency' => $this->job->salary_currency ?: 'IDR',
                'value' => [
                    '@type' => 'QuantitativeValue',
                    'minValue' => $this->job->salary_min,
                    'maxValue' => $this->job->salary_max,
                    'unitText' => 'MONTH'
                ]
            ];
        }

        return view('livewire.job-detail', [
            'topAd' => $topAd,
            'sidebarAd' => $sidebarAd
        ])->layout('components.layouts.app', [
            'seoTitle' => $this->job->title . ' di ' . ($this->job->company ? $this->job->company->name : 'Perusahaan') . ' - MauLoker',
            'seoDescription' => \Illuminate\Support\Str::limit(strip_tags($this->job->description), 150),
            'schemaData' => $schemaData
        ]);
    }
}
