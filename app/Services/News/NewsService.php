<?php

namespace App\Services\News;

use App\Dto\ElasticsearchQueryParamsDto;
use App\Dto\SearchParamsDto;
use App\Services\Category\CategoryService;
use App\Services\Elasticsearch\NewsElasticSearchService;
use App\Services\Source\SourceService;
use App\Services\User\UserPreferencesService;

class NewsService
{
    public function __construct(private readonly NewsElasticSearchService $searchService, private readonly UserPreferencesService $preferencesService, private readonly SourceService $sourceService, private readonly CategoryService $categoryService)
    {
    }

    public function get(SearchParamsDto $searchParamsDto): array
    {
        $queryParams = new ElasticsearchQueryParamsDto(
            $searchParamsDto->getQuery(),
            $searchParamsDto->getFromDate(),
            $searchParamsDto->getToDate(),
            $this->getSources($searchParamsDto),
            $this->getCategories($searchParamsDto),
            $this->getAuthors($searchParamsDto)
        );

        return $this->searchService->getDocuments($queryParams);
    }

    private function getSources(SearchParamsDto $searchParamsDto): array
    {
        $ids = $this->preferencesService->getSources()?->value ?? [];

        return $searchParamsDto->getSource() ? [$searchParamsDto->getSource()] :
            $this->sourceService->getSourcesNamesByIds($ids);
    }

    private function getCategories(SearchParamsDto $searchParamsDto): array
    {
        $ids = $this->preferencesService->getCategories()?->value ?? [];

        return $searchParamsDto->getCategory() ? [$searchParamsDto->getCategory()] :
            $this->categoryService->getCategoriesNamesByIds($ids);
    }

    private function getAuthors(SearchParamsDto $searchParamsDto): array
    {
        $authors =  $this->preferencesService->getAuthors()?->value ?? [];

        return $searchParamsDto->getAuthor() ? [$searchParamsDto->getAuthor()] :
            $authors;
    }
}
