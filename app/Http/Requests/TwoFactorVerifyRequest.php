<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TwoFactorVerifyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'digits:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'El código de verificación es obligatorio.',
            'code.digits'   => 'El código debe ser de exactamente 6 dígitos.',
        ];
    }

    public function attributes(): array
    {
        return [
            'code' => 'código de verificación',
        ];
    }
}
