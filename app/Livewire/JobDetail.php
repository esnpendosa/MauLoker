<?php

namespace App\Livewire;

use App\Models\Job;
use App\Models\Application;
use App\Services\MatchEngineService;
use Illuminate\Support\Facades\Auth;
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

            // Calculate match score using service
            $engine = new MatchEngineService();
            $this->matchResult = $engine->calculateMatch($user, $this->job);
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
        Application::create([
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

        session()->flash('success', 'Lamaran Anda berhasil dikirim ke ' . $this->job->company->name . '!');
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

        return view('livewire.job-detail', [
            'topAd' => $topAd,
            'sidebarAd' => $sidebarAd
        ])->layout('components.layouts.app', [
            'seoTitle' => $this->job->title . ' di ' . $this->job->company->name . ' - MauLoker',
            'seoDescription' => Str_Limit_Helper(strip_tags($this->job->description), 150)
        ]);
    }
}

// Simple helper inside namespace if not loaded
function Str_Limit_Helper($value, $limit = 100, $end = '...') {
    if (mb_strwidth($value, 'UTF-8') <= $limit) {
        return $value;
    }
    return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
}
