<?php

namespace App\Http\Controllers\Api\V1\Index;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Services\Index\SourceService;

class SourceController extends BaseApiController
{
    public function __construct(private SourceService $sourceService)
    {
    }

    public function index()
    {
        $data = $this->sourceService->get();
        return $this->successResponse($data);
    }
}
