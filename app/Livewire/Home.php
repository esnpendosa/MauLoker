<?php

namespace App\Livewire;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\CareerRoadmap;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\SalaryInsight;
use App\Models\Setting;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $searchQuery = '';
    public $searchLocation = '';
    public $searchCategory = '';

    public function search()
    {
        return redirect()->route('jobs.search', [
            'q' => $this->searchQuery,
            'loc' => $this->searchLocation,
            'cat' => $this->searchCategory
        ]);
    }

    public function render()
    {
        $banners = Banner::where('position', 'homepage_hero')->where('status', true)->get();
        
        $stats = [
            'jobs' => Job::where('status', 'active')->count(),
            'companies' => Company::where('status', 'active')->count(),
            'candidates' => User::where('role', 'candidate')->count(),
            'applications' => ApplicationSentCount(), // Helper function or simple query
        ];

        $featuredJobs = Job::with('company', 'category')
            ->where('status', 'active')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        $latestJobs = Job::with('company', 'category')
            ->where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        $featuredCompanies = Company::where('status', 'active')
            ->where('top_employer', true)
            ->latest()
            ->take(6)
            ->get();

        $categories = JobCategory::where('status', true)->take(8)->get();
        $salaryInsights = SalaryInsight::take(4)->get();
        $roadmaps = CareerRoadmap::take(4)->get();
        
        $blogs = Blog::with('category')
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        // Load Inline Content Ad
        $middleAd = \App\Models\Ad::where('position_code', 'homepage_middle')
            ->where('status', true)
            ->first();

        return view('livewire.home', [
            'banners' => $banners,
            'stats' => $stats,
            'featuredJobs' => $featuredJobs,
            'latestJobs' => $latestJobs,
            'featuredCompanies' => $featuredCompanies,
            'categories' => $categories,
            'salaryInsights' => $salaryInsights,
            'roadmaps' => $roadmaps,
            'blogs' => $blogs,
            'middleAd' => $middleAd,
        ])->layout('components.layouts.app');
    }
}

// Simple helper inside namespace if not loaded elsewhere
function ApplicationSentCount() {
    try {
        return \App\Models\Application::count();
    } catch (\Exception $e) {
        return 0;
    }
}
