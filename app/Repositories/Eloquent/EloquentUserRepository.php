<?php

namespace App\Repositories\Eloquent;

use App\Models\Logs;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

class EloquentUserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected function model(): string
    {
        return User::class;
    }

    public function findById(int $id): ?User
    {
        return User::with(['roles:id,name', 'permissions:id,name'])->find($id);
    }

    public function findByIdOrFail(int $id): User
    {
        return User::with(['roles:id,name', 'permissions:id,name'])->findOrFail($id);
    }

    public function paginate(int $take, int $skip, string $search = ''): array
    {
        $query = User::with(['roles:id,name']);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('first_last_name', 'like', "%{$search}%")
                  ->orWhere('document', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        return parent::paginate($query, $take, $skip);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User|\Illuminate\Database\Eloquent\Model $user, array $data): bool
    {
        return $user->update($data);
    }

    public function delete(User|\Illuminate\Database\Eloquent\Model $user): bool
    {
        $user->syncRoles([]);
        $user->syncPermissions([]);
        $user->tokens()->delete();
        return (bool) $user->delete();
    }

    public function getPermissions(User $user): array
    {
        $rolePermissions   = $user->getPermissionsViaRoles()->pluck('name')->toArray();
        $directPermissions = $user->getDirectPermissions()->pluck('name')->toArray();

        return [
            'direct_permissions' => $directPermissions,
            'role_permissions'   => $rolePermissions,
        ];
    }

    public function syncPermissions(User $user, array $permissionNames): User
    {
        $permissions = Permission::whereIn('name', $permissionNames)
            ->where('guard_name', 'api')
            ->get();

        $user->syncPermissions($permissions);
        $user->load('permissions:id,name');

        return $user;
    }

    public function syncRoles(User $user, array $roleIds): User
    {
        $user->syncRoles($roleIds);
        $user->load(['roles:id,name', 'permissions:id,name']);

        return $user;
    }

    public function getHistory(int $userId): array
    {
        return Logs::where([
            ['table', 'users'],
            ['id_item', $userId],
        ])->with('usuario')->orderByDesc('id')->get()->toArray();
    }
}
