<?php

namespace App\Services\Index;

use App\Models\Category;
use App\Http\Resources\Category as CategoryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService
{
    public function get(): AnonymousResourceCollection
    {
        $categories = Category::active()->get();

        return CategoryResource::collection($categories);
    }
}
