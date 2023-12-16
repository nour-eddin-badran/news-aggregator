<?php

namespace App\Services\Elasticsearch\Filters;

use App\Dto\ElasticsearchQueryParamsDto;

class AuthorFilter implements Filter
{
    public static function add(ElasticsearchQueryParamsDto $queryParamsDto, array &$query): void
    {
        if ($authors = $queryParamsDto->getAuthors()) {
            $query['query']['bool']['must'][] = [
                'bool' => [
                    'should' => [
                        [
                            'match' => [
                                'author' => implode(',', $authors)
                            ]
                        ]
                    ]
                ]
            ];
        }
    }
}
