<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

interface PermissionRepositoryInterface
{
    public function findById(int $id): ?Permission;

    public function findByIdOrFail(int $id): Permission;

    /**
     * @return array{records: Collection, pagination: array}
     */
    public function paginate(int $take, int $skip, string $search = ''): array;

    public function findByNames(array $names): Collection;
}
