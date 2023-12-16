<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function getCategoriesNamesByIds(array $ids): array
    {
        $sources = $this->categoryRepository->findWhereIn('id', $ids);
        return $sources->pluck('name')->toArray();
    }
}
