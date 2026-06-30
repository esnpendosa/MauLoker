<?php

namespace App\Livewire;

use App\Models\Job;
use App\Models\JobCategory;
use Livewire\Component;
use Livewire\WithPagination;

class JobSearch extends Component
{
    use WithPagination;

    // Filters
    public $q = '';
    public $loc = '';
    public $cat = '';
    public $type = '';
    public $exp = '';
    public $edu = '';
    public $locationType = ''; // Remote, Onsite, Hybrid
    public $min_salary = '';
    public $sort = 'newest'; // newest, highest_salary, most_applied

    protected $queryString = [
        'q' => ['except' => ''],
        'loc' => ['except' => ''],
        'cat' => ['except' => ''],
        'type' => ['except' => ''],
        'exp' => ['except' => ''],
        'edu' => ['except' => ''],
        'locationType' => ['except' => ''],
        'min_salary' => ['except' => ''],
        'sort' => ['except' => 'newest'],
    ];

    public function updating()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['q', 'loc', 'cat', 'type', 'exp', 'edu', 'locationType', 'min_salary', 'sort']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Job::with('company', 'category')->where('status', 'active');

        // Apply filters
        if (!empty($this->q)) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->q . '%')
                  ->orWhere('description', 'like', '%' . $this->q . '%')
                  ->orWhere('skills', 'like', '%' . $this->q . '%');
            });
        }

        if (!empty($this->loc)) {
            $query->where('city', 'like', '%' . $this->loc . '%');
        }

        if (!empty($this->cat)) {
            $query->whereHas('category', function($q) {
                $q->where('slug', $this->cat);
            });
        }

        if (!empty($this->type)) {
            $query->where('employment_type', $this->type);
        }

        if (!empty($this->locationType)) {
            $query->where('location_type', $this->locationType);
        }

        if (!empty($this->exp)) {
            if ($this->exp === 'entry') {
                $query->where('experience_years', '<=', 1);
            } elseif ($this->exp === 'mid') {
                $query->whereBetween('experience_years', [2, 4]);
            } elseif ($this->exp === 'senior') {
                $query->where('experience_years', '>=', 5);
            }
        }

        if (!empty($this->edu)) {
            $query->where('education_level', 'like', '%' . $this->edu . '%');
        }

        if (!empty($this->min_salary)) {
            $query->where('salary_max', '>=', intval($this->min_salary));
        }

        // Apply sorting
        if ($this->sort === 'highest_salary') {
            $query->orderByRaw('COALESCE(salary_max, 0) DESC');
        } elseif ($this->sort === 'most_applied') {
            $query->orderBy('applies_count', 'DESC');
        } else {
            $query->orderBy('created_at', 'DESC');
        }

        $jobs = $query->paginate(10);
        $categories = JobCategory::where('status', true)->get();

        // Load Ads
        $sidebarAd = \App\Models\Ad::where('position_code', 'job_search_sidebar')
            ->where('status', true)
            ->first();
        
        $topAd = \App\Models\Ad::where('position_code', 'job_search_top')
            ->where('status', true)
            ->first();

        // Dynamic SEO meta
        $seoTitle = 'Pencarian Lowongan Kerja Terbaru - MauLoker';
        $seoDescription = 'Cari dan dapatkan lowongan kerja idaman Anda dari berbagai wilayah Indonesia di platform MauLoker.';
        if (!empty($this->q)) {
            $seoTitle = 'Lowongan Kerja ' . $this->q . ' Terbaru - MauLoker';
            $seoDescription = 'Temukan lowongan kerja ' . $this->q . ' di Indonesia. Filter gaji, remote/onsite, dan pengalaman kerja.';
        }

        return view('livewire.job-search', [
            'jobs' => $jobs,
            'categories' => $categories,
            'sidebarAd' => $sidebarAd,
            'topAd' => $topAd
        ])->layout('components.layouts.app', [
            'seoTitle' => $seoTitle,
            'seoDescription' => $seoDescription
        ]);
    }
}
