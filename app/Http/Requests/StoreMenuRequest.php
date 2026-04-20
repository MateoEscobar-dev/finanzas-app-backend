<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'key' => 'required|string|unique:menus,key',
            'label' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'parent_key' => 'nullable|string|exists:menus,key',
            'is_title' => 'boolean',
            'collapsed' => 'boolean',
            'id_sistema_pantalla' => 'nullable|integer',
            'order' => 'integer',
            'padre_id' => 'nullable|integer',
            'icon_id' => 'nullable|integer',
            'flag_detalle' => 'boolean',
            'flag_visible' => 'boolean',
            'id_sistema' => 'nullable|integer',
            'bt_login' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'key.required' => 'La clave del menú es obligatoria',
            'key.unique' => 'La clave del menú ya existe',
            'label.required' => 'La etiqueta del menú es obligatoria',
            'parent_key.exists' => 'La clave del menú padre no existe',
        ];
    }
}
