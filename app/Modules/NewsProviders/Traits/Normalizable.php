<?php

namespace App\Modules\NewsProviders\Traits;

use Illuminate\Support\Str;

trait Normalizable
{
    public function categoryNormalization(?string $category): string
    {
        return match ($category) {
            'general' => 'world',
            'u.s.' => 'us news',
            'crosswords & games' => 'crosswords',
            'your money' => 'money',
            'World news' => 'world',
            'Sport' => 'sports',
            'Film' => 'movies',
            'Art and design' => 'arts',
            null => '-',
            default => Str::lower($category),
        };
    }
}
