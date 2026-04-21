<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface
{
    public function findById(int $id): ?Role;

    public function findByIdOrFail(int $id): Role;

    /**
     * @return array{records: Collection, pagination: array}
     */
    public function paginate(int $take, int $skip, string $search = ''): array;

    public function create(array $data): Role;

    public function update(Role $role, array $data): bool;

    public function delete(Role $role): bool;

    public function syncPermissions(Role $role, array $permissionNames): Role;

    public function hasUsers(Role $role): bool;
}
