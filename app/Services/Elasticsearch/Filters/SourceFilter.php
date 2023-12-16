<?php

namespace App\Services\Elasticsearch\Filters;

use App\Dto\ElasticsearchQueryParamsDto;

class SourceFilter implements Filter
{
    public static function add(ElasticsearchQueryParamsDto $queryParamsDto, array &$query): void
    {
        if ($sources = $queryParamsDto->getSources()) {
            $query['query']['bool']['must'][] = [
                'bool' => [
                    'should' => [
                        [
                            'terms' => [
                                'source.keyword' => $sources
                            ]
                        ]
                    ]
                ]
            ];
        }
    }
}
