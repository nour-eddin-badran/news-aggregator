<?php

namespace App\Modules\NewsProviders;

use App\Enums\ProviderEnum;
use App\Models\ErrorLog;
use App\Modules\NewsProviders\Resources\NewsResource;
use App\Modules\NewsProviders\Traits\Normalizable;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class NewYorkTimesProvider implements NewsProvider
{
    use Normalizable;

    private const SEARCH_URI = '/svc/search/v2/articlesearch.json';
    private int $maxPageSize;
    private string $apiKey;
    private int $sleepRate;
    private Client $client;

    public function __construct()
    {
        $config = config('services.news_providers.new_york_times');
        $this->apiKey = $config['api_key'];
        $host = $config['host'];
        $this->sleepRate = $config['sleep_rate'];
        $this->client = new Client([
            'base_uri' => $host
        ]);
    }

    public function fetch(string $fromDate, string $toDate): array
    {
        $page = 0; // max page size is 10
        $totalArticles = [];

        try {

            do {
                $url = self::SEARCH_URI . '?' . http_build_query([
                        'api-key' => $this->apiKey,
                        'begin_date' => Carbon::parse($fromDate)->format('Ymd'),
                        'end_date' => Carbon::parse($toDate)->format('Ymd'),
                        'page' => $page
                    ]);

                $request = new Request('GET', $url);
                $response = $this->client->sendAsync($request)->wait();

                $data = json_decode($response->getBody()->getContents(), true);

                if (!empty($data['response']['docs'])) {
                    $totalArticles = [...$totalArticles, ...$data['response']['docs']];
                    $page++;

                    sleepToExceedTheRateLimiter($this->sleepRate);
                }
            } while (!empty($data['response']['docs']));

            return $totalArticles;

        } catch (Exception $e) {
            ErrorLog::newError($e);
            return [];
        }
    }

    public function translate(array $data): NewsResource
    {
        return new NewsResource(
            title: $data['headline']['main'],
            content: $data['snippet'],
            category: $this->categoryNormalization($data['section_name'] ?? null),
            source: $this->getSource($data),
            primaryLink: $data['web_url'],
            publishedAt: $data['pub_date'],
            description: $data['snippet'],
            author: $this->getAuthors($data),
            coverUrl: $data['multimedia'][0]['url'] ?? null,
        );
    }

    private function getAuthors(array $data): ?string
    {
        if (!isset($data['byline']['original'])) {
            return null;
        }

        return Str::replace('By ', '', $data['byline']['original']);
    }

    private function getSource(array $data): string
    {
        return $data['source'] ?? ProviderEnum::NEW_YORK_TIMES->value;
    }
}
