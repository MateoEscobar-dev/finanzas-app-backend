<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'email'            => $this->email,
            'document'         => $this->document,
            'first_name'       => $this->first_name,
            'second_name'      => $this->second_name,
            'first_last_name'  => $this->first_last_name,
            'second_last_name' => $this->second_last_name,
            'address'          => $this->address,
            'phone'            => $this->phone,
            'phone_ext'        => $this->phone_ext,
            'birth_day'        => $this->birth_day,
            'lang'             => $this->lang,
            'active'           => $this->active,
            'imagen'           => $this->imagen,
            'email_verified_at' => $this->email_verified_at,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
            'roles'            => $this->whenLoaded('roles', fn () => $this->roles->map(fn ($r) => [
                'id'   => $r->id,
                'name' => $r->name,
            ])->toArray()),
            'permissions'      => $this->whenLoaded('permissions', fn () => $this->permissions->pluck('name')->toArray()),
        ];
    }
}
