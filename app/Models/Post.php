<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use DOMDocument;

class Post extends Model
{
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

    /**
     * محاسبه زمان مطالعه بر اساس محتوای body
     *
     * @param string $content
     * @return int زمان مطالعه به دقیقه
     */
    protected function calculateReadingTime($content): int
    {
        // تبدیل HTML به متن ساده
        $cleanContent = strip_tags($content);
        // شمارش کلمات
        $wordCount = str_word_count($cleanContent);
        // محاسبه زمان مطالعه با فرض 180 کلمه در دقیقه (برای فارسی)
        return (int) ceil($wordCount / 150);
    }

    /**
     * تنظیم ویژگی sandbox برای تمام تگ‌های iframe در محتوای body
     *
     * @param string $content
     * @return string محتوای اصلاح‌شده
     */
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
        });

        static::updating( function ($post) {
            if ($post->isDirty('title') || !$post->slug) {
                $post->slug = SlugHelper::makeUniqueSlug($post->title, self::class, $post->id);
            }

            if ($post->isDirty('body')) {
                $post->body = $post->setIframeSandbox($post->body);
            }

            if ($post->isDirty('body') || $post->reading_time === 0) {
                $post->reading_time = $post->calculateReadingTime($post->body);
            }
        });
    }
}