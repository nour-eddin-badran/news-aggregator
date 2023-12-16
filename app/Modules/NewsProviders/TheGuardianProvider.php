<?php

namespace App\Modules\NewsProviders;

use App\Enums\ProviderEnum;
use App\Models\ErrorLog;
use App\Modules\NewsProviders\Resources\NewsResource;
use App\Modules\NewsProviders\Traits\Normalizable;
use DateTimeImmutable;
use Exception;
use Guardian\GuardianAPI;

class TheGuardianProvider implements NewsProvider
{
    use Normalizable;

    private int $maxPageSize;
    private string $apiKey;

    public function __construct()
    {
        $config = config('services.news_providers.the_guardian');
        $this->apiKey = $config['api_key'];
        $this->maxPageSize = $config['page_size'];
    }

    public function fetch(string $fromDate, string $toDate): array
    {
        $page = 1;
        $totalArticles = [];

        try {
            $guardianAPI = new GuardianAPI($this->apiKey);

            do {
                $response = $guardianAPI->content()
                    ->setFromDate(new DateTimeImmutable($fromDate))
                    ->setToDate(new DateTimeImmutable($toDate))
                    ->setShowTags("contributor")
                    ->setShowFields("all")
                    ->setPageSize($this->maxPageSize)
                    ->setPage($page)
                    ->fetch();

                $data = json_decode(json_encode($response), true);
                $pageCount = $data['response']['pages'];

                if (!empty($data['response']['results'])) {
                    $totalArticles = [...$totalArticles, ...$data['response']['results']];
                    $page++;
                }
            } while ($page <= $pageCount);

            return $totalArticles;
        } catch (Exception $e) {
            ErrorLog::newError($e);
            return [];
        }
    }

    public function translate(array $data): NewsResource
    {
        return new NewsResource(
            title: $data['webTitle'],
            content: $data['fields']['body'],
            category: $this->categoryNormalization($data['pillarName'] ?? null),
            source: ProviderEnum::THE_GUARDIAN->value,
            primaryLink: $data['fields']['shortUrl'],
            publishedAt: $data['webPublicationDate'],
            description: $data['fields']['body'],
            author: $this->getAuthors($data),
            coverUrl: $data['fields']['thumbnail'] ?? null,
        );
    }

    private function getAuthors(array $data): ?string
    {
        $tags = collect($data['tags'])->where('type', 'contributor')->pluck('webTitle')->toArray();

        if (empty($tags)) {
            return null;
        }

        return implode(',', $tags);
    }
}
