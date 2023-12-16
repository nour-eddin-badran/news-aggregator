<?php

namespace App\Dto;

class UserPreferencesDto
{
    public function __construct(private readonly ?array $sources = [], private readonly ?array $categories = [], private readonly ?array $authors = [])
    {
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
