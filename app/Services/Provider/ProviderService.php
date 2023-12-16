<?php

namespace App\Services\Provider;

use App\Models\Provider;
use App\Repositories\ProviderRepository;
use Illuminate\Database\Eloquent\Collection;

class ProviderService
{
    public function __construct(private ProviderRepository $providerRepository)
    {
    }

    public function getActiveProviders(): Collection
    {
        return $this->providerRepository->findAllWhere(['is_active' => 1]);
    }

    public function getProviderByName(string $name): Provider
    {
        return $this->providerRepository->findOneBy([
            'name' => $name
        ], ['sources']);
    }
}
