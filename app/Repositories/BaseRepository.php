<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    abstract protected function model(): string;

    public function all(): Collection
    {
        return $this->model()::all();
    }

    public function find(int $id): ?Model
    {
        return $this->model()::find($id);
    }

    public function findOrFail(int $id): Model
    {
        return $this->model()::findOrFail($id);
    }

    public function create(array $data): Model
    {
        return $this->model()::create($data);
    }

    public function update(Model $model, array $data): bool
    {
        return $model->update($data);
    }

    public function delete(Model $model): bool
    {
        return (bool) $model->delete();
    }

    /**
     * Paginar usando patrón skip/take del proyecto.
     *
     * @return array{records: \Illuminate\Database\Eloquent\Collection, pagination: array}
     */
    protected function paginateQuery(\Illuminate\Database\Eloquent\Builder $query, int $take, int $skip): array
    {
        $take  = max(1, min($take, 100));
        $skip  = max(0, $skip);
        $total = $query->count();

        $records = $query->skip($skip)->take($take)->get();

        return [
            'records'    => $records,
            'pagination' => [
                'total'        => $total,
                'take'         => $take,
                'skip'         => $skip,
                'pages'        => $total > 0 ? (int) ceil($total / $take) : 0,
                'current_page' => (int) floor($skip / $take) + 1,
            ],
        ];
    }
}
