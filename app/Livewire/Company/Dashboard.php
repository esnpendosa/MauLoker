<?php

namespace App\Livewire\Company;

use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Application;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Dashboard extends Component
{
    // Tabs control
    public $activeTab = 'dashboard'; // dashboard, manage_jobs, applicants, profile

    // Job Form fields
    public $showJobModal = false;
    public $jobId = null;
    public $jobTitle = '';
    public $category_id = '';
    public $description = '';
    public $requirements = '';
    public $skills_input = '';
    public $experience_years = 0;
    public $education_level = 'S1';
    public $employment_type = 'Full-time';
    public $location_type = 'Onsite';
    public $city = '';
    public $salary_min = 0;
    public $salary_max = 0;
    public $benefits = '';
    public $is_featured = false;
    public $is_urgent = false;

    // Company Form fields
    public $companyName = '';
    public $companyCategory = '';
    public $companyDescription = '';
    public $companyWebsite = '';
    public $companyPhone = '';
    public $companyLocation = '';
    public $companyAddress = '';
    public $companyScale = '10-50 karyawan';

    // Applicant filter
    public $selectedJobId = '';

    public function mount()
    {
        $user = Auth::user();
        $company = $user->company;

        if ($company) {
            $this->companyName = $company->name;
            $this->companyCategory = $company->category;
            $this->companyDescription = $company->description;
            $this->companyWebsite = $company->website;
            $this->companyPhone = $company->phone;
            $this->companyLocation = $company->location;
            $this->companyAddress = $company->address;
            $this->companyScale = $company->scale;
        }
    }

    public function openCreateJob()
    {
        $this->resetJobForm();
        $this->showJobModal = true;
    }

    public function openEditJob($id)
    {
        $job = Job::findOrFail($id);
        $this->jobId = $job->id;
        $this->jobTitle = $job->title;
        $this->category_id = $job->category_id;
        $this->description = $job->description;
        $this->requirements = $job->requirements;
        $this->experience_years = $job->experience_years;
        $this->education_level = $job->education_level;
        $this->employment_type = $job->employment_type;
        $this->location_type = $job->location_type;
        $this->city = $job->city;
        $this->salary_min = $job->salary_min;
        $this->salary_max = $job->salary_max;
        $this->benefits = $job->benefits;
        $this->is_featured = $job->is_featured;
        $this->is_urgent = $job->is_urgent;

        $skills = $job->skills;
        $this->skills_input = is_array($skills) ? implode(', ', $skills) : $skills;

        $this->showJobModal = true;
    }

    public function resetJobForm()
    {
        $this->reset([
            'jobId', 'jobTitle', 'category_id', 'description', 'requirements', 'skills_input',
            'experience_years', 'education_level', 'employment_type', 'location_type',
            'city', 'salary_min', 'salary_max', 'benefits', 'is_featured', 'is_urgent'
        ]);
    }

    public function saveJob()
    {
        $this->validate([
            'jobTitle' => 'required|min:5',
            'category_id' => 'required|exists:job_categories,id',
            'description' => 'required|min:50',
            'city' => 'required',
            'salary_min' => 'required|numeric',
            'salary_max' => 'required|numeric|gte:salary_min',
        ], [
            'jobTitle.required' => 'Judul pekerjaan wajib diisi.',
            'category_id.required' => 'Kategori pekerjaan wajib dipilih.',
            'description.required' => 'Deskripsi pekerjaan wajib diisi.',
            'city.required' => 'Kota penempatan wajib diisi.',
            'salary_max.gte' => 'Gaji maksimal harus lebih besar atau sama dengan gaji minimal.',
        ]);

        $company = Auth::user()->company;
        $skillsArray = array_filter(array_map('trim', explode(',', $this->skills_input)));

        $data = [
            'company_id' => $company->id,
            'category_id' => $this->category_id,
            'title' => $this->jobTitle,
            'slug' => Str::slug($this->jobTitle) . '-' . rand(100, 999),
            'description' => $this->description,
            'requirements' => $this->requirements,
            'skills' => $skillsArray,
            'experience_years' => $this->experience_years,
            'education_level' => $this->education_level,
            'employment_type' => $this->employment_type,
            'location_type' => $this->location_type,
            'city' => $this->city,
            'salary_min' => $this->salary_min,
            'salary_max' => $this->salary_max,
            'benefits' => $this->benefits,
            'is_featured' => $this->is_featured,
            'is_urgent' => $this->is_urgent,
            'status' => 'active'
        ];

        if ($this->jobId) {
            $job = Job::findOrFail($this->jobId);
            $job->update($data);
            session()->flash('success', 'Lowongan pekerjaan berhasil diperbarui!');
        } else {
            Job::create($data);
            session()->flash('success', 'Lowongan pekerjaan baru berhasil dipasang!');
        }

        $this->showJobModal = false;
        $this->resetJobForm();
    }

    public function changeStatus($appId, $newStatus)
    {
        $app = Application::findOrFail($appId);
        $history = $app->status_history ?: [];
        $history[] = [
            'status' => $newStatus,
            'note' => 'Status lamaran diubah oleh pihak perusahaan.',
            'created_at' => now()->toDateTimeString()
        ];

        $app->update([
            'status' => $newStatus,
            'status_history' => $history
        ]);

        session()->flash('success', 'Status lamaran kandidat berhasil diubah menjadi ' . $newStatus . '!');
    }

    public function saveCompanyProfile()
    {
        $company = Auth::user()->company;
        
        $company->update([
            'name' => $this->companyName,
            'category' => $this->companyCategory,
            'description' => $this->companyDescription,
            'website' => $this->companyWebsite,
            'phone' => $this->companyPhone,
            'location' => $this->companyLocation,
            'address' => $this->companyAddress,
            'scale' => $this->companyScale,
        ]);

        session()->flash('success', 'Profil Perusahaan berhasil diperbarui!');
    }

    public function render()
    {
        $company = Auth::user()->company;
        
        // Manage Jobs list
        $jobs = Job::where('company_id', $company->id)->latest()->get();
        $categories = JobCategory::where('status', true)->get();

        // Applicants Query
        $applicantsQuery = Application::with('job', 'candidate')
            ->whereHas('job', function($q) use ($company) {
                $q->where('company_id', $company->id);
            });

        if (!empty($this->selectedJobId)) {
            $applicantsQuery->where('job_id', $this->selectedJobId);
        }

        $applicants = $applicantsQuery->latest()->get();

        // Statistics
        $stats = [
            'total_jobs' => $jobs->count(),
            'active_jobs' => $jobs->where('status', 'active')->count(),
            'total_applies' => $jobs->sum('applies_count'),
            'unread_messages' => 0
        ];

        // Load Ads
        $dashboardAd = \App\Models\Ad::where('position_code', 'dashboard_company')
            ->where('status', true)
            ->first();

        return view('livewire.company.dashboard', [
            'company' => $company,
            'jobs' => $jobs,
            'categories' => $categories,
            'applicants' => $applicants,
            'stats' => $stats,
            'dashboardAd' => $dashboardAd
        ])->layout('components.layouts.app', [
            'seoTitle' => 'Dashboard Perusahaan - MauLoker',
            'seoDescription' => 'Pasang lowongan kerja baru, seleksi pelamar, dan tinjau AI Match Score secara instan.'
        ]);
    }
}
