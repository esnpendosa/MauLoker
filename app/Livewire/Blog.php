<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Blog as BlogModel;
use App\Models\BlogCategory;

class Blog extends Component
{
    public string $search = '';
    public string $activeCategory = 'semua';
    public ?string $slug = null;
    public ?BlogModel $article = null;

    public function mount(?string $slug = null)
    {
        $this->slug = $slug;
        if ($this->slug) {
            $this->article = BlogModel::with('category')->where('slug', $this->slug)->where('status', 'published')->first();
            if (!$this->article) {
                abort(404);
            }
            $this->article->increment('view_count');
        }
    }

    public function render()
    {
        if ($this->slug && $this->article) {
            $wordCount = str_word_count(strip_tags($this->article->content));
            $readMinutes = max(1, ceil($wordCount / 200));
            $tagsArray = array_filter(array_map('trim', explode(',', $this->article->tags)));

            $articleData = [
                'id' => $this->article->id,
                'slug' => $this->article->slug,
                'title' => $this->article->title,
                'content' => $this->article->content,
                'category_label' => $this->article->category ? $this->article->category->name : 'Tips Karir',
                'author' => 'Tim Redaksi MauLoker',
                'author_role' => 'Spesialis Karir',
                'date' => $this->article->created_at->format('d M Y'),
                'read_time' => $readMinutes . ' menit',
                'tags' => $tagsArray,
                'views' => $this->article->view_count,
            ];

            // Get some related articles
            $relatedRaw = BlogModel::with('category')
                ->where('status', 'published')
                ->where('id', '!=', $this->article->id)
                ->where('category_id', $this->article->category_id)
                ->limit(3)
                ->get();

            $relatedArticles = $relatedRaw->map(function ($article) {
                $wordCount = str_word_count(strip_tags($article->content));
                $readMinutes = max(1, ceil($wordCount / 200));
                return [
                    'slug' => $article->slug,
                    'title' => $article->title,
                    'category_label' => $article->category ? $article->category->name : 'Tips Karir',
                    'excerpt' => Str_Limit_Helper(strip_tags($article->content), 120),
                    'date' => $article->created_at->format('d M Y'),
                    'read_time' => $readMinutes . ' menit',
                ];
            })->toArray();

            $schemaData = [
                '@context' => 'https://schema.org',
                '@type' => 'BlogPosting',
                'headline' => $this->article->title,
                'description' => Str_Limit_Helper(strip_tags($this->article->content), 150),
                'datePublished' => $this->article->created_at ? $this->article->created_at->toIso8601String() : now()->toIso8601String(),
                'dateModified' => $this->article->updated_at ? $this->article->updated_at->toIso8601String() : now()->toIso8601String(),
                'author' => [
                    '@type' => 'Person',
                    'name' => 'Tim Redaksi MauLoker'
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'MauLoker',
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => url('/favicon.png')
                    ]
                ],
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => url()->current()
                ]
            ];

            return view('livewire.blog', [
                'articleDetail' => $articleData,
                'relatedArticles' => $relatedArticles,
                'isDetail' => true,
            ])->layout('components.layouts.app', [
                'seoTitle' => $this->article->title . ' - MauLoker',
                'seoDescription' => Str_Limit_Helper(strip_tags($this->article->content), 150),
                'schemaData' => $schemaData
            ]);
        }

        $query = BlogModel::with('category')->where('status', 'published');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%')
                  ->orWhere('tags', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->activeCategory !== 'semua') {
            $query->whereHas('category', function($q) {
                $q->where('slug', $this->activeCategory);
            });
        }

        $articlesRaw = $query->latest()->get();

        // Map to structure matching view requirements
        $articles = $articlesRaw->map(function ($article) {
            $wordCount = str_word_count(strip_tags($article->content));
            $readMinutes = max(1, ceil($wordCount / 200));

            // Parse tags
            $tagsArray = array_filter(array_map('trim', explode(',', $article->tags)));

            return [
                'id' => $article->id,
                'slug' => $article->slug,
                'title' => $article->title,
                'category' => $article->category ? $article->category->slug : 'tips-karir',
                'category_label' => $article->category ? $article->category->name : 'Tips Karir',
                'excerpt' => Str_Limit_Helper(strip_tags($article->content), 160),
                'author' => 'Tim Redaksi MauLoker',
                'author_role' => 'Spesialis Karir',
                'date' => $article->created_at->format('d M Y'),
                'read_time' => $readMinutes . ' menit',
                'tags' => $tagsArray,
                'featured' => $article->is_featured,
            ];
        })->toArray();

        // Get actual categories from database to make the category filter dynamic!
        $dbCategories = BlogCategory::all();
        $categoriesList = ['semua' => 'Semua Artikel'];
        foreach ($dbCategories as $cat) {
            $categoriesList[$cat->slug] = $cat->name;
        }

        $schemaData = [
            '@context' => 'https://schema.org',
            '@type' => 'Blog',
            'name' => 'Tips Karir & Berita Dunia Kerja - MauLoker',
            'description' => 'Temukan tips melamar kerja, cara membuat CV ATS, persiapan wawancara, dan informasi karir terbaru dari redaksi MauLoker.',
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'MauLoker',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => url('/favicon.png')
                ]
            ],
            'blogPost' => []
        ];
        foreach ($articlesRaw->take(10) as $art) {
            $schemaData['blogPost'][] = [
                '@type' => 'BlogPosting',
                'headline' => $art->title,
                'url' => route('blog.detail', $art->slug)
            ];
        }

        return view('livewire.blog', [
            'articles' => $articles,
            'categories' => $categoriesList,
            'isDetail' => false,
        ])->layout('components.layouts.app', [
            'seoTitle' => 'Tips Karir & Berita Dunia Kerja Terbaru - MauLoker',
            'seoDescription' => 'Temukan tips melamar kerja, cara membuat CV ATS, persiapan wawancara, dan informasi karir terbaru dari redaksi MauLoker.',
            'schemaData' => $schemaData
        ]);
    }
}

// Simple local helper to limit text without depending on helper package
function Str_Limit_Helper($value, $limit = 100, $end = '...') {
    if (mb_strwidth($value, 'UTF-8') <= $limit) {
        return $value;
    }
    return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
}
