<?php

namespace App\Livewire\Admin;

use App\Models\Ad;
use App\Models\Company;
use App\Models\Job;
use App\Models\Theme;
use App\Models\User;
use App\Models\Setting;
use Livewire\Component;

class Dashboard extends Component
{
    public $activeTab = 'users'; // users, companies, jobs, ads, themes, settings

    // Theme editing properties
    public $themeId;
    public $primary_color = '';
    public $primary_hover = '';
    public $primary_dark = '';
    public $light_bg = '';
    public $light_card = '';
    public $dark_bg = '';
    public $dark_card = '';
    public $text_light = '';
    public $text_dark = '';
    public $border_radius = '';

    // Ad management properties
    public $adId = null;
    public $adName = '';
    public $position_code = '';
    public $format_type = 'html'; // html, google_adsense
    public $code_content = '';
    public $showAdModal = false;

    // Site settings properties
    public $siteName = '';
    public $siteTagline = '';
    public $contactWhatsapp = '';
    public $contactEmail = '';

    public function mount()
    {
        // Load active theme
        $theme = Theme::where('is_active', true)->first();
        if ($theme) {
            $this->themeId = $theme->id;
            $this->primary_color = $theme->primary_color;
            $this->primary_hover = $theme->primary_hover;
            $this->primary_dark = $theme->primary_dark;
            $this->light_bg = $theme->light_bg;
            $this->light_card = $theme->light_card;
            $this->dark_bg = $theme->dark_bg;
            $this->dark_card = $theme->dark_card;
            $this->text_light = $theme->text_light;
            $this->text_dark = $theme->text_dark;
            $this->border_radius = $theme->border_radius;
        }

        // Load Settings
        $settings = Setting::pluck('value', 'key')->all();
        $this->siteName = $settings['website_name'] ?? '';
        $this->siteTagline = $settings['tagline'] ?? '';
        $this->contactWhatsapp = $settings['contact_whatsapp'] ?? '';
        $this->contactEmail = $settings['contact_email'] ?? '';
    }

    public function toggleCompanyVerification($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['verified' => !$company->verified]);
        session()->flash('success', 'Status verifikasi perusahaan ' . $company->name . ' berhasil diperbarui!');
    }

    public function toggleJobFeature($id)
    {
        $job = Job::findOrFail($id);
        $job->update(['is_featured' => !$job->is_featured]);
        session()->flash('success', 'Status rekomendasi pekerjaan ' . $job->title . ' berhasil diperbarui!');
    }

    public function openCreateAd()
    {
        $this->resetAdForm();
        $this->showAdModal = true;
    }

    public function resetAdForm()
    {
        $this->reset(['adId', 'adName', 'position_code', 'format_type', 'code_content']);
    }

    public function saveAd()
    {
        $this->validate([
            'adName' => 'required',
            'position_code' => 'required',
            'code_content' => 'required',
        ]);

        $data = [
            'name' => $this->adName,
            'position_code' => $this->position_code,
            'format_type' => $this->format_type,
            'code_content' => $this->code_content,
            'status' => true,
        ];

        if ($this->adId) {
            $ad = Ad::findOrFail($this->adId);
            $ad->update($data);
            session()->flash('success', 'Iklan berhasil diperbarui!');
        } else {
            Ad::create($data);
            session()->flash('success', 'Iklan baru berhasil dipasang!');
        }

        $this->showAdModal = false;
        $this->resetAdForm();
    }

    public function saveTheme()
    {
        $theme = Theme::findOrFail($this->themeId);
        $theme->update([
            'primary_color' => $this->primary_color,
            'primary_hover' => $this->primary_hover,
            'primary_dark' => $this->primary_dark,
            'light_bg' => $this->light_bg,
            'light_card' => $this->light_card,
            'dark_bg' => $this->dark_bg,
            'dark_card' => $this->dark_card,
            'text_light' => $this->text_light,
            'text_dark' => $this->text_dark,
            'border_radius' => $this->border_radius,
        ]);

        session()->flash('success', 'Skema warna tema aktif berhasil disimpan!');
    }

    public function saveSettings()
    {
        Setting::where('key', 'website_name')->update(['value' => $this->siteName]);
        Setting::where('key', 'tagline')->update(['value' => $this->siteTagline]);
        Setting::where('key', 'contact_whatsapp')->update(['value' => $this->contactWhatsapp]);
        Setting::where('key', 'contact_email')->update(['value' => $this->contactEmail]);

        session()->flash('success', 'Pengaturan sistem website berhasil disimpan!');
    }

    public function render()
    {
        $users = User::latest()->get();
        $companies = Company::latest()->get();
        $jobs = Job::with('company')->latest()->get();
        $ads = Ad::latest()->get();
        $adPositions = \App\Models\AdPosition::all();

        return view('livewire.admin.dashboard', [
            'users' => $users,
            'companies' => $companies,
            'jobs' => $jobs,
            'ads' => $ads,
            'adPositions' => $adPositions
        ])->layout('components.layouts.app', [
            'seoTitle' => 'Admin Panel Control - MauLoker',
            'seoDescription' => 'Panel administrator untuk memantau pengguna, lowongan kerja, verifikasi perusahaan, dan skema tema.'
        ]);
    }
}
