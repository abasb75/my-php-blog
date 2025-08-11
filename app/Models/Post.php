<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Morilog\Jalali\Jalalian;
use DOMDocument;
use Illuminate\Support\Facades\File;

class Post extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'body',
        'image',
        'publish_status',
        'slug',
        'reading_time',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function getCreatedAtShamsiAttribute(): string
    {
        return $this->created_at
            ? Jalalian::fromDateTime($this->created_at)->format('d F Y')
            : 'تاریخ موجود نیست';
    }

    protected function calculateReadingTime($content): int
    {
        $cleanContent = strip_tags($content);
        $wordCount = str_word_count($cleanContent);
        return (int) ceil($wordCount / 150);
    }

    protected function setIframeSandbox($content): string
    {
        if (empty($content)) {
            return $content;
        }

        $doc = new DOMDocument();
        @$doc->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $iframes = $doc->getElementsByTagName('iframe');

        foreach ($iframes as $iframe) {
            $iframe->setAttribute('sandbox', 'allow-scripts allow-same-origin');
        }

        $html = '';
        foreach ($doc->childNodes as $node) {
            $html .= $doc->saveHTML($node);
        }

        return $html;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = SlugHelper::makeUniqueSlug($post->title);
            $post->body = $post->setIframeSandbox($post->body);
            $post->reading_time = $post->calculateReadingTime($post->body);

            // حذف کش‌های مربوط به لیست پست‌ها
            static::clearBlogListCache();
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') || !$post->slug) {
                $post->slug = SlugHelper::makeUniqueSlug($post->title, self::class, $post->id);
            }

            if ($post->isDirty('body')) {
                $post->body = $post->setIframeSandbox($post->body);
            }

            if ($post->isDirty('body') || $post->reading_time === 0) {
                $post->reading_time = $post->calculateReadingTime($post->body);
            }

            // حذف کش‌های مربوط به پست خاص و لیست پست‌ها
            static::clearPostCache($post->id);
            static::clearBlogListCache();
            
        });

        static::deleting(function ($post) {
            static::clearPostCache($post->id);
            static::clearBlogListCache();
        });
    }

    /**
     * حذف کش‌های مربوط به لیست پست‌ها (blog و posts)
     */
    protected static function clearBlogListCache()
    {
        $cacheDir = storage_path('app/cache/pages');
        $routes = ['home', 'blog', 'posts', 'blog.paginated', 'posts.paginated'];

        foreach ($routes as $route) {
            $files = File::glob("{$cacheDir}/{$route}*");

            foreach ($files as $file) {
                // فقط فایل‌هایی که شامل id= یا slug= نیستند حذف شوند
                if (!preg_match('/(id=|slug=)/', $file)) {
                    File::delete($file);
                }
            }
        }
    }

    /**
     * حذف کش‌های مربوط به یک پست خاص
     *
     * @param int $postId
     */
    protected static function clearPostCache($postId)
    {
        $cacheDir = storage_path('app/cache/pages');
        $routes = ['blog.single', 'blog.slug', 'posts.single', 'posts.slug', 'post', 'post.slug', 'post.short'];

        foreach ($routes as $route) {
            $files = File::glob("{$cacheDir}/{$route}?*id={$postId}*");
            foreach ($files as $file) {
                File::delete($file);
            }
        }
    }
}