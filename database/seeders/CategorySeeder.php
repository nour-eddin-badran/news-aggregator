<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Category::query()->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $categories = [
            ['name' => 'business'],
            ['name' => 'books'],
            ['name' => 'world'],
            ['name' => 'crosswords'],
            ['name' => 'opinion'],
            ['name' => 'arts'],
            ['name' => 'magazine'],
            ['name' => 'podcasts'],
            ['name' => 'money'],
            ['name' => 'new york'],
            ['name' => 'movies'],
            ['name' => 'health'],
            ['name' => 'science'],
            ['name' => 'technology'],
            ['name' => 'climate'],
            ['name' => 'briefing'],
            ['name' => 'sports'],
            ['name' => 'entertainment'],
            ['name' => 'stage'],
            ['name' => 'uk news'],
            ['name' => 'smarter than a smart tv'],
            ['name' => 'television & radio'],
            ['name' => 'music'],
            ['name' => 'food'],
            ['name' => 'us news'],
            ['name' => 'games'],
            ['name' => 'media'],
            ['name' => 'environment'],
            ['name' => 'australia news'],
            ['name' => 'global development'],
            ['name' => 'life and style'],
            ['name' => 'football'],
            ['name' => 'society'],
            ['name' => 'politics'],
            ['name' => 'law'],
            ['name' => 'news'],
            ['name' => 'the one'],
            ['name' => 'fashion'],
            ['name' => 'culture'],
            ['name' => 'travel'],
        ];

        DB::table('categories')->insert($categories);
    }
}
