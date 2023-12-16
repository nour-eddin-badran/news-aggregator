<?php

namespace App\Modules\NewsScraper;

use App\Models\ErrorLog;
use App\Models\Provider;
use App\Modules\Elasticsearch\ElasticsearchClient;
use App\Modules\NewsProviders\NewsProvider;
use App\Services\Provider\ProviderService;

class NewsScraper
{
    public function __construct(private readonly ElasticsearchClient $elasticsearchClient, private readonly ProviderService $providerService)
    {
    }

    public function scraping(string $fromDate, string $toDate): void
    {
        ini_set('max_execution_time', 600);
        ini_set('memory_limit', '-1');

        try {
            $this->scrapeAndIndex($fromDate, $toDate);
        } catch (\Throwable $e) {
            ErrorLog::newError($e, ['context' => 'News Scraper']);
        }
    }

    private function scrapeAndIndex(string $fromDate, string $toDate): void
    {
        $providers = $this->providerService->getActiveProviders();

        foreach ($providers as $provider) {
            $providerInstance = app($provider->handler);
            $this->indexProviderArticles($providerInstance, $fromDate, $toDate);
        }
    }

    private function indexProviderArticles(NewsProvider $provider, string $fromDate, string $toDate): void
    {
        $articles = $provider->fetch($fromDate, $toDate);

        if (empty($articles)) {
            return;
        }

        $documents = [];
        foreach ($articles as $article) {
            $documents [] = $provider->translate($article);
        }

        foreach ($documents as $document) {
            $this->elasticsearchClient->indexDocument($document);
        }
    }
}
