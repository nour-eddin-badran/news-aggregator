<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Modules\NewsProviders\Fetchers\NewsApiOrgFetcher;
use App\Modules\NewsProviders\Fetchers\NewYorkTimesFetcher;
use App\Modules\NewsProviders\Fetchers\TheGuardianFetcher;
use App\Modules\NewsProviders\NewsApiOrgProvider;
use App\Modules\NewsProviders\NewYorkTimesProvider;
use App\Modules\NewsProviders\TheGuardianProvider;
use App\Modules\NewsProviders\Translators\NewsApiOrgTranslator;
use App\Modules\NewsProviders\Translators\NewYorkTimesTranslator;
use App\Modules\NewsProviders\Translators\TheGuardianTranslator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Provider::query()->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $providers = [
            ['name' => 'NewsAPI.org', 'handler' => NewsApiOrgProvider::class],
            ['name' => 'New York Times', 'handler' => NewYorkTimesProvider::class],
            ['name' => 'The Guardian', 'handler' => TheGuardianProvider::class],
        ];

        DB::table('providers')->insert($providers);
    }
}
