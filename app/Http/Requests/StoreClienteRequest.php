<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre'    => 'required|string|max:255',
            'correo'    => 'required|email|unique:clientes,correo,' . ($this->cliente?->id ?? 'NULL'),
            'telefono'  => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ];
    }
}
