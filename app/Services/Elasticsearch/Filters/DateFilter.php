<?php

namespace App\Services\Elasticsearch\Filters;

use App\Dto\ElasticsearchQueryParamsDto;

class DateFilter implements Filter
{
    public static function add(ElasticsearchQueryParamsDto $queryParamsDto, array &$query): void
    {
        if (($fromDate = $queryParamsDto->getFromDate()) && ($toDate = $queryParamsDto->getToDate())) {
            $query['query']['bool']['must'][] = [
                'range' => [
                    'published_at' => [
                        'gte' => $fromDate,
                        'lte' => $toDate
                    ]
                ]
            ];
        }
    }
}
