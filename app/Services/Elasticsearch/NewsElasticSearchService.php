<?php

namespace App\Services\Elasticsearch;

use App\Dto\ElasticsearchQueryParamsDto;
use App\Modules\Elasticsearch\ElasticsearchClient;
use App\Modules\Elasticsearch\Resources\News as NewsResource;
use App\Services\Elasticsearch\Filters\AuthorFilter;
use App\Services\Elasticsearch\Filters\CategoryFilter;
use App\Services\Elasticsearch\Filters\DateFilter;
use App\Services\Elasticsearch\Filters\QueryFilter;
use App\Services\Elasticsearch\Filters\SourceFilter;
use Illuminate\Http\Request;

class NewsElasticSearchService
{
    private int $pageSize;
    private int $page;

    public function __construct(private readonly ElasticsearchClient $client, Request $request)
    {
        $this->pageSize = (int)$request->get('limit', config('constants.default_page_size'));
        $this->page = (int)$request->get('page', 0);
    }

    public function getDocuments(ElasticsearchQueryParamsDto $queryParamsDto): array
    {
        $query = $this->buildQuery($this->pageSize, $this->page, $queryParamsDto);
        $data = $this->client->searchDocuments($query);

        if (!isset($data['hits']['hits'])) {
            return [];
        }

        $collectionData = NewsResource::collection($data['hits']['hits']);

        $paginationInfo = [
            'pagination' => [
                'total' => $data['hits']['total']['value'],
                'page_size' => $this->pageSize,
                'page' => $this->page
            ]
        ];

        return [
            'documents' => $collectionData,
            'pagination' => $paginationInfo
        ];
    }

    private function buildQuery(int $pageSize, int $page, ElasticsearchQueryParamsDto $queryParamsDto): array
    {
        $query = [
            'size' => $pageSize,
            'from' => $page,
            'query' => [
                'bool' => [
                    'must' => [],
                ],
            ],
        ];

        QueryFilter::add($queryParamsDto, $query);
        DateFilter::add($queryParamsDto, $query);
        SourceFilter::add($queryParamsDto, $query);
        CategoryFilter::add($queryParamsDto, $query);
        AuthorFilter::add($queryParamsDto, $query);

        if (empty($query['query']['bool']['must'])) {
            $query['query']['bool']['must'][]['match_all'] = new \stdClass();
        }

        return $query;
    }
}
