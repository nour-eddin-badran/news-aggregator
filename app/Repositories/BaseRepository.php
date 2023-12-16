<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class BaseRepository implements Repository
{
    public function __construct(protected Model $model)
    {
    }

    public function findOneBy(array $where, array $with = []): Model
    {
        return $this->model->with($with)->where($where)->first();
    }

    public function findAllWhere(array $where, array $with = []): Collection
    {
        return $this->model->with($with)->where($where)->get();
    }

    public function findWhereIn(string $key, array $values): Collection
    {
        return $this->model->whereIn($key, $values)->get();
    }
}
