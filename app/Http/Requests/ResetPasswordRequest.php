<?php

namespace App\Http\Requests;

use App\Rules\ValidAesEncryptedPassword;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token'    => ['required', 'string'],
            'email'    => ['required', 'string', 'email', 'exists:users,email'],
            'password' => ['required', 'string', new ValidAesEncryptedPassword(enforceComplexity: true)],
        ];
    }

    public function messages(): array
    {
        return [
            'token.required'    => 'El token de recuperación es obligatorio.',
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'El correo electrónico no tiene un formato válido.',
            'email.exists'      => 'No existe una cuenta con ese correo electrónico.',
            'password.required' => 'La nueva contraseña es obligatoria.',
        ];
    }

    public function attributes(): array
    {
        return [
            'token'    => 'token de recuperación',
            'email'    => 'correo electrónico',
            'password' => 'contraseña',
        ];
    }
}
