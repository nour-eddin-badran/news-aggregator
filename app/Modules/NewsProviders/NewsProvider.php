<?php

namespace App\Modules\NewsProviders;

use App\Modules\NewsProviders\Resources\NewsResource;

interface NewsProvider
{
    public function fetch(string $fromDate, string $toDate): array;

    public function translate(array $data): NewsResource;
}
