<?php

namespace App\Services\Elasticsearch\Filters;

use App\Dto\ElasticsearchQueryParamsDto;

class CategoryFilter implements Filter
{
    public static function add(ElasticsearchQueryParamsDto $queryParamsDto, array &$query): void
    {
        if ($categories = $queryParamsDto->getCategories()) {
            $query['query']['bool']['must'][] = [
                'bool' => [
                    'should' => [
                        [
                            'terms' => [
                                'category.keyword' => $categories
                            ]
                        ]
                    ]
                ]
            ];
        }
    }
}
