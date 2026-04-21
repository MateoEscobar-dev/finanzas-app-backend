<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'guard_name'  => $this->guard_name,
            'description' => $this->description,
            'active'      => $this->active,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'permissions' => $this->whenLoaded('permissions', fn () => $this->buildPermissionsGrouped()),
            'permissions_count' => $this->whenLoaded('permissions', fn () => $this->permissions->count()),
        ];
    }

    /**
     * Agrupa los permisos por módulo (prefijo antes del primer punto).
     * users.view, users.add → ['users' => ['users.view', 'users.add']]
     * Un permiso sin punto queda en la clave del propio nombre.
     */
    private function buildPermissionsGrouped(): array
    {
        $grouped = [];

        foreach ($this->permissions as $permission) {
            $parts  = explode('.', $permission->name, 2);
            $module = count($parts) > 1 ? $parts[0] : $permission->name;

            $grouped[$module][] = $permission->name;
        }

        return $grouped;
    }
}
