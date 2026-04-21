<?php

namespace App\Services;

use App\Repositories\Contracts\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function __construct(
        private readonly RoleRepositoryInterface $roles,
    ) {}

    public function list(int $take, int $skip, string $search = ''): array
    {
        return $this->roles->paginate($take, $skip, $search);
    }

    public function findOrFail(int $id): Role
    {
        return $this->roles->findByIdOrFail($id);
    }

    public function create(array $validated): Role
    {
        $permissionNames = $validated['permissions'] ?? [];
        unset($validated['permissions']);

        $role = $this->roles->create($validated);

        if (!empty($permissionNames)) {
            $this->roles->syncPermissions($role, $permissionNames);
        }

        $role->load('permissions:id,name');
        return $role;
    }

    public function update(Role $role, array $validated): Role
    {
        $permissionNames = isset($validated['permissions']) ? $validated['permissions'] : null;
        unset($validated['permissions']);

        if (!empty($validated)) {
            $this->roles->update($role, $validated);
        }

        if ($permissionNames !== null) {
            $this->roles->syncPermissions($role, $permissionNames);
        }

        $role->refresh();
        $role->load('permissions:id,name');
        return $role;
    }

    public function delete(Role $role): void
    {
        if ($this->roles->hasUsers($role)) {
            throw new \DomainException(__('messages.role.has_users'));
        }

        $this->roles->delete($role);
    }

    public function setActive(Role $role, bool $active): Role
    {
        $this->roles->update($role, ['active' => $active]);
        $role->refresh();
        return $role;
    }

    public function syncPermissions(Role $role, array $permissionNames): Role
    {
        return $this->roles->syncPermissions($role, $permissionNames);
    }
}
