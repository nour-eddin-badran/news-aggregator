<?php

namespace App\Http\Controllers\Api\V1\News;

use App\Dto\SearchParamsDto;
use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\News\SearchRequest;
use App\Services\News\NewsService;
use Illuminate\Http\Request;

class NewsController extends BaseApiController
{
    public function __construct(private NewsService $newsService)
    {
    }

    public function index(SearchRequest $request)
    {
        $news = $this->newsService->get(
            new SearchParamsDto(
                $request->q,
                $request->source,
                $request->category,
                $request->author,
                $request->from_date,
                $request->to_date
            )
        );

        return $this->successResponse($news);
    }

}
