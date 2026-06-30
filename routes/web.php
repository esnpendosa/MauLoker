<?php

use App\Livewire\Home;
use App\Livewire\JobSearch;
use App\Livewire\JobDetail;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Candidate\Dashboard as CandidateDashboard;
use App\Livewire\Company\Dashboard as CompanyDashboard;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Chat;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Front-end Routes
Route::get('/', Home::class)->name('home');
Route::get('/offline', function() { return view('offline'); })->name('offline');
Route::get('/jobs', JobSearch::class)->name('jobs.search');
Route::get('/jobs/{job_slug}', JobDetail::class)->name('jobs.detail');

// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
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
