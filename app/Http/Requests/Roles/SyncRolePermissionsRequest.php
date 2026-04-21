<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class SyncRolePermissionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'permissions'   => ['required', 'array'],
            'permissions.*' => ['string', 'exists:permissions,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'permissions.required' => 'El arreglo de permisos es obligatorio.',
            'permissions.array'    => 'Los permisos deben enviarse como un arreglo.',
            'permissions.*.string' => 'Cada permiso debe ser una cadena de texto.',
            'permissions.*.exists' => 'Uno o más permisos especificados no existen.',
        ];
    }
}
