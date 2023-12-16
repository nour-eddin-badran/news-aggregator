<?php

namespace App\Services\Elasticsearch\Filters;

use App\Dto\ElasticsearchQueryParamsDto;

class QueryFilter implements Filter
{
    public static function add(ElasticsearchQueryParamsDto $queryParamsDto, array &$query): void
    {
        if ($q = $queryParamsDto->getQuery()) {
            $query['query']['bool']['must'][] = [
                'bool' => [
                    'should' => [
                        ['match' => ['title' => $q]],
                        ['match' => ['description' => $q]],
                        ['match' => ['content' => $q]]
                    ]
                ]
            ];
        }
    }
}
