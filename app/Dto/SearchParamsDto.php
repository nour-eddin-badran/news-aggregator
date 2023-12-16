<?php

namespace App\Dto;

class SearchParamsDto
{
    public function __construct(private readonly ?string $query = null, private readonly ?string $source = null, private readonly ?string $category = null, private readonly ?string $author = null, private readonly ?string $fromDate = null, private readonly ?string $toDate = null)
    {
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getFromDate(): ?string
    {
        return $this->fromDate;
    }

    public function getToDate(): ?string
    {
        return $this->toDate;
    }
}
