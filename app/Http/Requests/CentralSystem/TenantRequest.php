<?php

namespace App\Http\Requests\CentralSystem;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
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
            'subdomain' => ['required', 'string','min:5', 'max:255', 'unique:domains,domain'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo obrigatório',
            'string' => 'Deve ser texto',
            'min' => 'Mínimo de :min caracteres',
            'max' => 'Máximo de :max caracteres',
            'unique' => 'Inquilino já existe',
        ];
    }
}
