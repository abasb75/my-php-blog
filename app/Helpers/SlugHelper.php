<?php

namespace App\Helpers;

class SlugHelper
{
    public static function createSlug($title)
    {
        $title = str_replace(" ", "-", $title);
        $title = preg_replace("#[\-]+#", "-", $title);
        return $title;
    }

    public static function makeUniqueSlug($title, $modelClass = \App\Models\Post::class, $id = null)
    {
        $slug = self::createSlug($title);
        $originalSlug = $slug;
        $counter = 1;

        // بررسی یکتایی slug
        while ($modelClass::where('slug', $slug)->when($id, fn($query) => $query->where('id', '!=', $id))->exists()) {
            // حذف یک کاراکتر از انتهای slug تا یکتا شود
            $slug = rtrim($originalSlug, mb_substr($originalSlug, -1)) . ($counter > 1 ? '-' . $counter : '');
            $counter++;
        }

        return $slug;
    }
}