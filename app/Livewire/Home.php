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
            ->take(8)
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

        $minSalary = Job::where('status', 'active')->where('salary_min', '>', 0)->min('salary_min') ?? 4000000;
        $maxSalary = Job::where('status', 'active')->where('salary_max', '>', 0)->max('salary_max') ?? 25000000;

        $latestCandidates = User::where('role', 'candidate')
            ->latest()
            ->take(3)
            ->get()
            ->map(function($u) {
                $words = explode(' ', trim($u->name));
                $initials = '';
                foreach ($words as $w) {
                    $initials .= strtoupper(substr($w, 0, 1));
                }
                return $initials ? substr($initials, 0, 2) : 'U';
            })
            ->toArray();

        $settings = Setting::pluck('value', 'key')->all();
        $seoTitle = ($settings['website_name'] ?? 'MauLoker') . ' - ' . ($settings['tagline'] ?? 'Temukan Pekerjaan Impianmu');
        $seoDescription = 'MauLoker adalah platform pencarian kerja Indonesia terdepan. Temukan lowongan kerja terbaru, karir BUMN, Swasta, Magang, dan Remote terverifikasi secara instan.';

        $schemaData = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebSite',
                    '@id' => url('/') . '#website',
                    'url' => url('/'),
                    'name' => ($settings['website_name'] ?? 'MauLoker'),
                    'description' => ($settings['tagline'] ?? 'Temukan Pekerjaan Impianmu'),
                    'potentialAction' => [
                        '@type' => 'SearchAction',
                        'target' => url('/jobs') . '?q={search_term_string}',
                        'query-input' => 'required name=search_term_string'
                    ],
                    'inLanguage' => 'id-ID'
                ],
                [
                    '@type' => 'Organization',
                    '@id' => url('/') . '#organization',
                    'name' => ($settings['website_name'] ?? 'MauLoker'),
                    'url' => url('/'),
                    'logo' => url('/favicon.png')
                ]
            ]
        ];

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
            'minSalary' => $minSalary,
            'maxSalary' => $maxSalary,
            'latestCandidates' => $latestCandidates,
        ])->layout('components.layouts.app', [
            'seoTitle' => $seoTitle,
            'seoDescription' => $seoDescription,
            'schemaData' => $schemaData
        ]);
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
