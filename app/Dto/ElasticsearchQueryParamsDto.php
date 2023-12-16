<?php

namespace App\Dto;

class ElasticsearchQueryParamsDto
{
    public function __construct(private readonly ?string $query, private readonly ?string $fromDate, private readonly ?string $toDate, private readonly ?array $sources = [], private readonly ?array $categories = [], private readonly ?array $authors = [])
    {
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function getFromDate(): ?string
    {
        return $this->fromDate;
    }

    public function getToDate(): ?string
    {
        return $this->toDate;
    }

    public function getSources(): ?array
    {
        return $this->sources;
    }

    public function getCategories(): ?array
    {
        return $this->categories;
    }

    public function getAuthors(): ?array
    {
        return $this->authors;
    }
}
