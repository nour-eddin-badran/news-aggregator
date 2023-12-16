<?php

namespace App\Services\Elasticsearch\Filters;

use App\Dto\ElasticsearchQueryParamsDto;

interface Filter
{
    public static function add(ElasticsearchQueryParamsDto $queryParamsDto, array &$query): void;
}
