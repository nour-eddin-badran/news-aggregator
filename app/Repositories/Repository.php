<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Repository
{
    public function findOneBy(array $where, array $with = []): Model;

    public function findAllWhere(array $where, array $with = []): Collection;

    public function findWhereIn(string $key, array $values): Collection;
}
