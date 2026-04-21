<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EloquentRoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    protected function model(): string
    {
        return Role::class;
    }

    public function findById(int $id): ?Role
    {
        return Role::with('permissions:id,name')->find($id);
    }

    public function findByIdOrFail(int $id): Role
    {
        return Role::with('permissions:id,name')->findOrFail($id);
    }

    public function paginate(int $take, int $skip, string $search = ''): array
    {
        $query = Role::with('permissions:id,name');

        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }

        return parent::paginate($query, $take, $skip);
    }

    public function create(array $data): Role
    {
        return Role::create([
            'name'        => $data['name'],
            'guard_name'  => 'api',
            'description' => $data['description'] ?? null,
            'active'      => $data['active'] ?? true,
        ]);
    }

    public function update(Role|\Illuminate\Database\Eloquent\Model $role, array $data): bool
    {
        return $role->update($data);
    }

    public function delete(Role|\Illuminate\Database\Eloquent\Model $role): bool
    {
        return (bool) $role->delete();
    }

    public function syncPermissions(Role $role, array $permissionNames): Role
    {
        $permissions = Permission::whereIn('name', $permissionNames)
            ->where('guard_name', 'api')
            ->get();

        $role->syncPermissions($permissions);
        $role->load('permissions:id,name');

        return $role;
    }

    public function hasUsers(Role $role): bool
    {
        return $role->users()->exists();
    }
}
