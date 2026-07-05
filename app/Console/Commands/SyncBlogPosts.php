<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

#[Signature('blog:sync')]
#[Description('Sync/import career blog posts from external RSS feeds automatically')]
class SyncBlogPosts extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting blog synchronization...');

        $feeds = [
            'https://www.antaranews.com/rss/ekonomi.xml',
        ];

        $syncedCount = 0;

        foreach ($feeds as $url) {
            $this->info("Fetching feed: {$url}");
            try {
                $response = Http::timeout(15)->get($url);
                if ($response->failed()) {
                    $this->warn("Failed to fetch {$url}. Status: " . $response->status());
                    continue;
                }

                libxml_use_internal_errors(true);
                $xml = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
                if (!$xml) {
                    $this->warn("Failed to parse XML from {$url}");
                    continue;
                }

                $items = $xml->channel->item ?? [];
                foreach ($items as $item) {
                    $title = trim((string) $item->title);
                    $link = trim((string) $item->link);

                    if (empty($title)) {
                        continue;
                    }

                    // Check if already exists by title or slug
                    $slug = Str::slug($title);
                    if (Blog::where('title', $title)->orWhere('slug', $slug)->exists()) {
                        continue;
                    }

                    // Get content
                    $namespaces = $item->getNamespaces(true);
                    $content = '';
                    if (isset($namespaces['content'])) {
                        $content = (string) $item->children($namespaces['content'])->encoded;
                    }
                    if (empty($content)) {
                        $content = (string) $item->description;
                    }

                    // Fallback content if empty
                    if (empty($content)) {
                        $content = "Artikel selengkapnya mengenai \"{$title}\" dapat dibaca melalui sumber resmi di <a href=\"{$link}\" target=\"_blank\" rel=\"noopener\" class=\"text-primary hover:underline\">Antara News</a>.";
                    } else {
                        // Append original source link for copyright and SEO respect
                        $content .= "<br><br><hr class=\"my-4 border-slate-200 dark:border-slate-800\"><em class=\"text-xs text-slate-500\">Artikel asli telah tayang di Antara News dengan judul <a href=\"{$link}\" target=\"_blank\" rel=\"noopener\" class=\"text-primary hover:underline\">{$title}</a>.</em>";
                    }

                    // Determine Category
                    $categoryId = $this->determineCategory($title, $content);

                    // Determine Tags
                    $tags = $this->generateTags($title);

                    // Create Blog
                    Blog::create([
                        'title' => $title,
                        'slug' => $slug,
                        'content' => $content,
                        'category_id' => $categoryId,
                        'tags' => $tags,
                        'seo_title' => Str::limit($title, 60),
                        'seo_description' => Str::limit(strip_tags($content), 150),
                        'view_count' => rand(10, 150), // seed with initial views
                        'status' => 'published',
                        'is_featured' => false
                    ]);

                    $syncedCount++;
                    $this->line("Synced: {$title}");
                }
            } catch (\Exception $e) {
                $this->error("Error syncing feed {$url}: " . $e->getMessage());
            }
        }

        $this->info("Synchronization finished! Total new articles synced: {$syncedCount}");
    }

    /**
     * Determine category based on keywords
     */
    private function determineCategory(string $title, string $content): int
    {
        $text = strtolower($title . ' ' . $content);

        // Category 2: CV & Resume
        if (Str::contains($text, ['cv', 'resume', 'portofolio', 'curriculum vitae', 'lamaran'])) {
            return 2;
        }

        // Category 3: Persiapan Wawancara
        if (Str::contains($text, ['wawancara', 'interview', 'hrd', 'tanya jawab', 'pertanyaan hrd', 'negosiasi gaji'])) {
            return 3;
        }

        // Default: Tips Karir (id: 1)
        return 1;
    }

    /**
     * Generate tags based on title
     */
    private function generateTags(string $title): string
    {
        $tags = ['tips karir', 'dunia kerja', 'info karir'];
        
        $titleLower = strtolower($title);
        if (Str::contains($titleLower, 'investasi')) {
            $tags[] = 'investasi';
        }
        if (Str::contains($titleLower, 'keuangan')) {
            $tags[] = 'keuangan';
        }
        if (Str::contains($titleLower, 'tips')) {
            $tags[] = 'tips';
        }
        if (Str::contains($titleLower, 'emas')) {
            $tags[] = 'investasi emas';
        }
        if (Str::contains($titleLower, 'rupiah')) {
            $tags[] = 'rupiah';
        }

        return implode(', ', array_unique($tags));
    }
}
