<?php

use App\Models\Source;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

if (!function_exists('authUser')) {
    function authUser()
    {
        return \Auth()->guard('web')->check() ? \Auth()->guard('web')->user() : \Auth()->guard('sanctum')->user();
    }
}

if (!function_exists('getCacheTTL')) {
    function getCacheTTL(): float|int
    {
        return 24 * 60 * 60;
    }
}

if (!function_exists('newsSources')) {
    function newsSources()
    {
        return Cache::remember('news_sources', getCacheTTL(), fn() => Source::with('categories')->get()->toArray());
    }
}

if (!function_exists('sleepToExceedTheRateLimiter')) {
    function sleepToExceedTheRateLimiter(int $milliseconds): void
    {
        sleep($milliseconds);
    }
}
