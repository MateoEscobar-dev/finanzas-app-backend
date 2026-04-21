<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

class EloquentPermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    protected function model(): string
    {
        return Permission::class;
    }

    public function findById(int $id): ?Permission
    {
        return Permission::find($id);
    }

    public function findByIdOrFail(int $id): Permission
    {
        return Permission::findOrFail($id);
    }

    public function paginate(int $take, int $skip, string $search = ''): array
    {
        $query = Permission::where('guard_name', 'api');

        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }

        return $this->paginateQuery($query, $take, $skip);
    }

    public function findByNames(array $names): Collection
    {
        return Permission::whereIn('name', $names)
            ->where('guard_name', 'api')
            ->get();
    }
}
