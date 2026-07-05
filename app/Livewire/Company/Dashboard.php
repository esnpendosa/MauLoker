<?php

namespace App\Livewire\Company;

use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Application;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
    public $new_category_name = '';
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
    public $expandedApplicantId = null;

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
            'jobId', 'jobTitle', 'category_id', 'new_category_name', 'description', 'requirements', 'skills_input',
            'experience_years', 'education_level', 'employment_type', 'location_type',
            'city', 'salary_min', 'salary_max', 'benefits', 'is_featured', 'is_urgent'
        ]);
    }

    public function saveJob()
    {
        if ($this->category_id === 'new') {
            $this->validate([
                'new_category_name' => 'required|min:3|max:50',
            ], [
                'new_category_name.required' => 'Nama kategori baru wajib diisi.',
                'new_category_name.min' => 'Nama kategori baru minimal 3 karakter.',
                'new_category_name.max' => 'Nama kategori baru maksimal 50 karakter.',
            ]);

            // Check if exists
            $existing = JobCategory::where('name', 'like', trim($this->new_category_name))->first();
            if ($existing) {
                $this->category_id = $existing->id;
            } else {
                $newCat = JobCategory::create([
                    'name' => trim($this->new_category_name),
                    'slug' => Str::slug($this->new_category_name) . '-' . rand(100, 999),
                    'status' => true,
                ]);
                $this->category_id = $newCat->id;
            }
        }

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
            $newJob = Job::create($data);
            
            // Send email notification to Admin (mauloker.comm@gmail.com)
            try {
                Mail::send([], [], function ($message) use ($newJob) {
                    $message->to('mauloker.comm@gmail.com')
                        ->subject('Lowongan Baru Dipasang: ' . $newJob->title)
                        ->html('
                            <div style="font-family: \'Instrument Sans\', sans-serif; max-width: 600px; margin: 0 auto; padding: 40px 20px; background-color: #f8fafc; border-radius: 24px;">
                                <div style="background-color: #ffffff; padding: 40px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                                    <div style="margin-bottom: 24px;">
                                        <span style="font-size: 24px; font-weight: 900; color: #10b981;">MauLoker Admin</span>
                                    </div>
                                    <h2 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 12px;">Pemberitahuan Lowongan Baru</h2>
                                    <p style="font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 24px;">
                                        Sebuah lowongan pekerjaan baru telah berhasil dipasang di platform MauLoker. Berikut adalah detailnya:
                                    </p>
                                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 24px; font-size: 13px;">
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 700; color: #475569; width: 150px;">Judul Lowongan:</td>
                                            <td style="padding: 8px 0; color: #0f172a;">' . e($newJob->title) . '</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 700; color: #475569;">Perusahaan:</td>
                                            <td style="padding: 8px 0; color: #0f172a;">' . e($newJob->company->name) . '</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 700; color: #475569;">Kota:</td>
                                            <td style="padding: 8px 0; color: #0f172a;">' . e($newJob->city) . '</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 700; color: #475569;">Jenis Kontrak:</td>
                                            <td style="padding: 8px 0; color: #0f172a;">' . e($newJob->employment_type) . '</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; font-weight: 700; color: #475569;">Gaji:</td>
                                            <td style="padding: 8px 0; color: #10b981; font-weight: 700;">Rp ' . number_format($newJob->salary_min, 0, ',', '.') . ' - Rp ' . number_format($newJob->salary_max, 0, ',', '.') . '</td>
                                        </tr>
                                    </table>
                                    <div style="text-align: center; margin-bottom: 32px;">
                                        <a href="' . url('/jobs/' . $newJob->slug) . '" style="display: inline-block; padding: 14px 32px; background-color: #10b981; color: #ffffff; text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 14px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);">
                                            Lihat Lowongan di Situs
                                        </a>
                                    </div>
                                    <p style="font-size: 11px; color: #94a3b8; text-align: center; margin-top: 24px;">
                                        Email ini dikirim otomatis oleh sistem notifikasi MauLoker.
                                    </p>
                                </div>
                            </div>
                        ');
                });
            } catch (\Exception $e) {
                logger()->error('Failed sending new job notification: ' . $e->getMessage());
            }

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

        // Send email to Candidate about status change
        $candidate = $app->candidate;
        $job = $app->job;
        $company = $job->company;
        $candidateUrl = url('/candidate/dashboard');

        $statusLabels = [
            'Applied' => 'Terkirim',
            'Reviewed' => 'Ditinjau HRD',
            'Interview' => 'Wawancara',
            'Accepted' => 'Diterima Kerja',
            'Rejected' => 'Ditolak',
        ];

        $statusLabel = $statusLabels[$newStatus] ?? $newStatus;
        $candidateName = e($candidate->name);
        $jobTitle = e($job->title);
        $companyName = e($company->name);

        try {
            Mail::send([], [], function ($message) use ($candidate, $job, $candidateName, $jobTitle, $companyName, $statusLabel, $candidateUrl) {
                $message->to($candidate->email)
                    ->subject('Pembaruan Status Lamaran: ' . $job->title)
                    ->html(<<<HTML
                        <div style="font-family: 'Instrument Sans', sans-serif; max-width: 600px; margin: 0 auto; padding: 40px 20px; background-color: #f8fafc; border-radius: 24px;">
                            <div style="background-color: #ffffff; padding: 40px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                                <div style="margin-bottom: 24px;">
                                    <span style="font-size: 24px; font-weight: 900; color: #10b981;">MauLoker</span>
                                </div>
                                <h2 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 12px;">Halo {$candidateName}!</h2>
                                <p style="font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 24px;">
                                    Status lamaran Anda untuk posisi <strong>{$jobTitle}</strong> di <strong>{$companyName}</strong> telah diperbarui oleh perekrut menjadi:
                                </p>
                                <div style="background-color: #f1f5f9; padding: 16px; border-radius: 12px; font-weight: 800; font-size: 18px; color: #1e293b; text-align: center; margin-bottom: 24px;">
                                    {$statusLabel}
                                </div>
                                <p style="font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 24px;">
                                    Silakan buka dashboard pencari kerja Anda di platform MauLoker untuk detail proses selanjutnya.
                                </p>
                                <div style="text-align: center; margin-bottom: 32px;">
                                    <a href="{$candidateUrl}" style="display: inline-block; padding: 14px 32px; background-color: #10b981; color: #ffffff; text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 14px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);">
                                        Masuk Dashboard
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
            logger()->error('Failed sending candidate application update email: ' . $e->getMessage());
        }

        session()->flash('success', 'Status lamaran kandidat berhasil diubah!');
    }

    public function toggleApplicantDetails($id)
    {
        if ($this->expandedApplicantId === $id) {
            $this->expandedApplicantId = null;
        } else {
            $this->expandedApplicantId = $id;
        }
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
