<?php

namespace App\Services\Index;

use App\Models\Source;
use App\Http\Resources\Source as SourceResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SourceService
{
    public function get(): AnonymousResourceCollection
    {
        $sources = Source::with('categories')->active()->get();

        return SourceResource::collection($sources);
    }
}
