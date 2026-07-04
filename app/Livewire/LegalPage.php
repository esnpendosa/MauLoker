<?php

namespace App\Livewire;

use Livewire\Component;

class LegalPage extends Component
{
    public $type; // 'user-agreement', 'privacy-policy', 'terms-of-service'

    public function mount($type)
    {
        $validTypes = ['user-agreement', 'privacy-policy', 'terms-of-service'];
        if (!in_array($type, $validTypes)) {
            abort(404);
        }
        $this->type = $type;
    }

    public function render()
    {
        $titles = [
            'user-agreement' => 'Persetujuan Pengguna (User Agreement) - MauLoker',
            'privacy-policy' => 'Kebijakan Privasi (Privacy Policy) - MauLoker',
            'terms-of-service' => 'Ketentuan Layanan Standar (Standard Terms of Service) - MauLoker',
        ];

        $descriptions = [
            'user-agreement' => 'Persetujuan Pengguna dan Syarat Penggunaan platform pencarian kerja MauLoker bagi pelamar dan pemberi kerja.',
            'privacy-policy' => 'Kebijakan Privasi MauLoker menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi data pribadi Anda.',
            'terms-of-service' => 'Ketentuan Layanan Standar MauLoker untuk penggunaan produk, layanan berlangganan, dan pemuatan iklan lowongan.',
        ];

        // Dynamic Schema.org data for legal page
        $schemaData = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $titles[$this->type],
            'description' => $descriptions[$this->type],
            'url' => url()->current(),
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'MauLoker',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => url('/favicon.png')
                ]
            ]
        ];

        return view('livewire.legal-page')
            ->layout('components.layouts.app', [
                'seoTitle' => $titles[$this->type],
                'seoDescription' => $descriptions[$this->type],
                'schemaData' => $schemaData
            ]);
    }
}
