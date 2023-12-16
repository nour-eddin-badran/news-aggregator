<?php

namespace App\Repositories;

use App\Models\Source;

class SourceRepository extends BaseRepository
{
    public function __construct(protected Source $source)
    {
        parent::__construct($source);
    }
}
