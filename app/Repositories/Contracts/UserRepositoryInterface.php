<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;

    public function findByIdOrFail(int $id): User;

    /**
     * @return array{records: Collection, pagination: array}
     */
    public function paginate(int $take, int $skip, string $search = ''): array;

    public function create(array $data): User;

    public function update(User $user, array $data): bool;

    public function delete(User $user): bool;

    public function getPermissions(User $user): array;

    public function syncPermissions(User $user, array $permissionNames): User;

    public function syncRoles(User $user, array $roleIds): User;

    public function getHistory(int $userId): array;
}
