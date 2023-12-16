<?php

namespace App\Services\Source;

use App\Repositories\SourceRepository;

class SourceService
{
    public function __construct(private SourceRepository $sourceRepository)
    {
    }

    public function getSourcesNamesByIds(array $ids): array
    {
        $sources = $this->sourceRepository->findWhereIn('id', $ids);
        return $sources->pluck('name')->toArray();
    }
}
