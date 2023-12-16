<?php

namespace App\Console\Commands;

use App\Modules\NewsScraper\NewsScraper;
use Illuminate\Console\Command;

class NewsScrapper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:scraper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will scrape and aggregate news from different sources using different news-providers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newsScraperService = app(NewsScraper::class);
        //INFO Every day I will scrap the news related to yesterday
        $newsScraperService->scraping(now()->subDay()->toDateString(), now()->subDay()->toDateString());
        $this->info('done');
    }
}
