<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'reading_time', // اضافه کردن به fillable
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
        $wordCount = str_word_count(string: $cleanContent);
        // محاسبه زمان مطالعه با فرض 180 کلمه در دقیقه (برای فارسی)
        return (int) ceil($wordCount / 150);
    }

    protected static function boot()
    {
        parent::boot();

        // هنگام ایجاد پست
        static::creating(function ($post) {
            // تنظیم slug
            $post->slug = SlugHelper::makeUniqueSlug($post->title);
            // محاسبه reading_time
            $post->reading_time = $post->calculateReadingTime($post->body);
        });

        // هنگام ویرایش پست
        static::updating(function ($post) {
            // تنظیم slug اگر title تغییر کرده یا slug خالی است
            if ($post->isDirty('title') || !$post->slug) {
                $post->slug = SlugHelper::makeUniqueSlug($post->title, self::class, $post->id);
            }

            // محاسبه reading_time اگر body تغییر کرده یا reading_time صفر است
            if ($post->isDirty('body') || $post->reading_time === 0) {
                $post->reading_time = $post->calculateReadingTime($post->body);
            }
        });
    }
}