<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Provider;
use App\Models\Source;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Source::query()->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $sources = [
            ['name' => 'The Wall Street Journal', 'provider' => 'NewsAPI.org', 'categories' => ['business']],
            ['name' => 'BBC News', 'provider' => 'NewsAPI.org', 'categories' => ['world']],
            ['name' => 'Buzzfeed', 'provider' => 'NewsAPI.org', 'categories' => ['entertainment']],
            ['name' => 'Medical News Today', 'provider' => 'NewsAPI.org', 'categories' => ['health']],
            ['name' => 'National Geographic', 'provider' => 'NewsAPI.org', 'categories' => ['science']],
            ['name' => 'Fox Sports', 'provider' => 'NewsAPI.org', 'categories' => ['sports']],
            ['name' => 'Crypto Coins News', 'provider' => 'NewsAPI.org', 'categories' => ['technology']],
            ['name' => 'Crypto Coins News', 'provider' => 'NewsAPI.org', 'categories' => ['technology']],
            ['name' => 'The New York Times', 'provider' => 'New York Times', 'categories' => ['books', 'world', 'crosswords', 'opinion', 'arts', 'magazine', 'podcasts', 'money', 'us news', 'new york', 'movies', 'health', 'science', 'technology', 'climate', 'briefing']],
            ['name' => 'The Guardian', 'provider' => 'The Guardian', 'categories' => ['travel', 'culture', 'fashion', 'the one', 'news', 'law', 'politics', 'society', 'football', 'life and style', 'global development', 'australia news', 'environment', 'media', 'games', 'us news', 'food', 'music', 'television & radio', 'smarter than a smart tv', 'uk news', 'stage', 'sports', 'business', 'opinion', 'arts', 'science', 'technology']],
        ];

        $providers = Provider::all();
        $categories = Category::all();

        foreach ($sources as $source) {
            $provider = $providers->where('name', $source['provider'])->first();

            $sourceObj = Source::create([
                'provider_id' => $provider->id,
                'name' => $source['name']
            ]);

            $categoriesIds = array_filter($categories->toArray(), fn($item) => in_array($item['name'], $source['categories']));
            $categoriesIds = array_column($categoriesIds, 'id');
            $sourceObj->categories()->attach($categoriesIds);
        }
    }
}
