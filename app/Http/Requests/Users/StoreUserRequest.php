<?php

namespace App\Http\Requests\Users;

use App\Rules\ValidAesEncryptedPassword;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document'         => ['required', 'string', 'max:20', 'unique:users,document'],
            'first_name'       => ['required', 'string', 'max:100'],
            'second_name'      => ['nullable', 'string', 'max:100'],
            'first_last_name'  => ['required', 'string', 'max:100'],
            'second_last_name' => ['nullable', 'string', 'max:100'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'         => ['required', 'string', new ValidAesEncryptedPassword(enforceComplexity: true)],
            'phone'            => ['required', 'string', 'regex:/^\+[1-9]\d{1,14}$/'],
            'phone_ext'        => ['nullable', 'numeric', 'digits_between:1,10'],
            'birth_day'        => ['required', 'date_format:Y-m-d', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'address'          => ['nullable', 'string', 'max:255'],
            'lang'             => ['nullable', 'string', 'in:es,en'],
            'roles'            => ['nullable', 'array'],
            'roles.*'          => ['integer', 'exists:roles,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'document.required'         => 'El documento de identidad es obligatorio.',
            'document.unique'           => 'El documento de identidad ya está registrado.',
            'document.max'              => 'El documento no puede superar 20 caracteres.',
            'first_name.required'       => 'El primer nombre es obligatorio.',
            'first_name.max'            => 'El primer nombre no puede superar 100 caracteres.',
            'first_last_name.required'  => 'El primer apellido es obligatorio.',
            'first_last_name.max'       => 'El primer apellido no puede superar 100 caracteres.',
            'email.required'            => 'El correo electrónico es obligatorio.',
            'email.email'               => 'El correo electrónico no tiene un formato válido.',
            'email.unique'              => 'El correo electrónico ya está registrado.',
            'password.required'         => 'La contraseña es obligatoria.',
            'phone.required'            => 'El número de teléfono es obligatorio.',
            'phone.regex'               => 'El teléfono debe estar en formato internacional E.164 (ej: +573138853031).',
            'phone_ext.numeric'         => 'La extensión del teléfono debe ser numérica.',
            'birth_day.required'        => 'La fecha de nacimiento es obligatoria.',
            'birth_day.date_format'     => 'La fecha de nacimiento debe tener el formato YYYY-MM-DD.',
            'birth_day.before_or_equal' => 'Debes ser mayor de 18 años.',
            'lang.in'                   => 'El idioma debe ser "es" o "en".',
            'roles.array'               => 'Los roles deben enviarse como un arreglo.',
            'roles.*.integer'           => 'Cada rol debe ser un identificador numérico.',
            'roles.*.exists'            => 'Uno o más roles especificados no existen.',
        ];
    }
}
