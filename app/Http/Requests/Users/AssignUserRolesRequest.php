<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class AssignUserRolesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'roles'   => ['required', 'array'],
            'roles.*' => ['integer', 'exists:roles,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'roles.required'  => 'El arreglo de roles es obligatorio.',
            'roles.array'     => 'Los roles deben enviarse como un arreglo.',
            'roles.*.integer' => 'Cada rol debe ser un identificador numérico.',
            'roles.*.exists'  => 'Uno o más roles especificados no existen.',
        ];
    }
}
