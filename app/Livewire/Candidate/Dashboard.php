<?php

namespace App\Livewire\Candidate;

use App\Models\Application;
use App\Services\ResumeBuilderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Dashboard extends Component
{
    use WithFileUploads;

    // Profile form fields
    public $name = '';
    public $phone = '';
    public $location = '';
    public $bio = '';
    public $expected_salary = 0;
    public $education_level = '';
    public $experience_years = 0;
    public $skills_input = '';

    // File upload
    public $new_cv_file;

    // ATS Results holder
    public $atsResults = null;

    // PDF Resume download settings
    public $selectedTemplate = 'classic-ats';

    // Tabs control
    public $activeTab = 'profile'; // profile, cv_builder, applications

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->location = $user->location;
        $this->bio = $user->bio;
        $this->expected_salary = $user->expected_salary;
        $this->education_level = $user->education_level;
        $this->experience_years = $user->experience_years;

        // Convert skills array to comma-separated text
        $skills = $user->skills;
        if (is_array($skills)) {
            $this->skills_input = implode(', ', $skills);
        } else {
            $this->skills_input = is_string($skills) ? implode(', ', json_decode($skills, true) ?? explode(',', $skills)) : '';
        }
    }

    public function saveProfile()
    {
        $this->validate([
            'name' => 'required|min:3',
            'phone' => 'nullable',
            'location' => 'nullable',
            'bio' => 'nullable|max:500',
            'expected_salary' => 'nullable|numeric',
            'education_level' => 'nullable',
            'experience_years' => 'nullable|integer',
        ]);

        $user = Auth::user();
        
        // Parse skills comma list
        $skillsArray = array_filter(array_map('trim', explode(',', $this->skills_input)));

        $user->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'location' => $this->location,
            'bio' => $this->bio,
            'expected_salary' => $this->expected_salary,
            'education_level' => $this->education_level,
            'experience_years' => $this->experience_years,
            'skills' => $skillsArray
        ]);

        session()->flash('success', 'Profil Anda berhasil diperbarui!');
    }

    public function uploadCv()
    {
        $this->validate([
            'new_cv_file' => 'required|mimes:pdf|max:5120',
        ], [
            'new_cv_file.required' => 'Pilih file PDF terlebih dahulu.',
            'new_cv_file.mimes' => 'Format file harus PDF.',
            'new_cv_file.max' => 'Ukuran file maksimal adalah 5MB.',
        ]);

        $path = $this->new_cv_file->store('resumes', 'public');
        $relativeUrl = 'storage/' . $path;
        $absolutePath = storage_path('app/public/' . $path);

        // Run ATS checker service
        $atsService = new ResumeBuilderService();
        $results = $atsService->checkAtsScore($absolutePath);

        $user = Auth::user();
        $user->update([
            'cv_path' => $relativeUrl,
            'cv_ats_score' => $results['score'] ?? 0,
        ]);

        $this->atsResults = $results;
        $this->new_cv_file = null;

        session()->flash('success', 'CV berhasil diunggah dan dianalisis sistem ATS!');
    }

    public function downloadPdfResume()
    {
        $user = Auth::user();
        $builder = new ResumeBuilderService();
        $pdf = $builder->generatePdfResume($user, $this->selectedTemplate);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'CV_ATS_' . Str_Slug_Helper($user->name) . '.pdf'
        );
    }

    public function unsaveJob($id)
    {
        \App\Models\SavedJob::where('user_id', Auth::id())
            ->where('id', $id)
            ->delete();
        
        session()->flash('success', 'Lowongan dihapus dari daftar disimpan.');
    }

    public function render()
    {
        $user = Auth::user();
        $applications = Application::with('job.company')
            ->where('candidate_id', $user->id)
            ->latest()
            ->get();

        $savedJobs = \App\Models\SavedJob::with('job.company')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Load Ads
        $dashboardAd = \App\Models\Ad::where('position_code', 'dashboard_candidate')
            ->where('status', true)
            ->first();

        return view('livewire.candidate.dashboard', [
            'user' => $user,
            'applications' => $applications,
            'savedJobs' => $savedJobs,
            'dashboardAd' => $dashboardAd
        ])->layout('components.layouts.app', [
            'seoTitle' => 'Dashboard Pelamar - MauLoker',
            'seoDescription' => 'Kelola profil CV, cek skor ATS, dan lacak status lamaran Anda secara real-time.'
        ]);
    }
}

// Simple helper inside namespace if not loaded
function Str_Slug_Helper($title, $separator = '-') {
    return strtolower(preg_replace('/[^A-Za-z0-9-]+/', $separator, $title));
}
