<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roleId = $this->route('id') ?? $this->route('role');

        return [
            'name'          => ['nullable', 'string', 'max:100', Rule::unique('roles', 'name')->ignore($roleId)],
            'description'   => ['nullable', 'string', 'max:255'],
            'active'        => ['nullable', 'boolean'],
            'permissions'   => ['nullable', 'array'],
            'permissions.*' => ['string', 'exists:permissions,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique'          => 'El nombre del rol ya está en uso.',
            'name.max'             => 'El nombre del rol no puede superar 100 caracteres.',
            'description.max'      => 'La descripción no puede superar 255 caracteres.',
            'active.boolean'       => 'El campo activo debe ser verdadero o falso.',
            'permissions.array'    => 'Los permisos deben enviarse como un arreglo.',
            'permissions.*.string' => 'Cada permiso debe ser una cadena de texto.',
            'permissions.*.exists' => 'Uno o más permisos especificados no existen.',
        ];
    }
}
