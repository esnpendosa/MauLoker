<?php

use App\Livewire\Home;
use App\Livewire\JobSearch;
use App\Livewire\JobDetail;
use App\Livewire\Blog;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Candidate\Dashboard as CandidateDashboard;
use App\Livewire\Company\Dashboard as CompanyDashboard;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Chat;
use App\Livewire\LegalPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Front-end Routes
Route::get('/', Home::class)->name('home');
Route::get('/offline', function() { return view('offline'); })->name('offline');
Route::get('/jobs', JobSearch::class)->name('jobs.search');
Route::get('/jobs/{job_slug}', JobDetail::class)->name('jobs.detail');

// Public Content Routes
Route::get('/blog', Blog::class)->name('blog');
Route::get('/blog/{slug}', Blog::class)->name('blog.detail');

// Public Legal Policy Routes
Route::get('/user-agreement', LegalPage::class)->defaults('type', 'user-agreement')->name('user-agreement');
Route::get('/privacy-policy', LegalPage::class)->defaults('type', 'privacy-policy')->name('privacy-policy');
Route::get('/terms-of-service', LegalPage::class)->defaults('type', 'terms-of-service')->name('terms-of-service');
Route::get('/disclaimer', LegalPage::class)->defaults('type', 'disclaimer')->name('disclaimer');
Route::get('/anti-fraud', LegalPage::class)->defaults('type', 'anti-fraud')->name('anti-fraud');
Route::get('/community-guidelines', LegalPage::class)->defaults('type', 'community-guidelines')->name('community-guidelines');

// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboards
    Route::get('/candidate/dashboard', CandidateDashboard::class)->name('candidate.dashboard');
    Route::get('/company/dashboard', CompanyDashboard::class)->name('company.dashboard');
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');

    // Real-time Chat
    Route::get('/messages', Chat::class)->name('messages');

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

// Dynamic XML Sitemap for SEO
Route::get('/sitemap.xml', function() {
    $jobs = \App\Models\Job::where('status', 'active')->latest()->get();
    $blogs = \App\Models\Blog::where('status', 'published')->latest()->get();
    
    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
    // Static URLs
    $xml .= '<url><loc>' . url('/') . '</loc><changefreq>daily</changefreq><priority>1.0</priority></url>';
    $xml .= '<url><loc>' . url('/jobs') . '</loc><changefreq>hourly</changefreq><priority>0.9</priority></url>';
    $xml .= '<url><loc>' . url('/blog') . '</loc><changefreq>daily</changefreq><priority>0.8</priority></url>';
    
    // Dynamic Jobs
    foreach ($jobs as $job) {
        $xml .= '<url>';
        $xml .= '<loc>' . route('jobs.detail', $job->slug) . '</loc>';
        $xml .= '<lastmod>' . ($job->updated_at ? $job->updated_at->toAtomString() : $job->created_at->toAtomString()) . '</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.8</priority>';
        $xml .= '</url>';
    }
    
    // Dynamic Blogs
    foreach ($blogs as $blog) {
        $xml .= '<url>';
        $xml .= '<loc>' . route('blog.detail', $blog->slug) . '</loc>';
        $xml .= '<lastmod>' . ($blog->updated_at ? $blog->updated_at->toAtomString() : $blog->created_at->toAtomString()) . '</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.7</priority>';
        $xml .= '</url>';
    }
    
    $xml .= '</urlset>';
    
    return response($xml, 200, [
        'Content-Type' => 'application/xml'
    ]);
});

