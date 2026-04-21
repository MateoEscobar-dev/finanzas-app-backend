<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $parts  = explode('.', $this->name, 2);
        $module = count($parts) > 1 ? $parts[0] : $this->name;

        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'module'     => $module,
            'guard_name' => $this->guard_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
