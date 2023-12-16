<?php

namespace App\Repositories;

use App\Models\Provider;

class ProviderRepository extends BaseRepository
{
    public function __construct(protected Provider $provider)
    {
        parent::__construct($provider);
    }
}
