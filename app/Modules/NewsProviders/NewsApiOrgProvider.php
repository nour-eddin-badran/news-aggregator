<?php

namespace App\Modules\NewsProviders;

use App\Enums\ProviderEnum;
use App\Models\ErrorLog;
use App\Models\Provider;
use App\Models\Source;
use App\Modules\NewsProviders\Resources\NewsResource;
use App\Modules\NewsProviders\Traits\Normalizable;
use App\Services\Provider\ProviderService;
use Exception;
use Illuminate\Support\Str;
use jcobhams\NewsApi\NewsApi;

class NewsApiOrgProvider implements NewsProvider
{
    use Normalizable;

    private int $maxPageSize;

    private Provider $provider;

    public function __construct(private NewsApi $newsapi, ProviderService $providerService)
    {
        $this->maxPageSize = config('services.news_providers.news_api_org.page_size');
        $this->provider = $providerService->getProviderByName(ProviderEnum::NEWS_API_ORG->value);
    }

    public function fetch(string $fromDate, string $toDate): array
    {
        $totalArticles = [];

        try {
            foreach ($this->provider->sources as $source) {
                $sourceSlug = Str::slug($source['name']);
                $data = $this->newsapi->getEverything(
                    q: null,
                    sources: $sourceSlug,
                    domains: null,
                    exclude_domains: null,
                    from: $fromDate,
                    to: $toDate,
                    language: null,
                    sort_by: null,
                    page_size: $this->maxPageSize
                );

                $articles = json_decode(json_encode($data->articles), true);
                $articles = $this->setCategoryForAllArticles($source, $articles);
                $totalArticles = [...$totalArticles, ...$articles];
            }

            return $totalArticles;
        } catch (Exception $e) {
            ErrorLog::newError($e);
            return [];
        }
    }

    public function translate(array $data): NewsResource
    {
        return new NewsResource(
            title: $data['title'],
            content: $data['content'],
            category: $this->categoryNormalization($data['category']),
            source: $data['source']['name'],
            primaryLink: $data['url'],
            publishedAt: $data['publishedAt'],
            description: $data['description'],
            author: $data['author'],
            coverUrl: $data['urlToImage'],
        );
    }

    private function setCategoryForAllArticles(Source $source, array $articles): array
    {
        $category = collect($source['categories'])->pluck('name')->toArray();
        $category = implode(',', $category);
        $articleCategory = ['category' => $category];

        return array_map(fn($article) => $article + $articleCategory, $articles);
    }
}
