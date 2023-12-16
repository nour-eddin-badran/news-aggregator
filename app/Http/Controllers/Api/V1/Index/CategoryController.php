<?php

namespace App\Http\Controllers\Api\V1\Index;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Services\Index\CategoryService;

class CategoryController extends BaseApiController
{
    public function __construct(private CategoryService $categoryService)
    { }

    public function index()
    {
        $data = $this->categoryService->get();
        return $this->successResponse($data);
    }
}
